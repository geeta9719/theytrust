<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use OpenAI\Factory;
use Carbon\Carbon;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    /**
     * Generate 10 realistic companies + addresses + industries + service lines
     * + client sizes + portfolio items — ALL via OpenAI.
     *
     * Reviews are handled separately by CompanyReviewSeeder.
     *
     * Usage:
     *   php artisan db:seed --class=CompanySeeder
     *   COMPANY_COUNT=20 php artisan db:seed --class=CompanySeeder
     *
     * Requires OPENAI_API_KEY in .env
     */

    protected string $model = 'gpt-4o-mini';

    public function run(): void
    {
        $apiKey = env('OPENAI_API_KEY');

        if (empty($apiKey)) {
            $this->command?->error('❌ OPENAI_API_KEY not found in .env');
            return;
        }

        $client = (new Factory())
            ->withApiKey($apiKey)
            ->withHttpHeader('OpenAI-Beta', 'assistants=v2')
            ->make();

        $faker = Faker::create('en_IN');
        $companyCount = (int) env('COMPANY_COUNT', 10);

        // ─── Pull existing lookup data from DB ────────────────────────────
        $rates        = DB::table('rates')->where('status', 1)->pluck('rate')->toArray();
        $sizeValues   = DB::table('sizes')->where('status', 1)->pluck('size')->toArray();
        $budgets      = DB::table('budgets')->where('status', 1)->pluck('budget')->toArray();
        $industries   = DB::table('industries')->pluck('name', 'id')->toArray();
        $categories   = DB::table('categories')->pluck('category', 'id')->toArray();
        $subcatMap    = DB::table('subcategories')->select('id', 'category_id')->get()->groupBy('category_id');
        $clientSizeIds = DB::table('client_sizes')->where('status', 1)->pluck('id')->toArray();

        if (empty($rates) || empty($sizeValues) || empty($budgets)) {
            $this->command?->error('❌ rates/sizes/budgets tables are empty. Seed those first.');
            return;
        }

        // ─── Step 1: Get or create shared owner user ──────────────────────
        $ownerUser = User::where('email', 'seeder-owner@theytrust.com')->first();

        if (!$ownerUser) {
            $ownerUser = User::create([
                'linkedin_id'        => $faker->uuid,
                'name'               => 'Admin Seeder',
                'first_name'         => 'Admin',
                'last_name'          => 'Seeder',
                'email'              => 'seeder-owner@theytrust.com',
                'mobile'             => '+91-9000000001',
                'avatar'             => 'https://ui-avatars.com/api/?name=Admin+Seeder&size=200',
                'plan'               => 'Free',
                'role'               => 2,
                'slug'               => 'admin-seeder',
                'company'            => 'TheyTrust Seeder',
                'twitter'            => 'adminseeder',
                'linkedin'           => 'https://linkedin.com/in/adminseeder',
                'bio'                => 'Shared owner account for seeded companies.',
                'status'             => 1,
                'email_verified_at'  => now(),
                'password'           => bcrypt('password'),
                'remember_token'     => Str::random(10),
                'created_at'         => now(),
                'updated_at'         => now(),
                'verification_token' => Str::random(32),
                'token_expires_at'   => now()->addDays(30),
            ]);
            $this->command?->info("👤 Owner user created (ID: {$ownerUser->id})");
        } else {
            $this->command?->info("👤 Using existing owner user (ID: {$ownerUser->id})");
        }

        // Build lookup strings for AI prompt
        $industryList  = collect($industries)->map(fn($name, $id) => "{$id}: {$name}")->implode(', ');
        $categoryList  = collect($categories)->map(fn($name, $id) => "{$id}: {$name}")->implode(', ');

        // ─── Step 2: Generate companies via AI ────────────────────────────
        $this->command?->info("🤖 Generating {$companyCount} companies via OpenAI ({$this->model})...");
        $this->command?->newLine();

        for ($idx = 0; $idx < $companyCount; $idx++) {
            try {
                // ── Generate company profile via AI ───────────────────────
                $companyData = $this->generateCompanyViaAI($client, $idx + 1, $companyCount, $industryList, $categoryList);

                if (!$companyData) {
                    $this->command?->warn("⚠ Company #{$idx} — AI returned invalid JSON, skipping.");
                    continue;
                }

                $companyName = $companyData['name'] ?? 'AI Company ' . ($idx + 1);
                $companySlug = Str::slug($companyName);

                // ── Generate & upload logo to Azure ───────────────────────
                $logoPath = $this->generateAndUploadLogo($companyName, $companySlug);

                // ── Insert company ────────────────────────────────────────
                $companyId = DB::table('companies')->insertGetId([
                    'user_id'           => $ownerUser->id,
                    'logo'              => $logoPath,
                    'name'              => $companyName,
                    'website'           => $companyData['website'] ?? 'https://www.' . $companySlug . '.com',
                    'tagline'           => $companyData['tagline'] ?? '',
                    'short_description' => $companyData['short_description'] ?? '',
                    'description'       => $companyData['description'] ?? '',
                    'rate'              => $faker->randomElement($rates),
                    'budget'            => $faker->randomElement($budgets),
                    'size'              => $faker->randomElement($sizeValues),
                    'mobile'            => $companyData['mobile'] ?? $faker->phoneNumber,
                    'email'             => $companyData['email'] ?? strtolower(str_replace(' ', '', $companyName)) . '@gmail.com',
                    'status'            => 1,
                    'founded_at'        => $companyData['founded_at'] ?? (string) rand(2010, 2022),
                    'profile_type'      => 'Premium',
                    'avg_review_score'  => 0,
                    'is_publish'        => 1,
                    'is_flagged'        => 0,
                    'slug'              => $companySlug,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);

                $this->command?->info("✅ Company #{$idx}: {$companyName} (ID: {$companyId})");

                // ── Addresses ─────────────────────────────────────────────
                $addresses = $companyData['addresses'] ?? [];
                if (empty($addresses)) {
                    $addresses = [['city' => $companyData['city'] ?? 'Mumbai', 'state' => $companyData['state'] ?? 'MH', 'country' => $companyData['country'] ?? 'IN', 'address' => 'Office', 'type' => 'Headquarters']];
                }
                foreach ($addresses as $aIdx => $addr) {
                    DB::table('addresses')->insert([
                        'company_id'     => $companyId,
                        'user_id'        => $ownerUser->id,
                        'address'        => $addr['address'] ?? $faker->streetAddress,
                        'city'           => $addr['city'] ?? $faker->city,
                        'state_iso2'     => $addr['state'] ?? $faker->stateAbbr,
                        'country_iso2'   => $addr['country'] ?? 'IN',
                        'zip'            => $addr['zip'] ?? $faker->postcode,
                        'type'           => $aIdx === 0 ? 'Headquarters' : ($addr['type'] ?? 'Branch'),
                        'email'          => $companyData['email'] ?? $faker->email,
                        'mobile'         => $companyData['mobile'] ?? $faker->phoneNumber,
                        'autocomplete'   => ($addr['address'] ?? '') . ', ' . ($addr['city'] ?? ''),
                        'status'         => 1,
                        'is_head_office' => $aIdx === 0 ? 1 : 0,
                        'created_at'     => now(),
                        'updated_at'     => now(),
                    ]);
                }

                // ── Industries ────────────────────────────────────────────
                $companyIndustryIds = $companyData['industry_ids'] ?? [1];
                $indPercents = $this->splitPercent(count($companyIndustryIds));
                foreach ($companyIndustryIds as $i => $indId) {
                    $indId = (int) $indId;
                    if (isset($industries[$indId])) {
                        DB::table('add_industries')->insert([
                            'company_id'  => $companyId,
                            'industry_id' => $indId,
                            'percent'     => $indPercents[$i] ?? 50,
                            'status'      => 1,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ]);
                    }
                }

                // ── Service Lines ─────────────────────────────────────────
                $companyCatIds = $companyData['category_ids'] ?? [42];
                $slPercents = $this->splitPercent(count($companyCatIds));
                foreach ($companyCatIds as $si => $catId) {
                    $catId = (int) $catId;
                    if (isset($categories[$catId])) {
                        $subcatIds = isset($subcatMap[$catId]) ? $subcatMap[$catId]->pluck('id')->toArray() : [];
                        $subcatId  = !empty($subcatIds) ? $faker->randomElement($subcatIds) : 0;

                        DB::table('service_lines')->insert([
                            'company_id'     => $companyId,
                            'category_id'    => $catId,
                            'subcategory_id' => $subcatId,
                            'percent'        => $slPercents[$si] ?? 50,
                            'status'         => 1,
                            'created_at'     => now(),
                            'updated_at'     => now(),
                        ]);
                    }
                }

                // ── Client Sizes ──────────────────────────────────────────
                if (!empty($clientSizeIds)) {
                    $csPercents = $this->splitPercent(count($clientSizeIds));
                    foreach ($clientSizeIds as $ci => $csId) {
                        DB::table('add_client_sizes')->insert([
                            'company_id'     => $companyId,
                            'client_size_id' => $csId,
                            'percent'        => $csPercents[$ci],
                            'status'         => 1,
                            'created_at'     => now(),
                            'updated_at'     => now(),
                        ]);
                    }
                }

                // ── Portfolio Items (AI generated) ────────────────────────
                $portfolios = $companyData['portfolio_items'] ?? [];
                foreach ($portfolios as $p => $pt) {
                    $engStart = Carbon::now()->subMonths(rand(6, 30))->startOfMonth();
                    $engEnd   = (clone $engStart)->addMonths(rand(2, 6))->endOfMonth();

                    // Generate & upload a portfolio screenshot to Azure
                    $portfolioImagePath = $this->generateAndUploadPortfolioImage(
                        $companyName,
                        $companySlug,
                        $pt['title'] ?? 'Project ' . ($p + 1),
                        $p
                    );

                    // media must be a flat JSON array of strings (blade iterates it)
                    $mediaArray = [];
                    if ($portfolioImagePath) {
                        $mediaArray[] = $portfolioImagePath;
                    }

                    $services = $pt['services'] ?? 'Software Development';

                    DB::table('portfolio_items')->insert([
                        'company_id'            => $companyId,
                        'media'                 => json_encode($mediaArray),
                        'project_title'         => $pt['title'] ?? 'Project ' . ($p + 1),
                        'client_name'           => $pt['client_name'] ?? $faker->company,
                        'country_location'      => $pt['country'] ?? $faker->country,
                        'services_provided'     => json_encode([$services]),
                        'short_description'     => $pt['description'] ?? '',
                        'engagement_start_date' => $engStart->toDateString(),
                        'engagement_end_date'   => $engEnd->toDateString(),
                        'position'              => $p + 1,
                        'created_at'            => now(),
                        'updated_at'            => now(),
                    ]);
                }

                $addrCount = count($addresses);
                $portCount = count($portfolios);
                $this->command?->info("   📍 {$addrCount} addresses, 🏭 " . count($companyIndustryIds) . " industries, 📂 {$portCount} portfolio items");

            } catch (\Exception $e) {
                $this->command?->error("❌ Company #{$idx} failed: " . $e->getMessage());
            }

            // Delay to avoid rate-limiting
            usleep(500000); // 500ms
        }

        $this->command?->newLine();
        $this->command?->info("🎉 Done! {$companyCount} AI-generated companies seeded with complete data!");
        $this->command?->info("   Now run: php artisan db:seed --class=CompanyReviewSeeder");
    }

    // ─── AI Generation ───────────────────────────────────────────────────

    private function generateCompanyViaAI($client, int $num, int $total, string $industryList, string $categoryList): ?array
    {
        $companyTypes = [
            'a web development agency from India',
            'a mobile app development company from USA',
            'a digital marketing agency from UK',
            'a cloud consulting firm from India',
            'a UI/UX design studio from India',
            'a data analytics & AI company from Singapore',
            'an IT consulting firm from Canada',
            'an e-commerce development agency from India',
            'a cybersecurity company from UAE',
            'an enterprise software company from India',
            'a SaaS product company from Germany',
            'a fintech software company from Australia',
            'a healthcare IT company from India',
            'a DevOps & infrastructure company from USA',
            'an AR/VR development studio from India',
        ];

        $type = $companyTypes[($num - 1) % count($companyTypes)];

        $prompt = <<<PROMPT
Generate a completely unique and realistic IT/digital services company profile #{$num} of {$total}.

This company should be: {$type}

Available Industries (use these IDs):
{$industryList}

Available Service Categories (use these IDs):
{$categoryList}

Return a single JSON object with these exact keys:

{
  "name": "Realistic company name (e.g. 'Infosys', 'Wipro Digital', 'Razorpay', 'Freshworks' style — NOT generic)",
  "website": "https://www.companyname.com",
  "email": "info@companyname.com",
  "mobile": "realistic phone number with country code",
  "tagline": "A catchy 4-8 word tagline",
  "short_description": "One paragraph (2-3 sentences) describing what the company does",
  "description": "Three detailed paragraphs separated by \\n\\n: (1) Company overview & founding story, (2) Key achievements with specific numbers, (3) Team expertise & methodology",
  "founded_at": "year like 2015",
  "city": "real city name",
  "state": "ISO state/province code (e.g. KA, MH, NY, LDN)",
  "country": "ISO country code (IN, US, GB, etc.)",
  "industry_ids": [pick 2 IDs from available industries above],
  "category_ids": [pick 2 IDs from available categories above],
  "addresses": [
    {"address": "full street address", "city": "city", "state": "state code", "country": "country code", "zip": "postal code", "type": "Headquarters"},
    {"address": "full street address", "city": "different city", "state": "state code", "country": "country code", "zip": "postal code", "type": "Branch"}
  ],
  "portfolio_items": [
    {"title": "specific project title", "client_name": "realistic client company", "country": "country", "services": "service type", "description": "2-3 sentences about this project with measurable results"},
    {"title": "...", "client_name": "...", "country": "...", "services": "...", "description": "..."},
    {"title": "...", "client_name": "...", "country": "...", "services": "...", "description": "..."},
    {"title": "...", "client_name": "...", "country": "...", "services": "...", "description": "..."}
  ]
}

IMPORTANT RULES:
- Company name must be UNIQUE and realistic (like real IT companies on Clutch.co)
- Description must have SPECIFIC numbers (team size, projects delivered, revenue impact)
- Portfolio items must have SPECIFIC measurable outcomes
- Use real city names, real addresses format
- 4 portfolio items minimum
- industry_ids and category_ids must be INTEGERS from the lists above
- Do NOT use placeholder text
PROMPT;

        $response = $client->chat()->create([
            'model'           => $this->model,
            'response_format' => ['type' => 'json_object'],
            'temperature'     => 0.9,
            'max_tokens'      => 2500,
            'messages'        => [
                [
                    'role'    => 'system',
                    'content' => 'You are a business data generator. You create realistic IT company profiles that look like real companies listed on Clutch.co or G2. Always respond with valid JSON only.',
                ],
                [
                    'role'    => 'user',
                    'content' => $prompt,
                ],
            ],
        ]);

        $content = $response->choices[0]->message->content ?? '';
        $data = json_decode($content, true);

        return is_array($data) ? $data : null;
    }

    // ─── Logo Generation & Azure Upload ─────────────────────────────────

    /**
     * Generate a professional logo image and upload it to Azure Blob Storage.
     * Uses ui-avatars.com to create a clean initials-based logo,
     * downloads it, uploads to Azure container, returns the blob path.
     */
    private function generateAndUploadLogo(string $companyName, string $slug): string
    {
        try {
            // Generate initials from company name (max 2 chars)
            $words = explode(' ', trim($companyName));
            $initials = '';
            foreach ($words as $word) {
                $first = substr(trim($word), 0, 1);
                if (ctype_alpha($first)) {
                    $initials .= strtoupper($first);
                }
                if (strlen($initials) >= 2) break;
            }
            if (empty($initials)) $initials = 'CO';

            // Professional color palette for logos
            $colors = [
                ['bg' => '0D8ABC', 'fg' => 'FFFFFF'],
                ['bg' => '2E86AB', 'fg' => 'FFFFFF'],
                ['bg' => '1B4332', 'fg' => 'FFFFFF'],
                ['bg' => '6C3483', 'fg' => 'FFFFFF'],
                ['bg' => 'C0392B', 'fg' => 'FFFFFF'],
                ['bg' => '2C3E50', 'fg' => 'FFFFFF'],
                ['bg' => 'E67E22', 'fg' => 'FFFFFF'],
                ['bg' => '16A085', 'fg' => 'FFFFFF'],
                ['bg' => '8E44AD', 'fg' => 'FFFFFF'],
                ['bg' => '2980B9', 'fg' => 'FFFFFF'],
                ['bg' => '27AE60', 'fg' => 'FFFFFF'],
                ['bg' => 'D35400', 'fg' => 'FFFFFF'],
                ['bg' => '1ABC9C', 'fg' => 'FFFFFF'],
                ['bg' => '34495E', 'fg' => 'FFFFFF'],
                ['bg' => 'E74C3C', 'fg' => 'FFFFFF'],
            ];
            $color = $colors[array_rand($colors)];

            // Download logo from ui-avatars (200x200 PNG, rounded, bold)
            $url = 'https://ui-avatars.com/api/?'
                 . http_build_query([
                       'name'       => $initials,
                       'size'       => 200,
                       'background' => $color['bg'],
                       'color'      => $color['fg'],
                       'bold'       => 'true',
                       'format'     => 'png',
                       'rounded'    => 'true',
                       'font-size'  => '0.45',
                   ]);

            $imageContent = @file_get_contents($url);

            if ($imageContent === false) {
                $this->command?->warn("   ⚠ Logo download failed for {$companyName}, using fallback.");
                return 'logos/default-logo.png';
            }

            // Upload to Azure Blob Storage
            $blobPath = 'logos/' . $slug . '-' . time() . '.png';
            Storage::disk('azure')->put($blobPath, $imageContent);

            $this->command?->info("   🖼 Logo uploaded → {$blobPath}");
            return $blobPath;

        } catch (\Exception $e) {
            $this->command?->warn("   ⚠ Logo upload failed: " . $e->getMessage());
            return 'logos/default-logo.png';
        }
    }

    /**
     * Generate a portfolio screenshot placeholder and upload to Azure.
     * Creates a professional-looking placeholder via placehold.co with project initials.
     */
    private function generateAndUploadPortfolioImage(string $companyName, string $slug, string $projectTitle, int $index): ?string
    {
        try {
            // Use picsum.photos for real stock-quality images (tech/business themed)
            $picsumIds = [180, 60, 0, 1, 26, 48, 119, 160, 186, 201, 3, 20, 42, 137, 366, 403, 429, 447];
            $imgId = $picsumIds[($index + crc32($slug)) % count($picsumIds)];

            $url = "https://picsum.photos/id/{$imgId}/800/500";
            $imageContent = @file_get_contents($url);

            // Fallback to random if specific ID fails
            if ($imageContent === false || strlen($imageContent) < 1000) {
                $url = 'https://picsum.photos/800/500?random=' . $index . time();
                $imageContent = @file_get_contents($url);
            }

            if ($imageContent === false) {
                $this->command?->warn("   ⚠ Portfolio image download failed for: {$projectTitle}");
                return null;
            }

            // Upload to Azure - store under portfolio/ directory
            $blobPath = 'portfolio/' . $slug . '-project-' . ($index + 1) . '-' . time() . '.jpg';
            Storage::disk('azure')->put($blobPath, $imageContent);

            $this->command?->info("   📸 Portfolio image → {$blobPath}");
            return $blobPath;

        } catch (\Exception $e) {
            $this->command?->warn("   ⚠ Portfolio image upload failed: " . $e->getMessage());
            return null;
        }
    }

    // ─── Helpers ──────────────────────────────────────────────────────────

    private function splitPercent(int $count): array
    {
        if ($count <= 0) return [];
        if ($count === 1) return [100];

        $percents  = [];
        $remaining = 100;

        for ($i = 0; $i < $count - 1; $i++) {
            $max = (int) ($remaining - ($count - $i - 1) * 5);
            $val = rand(max(5, (int)($remaining / ($count - $i) * 0.5)), max(10, $max));
            $percents[] = $val;
            $remaining -= $val;
        }
        $percents[] = $remaining;

        return $percents;
    }
}
