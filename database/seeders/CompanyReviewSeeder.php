<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\CompanyReview;
use OpenAI\Factory;
use Carbon\Carbon;

class CompanyReviewSeeder extends Seeder
{
    /**
     * Generate realistic reviews for every company using OpenAI (gpt-4o-mini).
     *
     * Usage:
     *   php artisan db:seed --class=CompanyReviewSeeder          → default 5 reviews/company
     *   REVIEWS_PER_COMPANY=20 php artisan db:seed --class=CompanyReviewSeeder
     *
     * Requires OPENAI_API_KEY in .env
     */

    // ─── Configuration ────────────────────────────────────────────────────
    protected string $model = 'gpt-4o-mini';

    // Cached lookup data (loaded once in run())
    protected array $cachedProjectTypes = [];
    protected array $cachedCompanyTypes = [];
    protected array $cachedCompanySizes = [];

    public function run(): void
    {
        $apiKey = env('OPENAI_API_KEY');

        if (empty($apiKey)) {
            $this->command?->error('❌ OPENAI_API_KEY not found in .env — cannot generate reviews.');
            return;
        }

        $client = (new Factory())
            ->withApiKey($apiKey)
            ->withHttpHeader('OpenAI-Beta', 'assistants=v2')
            ->make();

        $reviewsPerCompany = (int) env('REVIEWS_PER_COMPANY', 5);

        // Allow seeding for specific company via SEED_COMPANY_SLUG env
        $companySlug = env('SEED_COMPANY_SLUG', null);
        if ($companySlug) {
            $companies = Company::where('slug', $companySlug)->where('status', 1)->get();
        } else {
            $companies = Company::where('status', 1)->get();
        }

        if ($companies->isEmpty()) {
            $this->command?->error('❌ No companies found. Run CompanySeeder first.');
            return;
        }

        // Get the owner user (seeder user)
        $ownerId = $companies->first()->user_id;

        // Pre-load lookup data once (avoid querying DB inside every review)
        $this->cachedProjectTypes = DB::table('subcategories')->pluck('subcategory')->toArray();
        if (empty($this->cachedProjectTypes)) {
            $this->cachedProjectTypes = ['Search Engine Optimization', 'iOS', 'CMS', 'Content Marketing', 'Brand Strategy & Development'];
        }
        $this->cachedCompanyTypes = DB::table('categories')->where('status', 0)->pluck('category')->toArray();
        if (empty($this->cachedCompanyTypes)) {
            $this->cachedCompanyTypes = ['Web Development', 'Mobile App Development', 'Digital Marketing', 'Traditional Marketing', 'Branding'];
        }
        $this->cachedCompanySizes = DB::table('sizes')->where('status', 1)->pluck('size')->toArray();
        if (empty($this->cachedCompanySizes)) {
            $this->cachedCompanySizes = ['0-10', '10-50', '50-100', '100-200', '200-300'];
        }

        $this->command?->info("🤖 Generating {$reviewsPerCompany} AI reviews for each of {$companies->count()} companies...");
        $this->command?->info("   Model: {$this->model}");
        $this->command?->newLine();

        $totalCreated = 0;

        foreach ($companies as $company) {
            $this->command?->info("📝 {$company->name}...");

            $ratingSum = 0;
            $created   = 0;

            for ($r = 1; $r <= $reviewsPerCompany; $r++) {
                try {
                    $reviewData = $this->generateReviewViaAI($client, $company, $r);

                    if (!$reviewData) {
                        $this->command?->warn("   ⚠ Review #{$r} — AI returned invalid JSON, skipping.");
                        continue;
                    }

                    $projectStart = $this->randomPastDate(6, 24);
                    $projectEnd   = (clone $projectStart)->addMonths(rand(2, 8))->endOfMonth();

                    CompanyReview::create([
                        'company_id'             => $company->id,
                        'user_id'                => $ownerId,
                        'project_type'           => $reviewData['project_type'] ?? 'Web Development',
                        'project_title'          => $reviewData['project_title'] ?? 'Software Development Project',
                        'company_type'           => $reviewData['company_type'] ?? 'Private',
                        'cost_range'             => $reviewData['cost_range'] ?? '$10000-$25000',
                        'project_start'          => $projectStart->toDateString(),
                        'project_end'            => $projectEnd->toDateString(),
                        'company_position'       => $reviewData['company_position'] ?? 'CTO',
                        'for_what_project'       => $reviewData['for_what_project'] ?? '',
                        'how_select'             => $reviewData['how_select'] ?? '',
                        'scope_of_work'          => $reviewData['scope_of_work'] ?? '',
                        'team_composition'       => $reviewData['team_composition'] ?? '',
                        'any_outcomes'           => $reviewData['any_outcomes'] ?? '',
                        'how_effective'          => $reviewData['how_effective'] ?? '',
                        'most_impressive'        => $reviewData['most_impressive'] ?? '',
                        'area_of_improvements'   => $reviewData['area_of_improvements'] ?? '',
                        'quality'                => $this->clampInt($reviewData['quality'] ?? 4),
                        'quality_review'         => $reviewData['quality_review'] ?? '',
                        'timeliness'             => $this->clampInt($reviewData['timeliness'] ?? 4),
                        'timeliness_review'      => $reviewData['timeliness_review'] ?? '',
                        'cost'                   => $this->clampInt($reviewData['cost'] ?? 4),
                        'cost_review'            => $reviewData['cost_review'] ?? '',
                        'communication'          => $this->clampInt($reviewData['communication'] ?? 4),
                        'communication_review'   => $reviewData['communication_review'] ?? '',
                        'expertise'              => $this->clampInt($reviewData['expertise'] ?? 4),
                        'expertise_review'       => $reviewData['expertise_review'] ?? '',
                        'ease_of_working'        => $this->clampInt($reviewData['ease_of_working'] ?? 4),
                        'ease_of_working_review' => $reviewData['ease_of_working_review'] ?? '',
                        'refer_ability'          => $this->clampInt($reviewData['refer_ability'] ?? 4),
                        'refer_ability_review'   => $reviewData['refer_ability_review'] ?? '',
                        'overall_rating'         => $this->clampInt($reviewData['overall_rating'] ?? 4),
                        'overall_rating_review'  => $reviewData['overall_rating_review'] ?? '',
                        'full_name'              => $reviewData['full_name'] ?? 'Anonymous Reviewer',
                        'attribution'            => rand(2, 5),
                        'position_title'         => $reviewData['position_title'] ?? 'Manager',
                        'company_name'           => $reviewData['reviewer_company_name'] ?? 'Tech Corp',
                        'company_size'           => $reviewData['company_size'] ?? 'Medium',
                        'city'                   => $reviewData['city'] ?? 'Mumbai',
                        'state'                  => $reviewData['state'] ?? 'MH',
                        'country'                => $reviewData['country'] ?? 'IN',
                        'company_email'          => $reviewData['company_email'] ?? '',
                        'phone_number'           => $reviewData['phone_number'] ?? '',
                        'linkedin_url'           => $reviewData['linkedin_url'] ?? '',
                        'company_url'            => $reviewData['company_url'] ?? '',
                        'status'                 => 1,
                        'project_summary'        => $reviewData['project_summary'] ?? '',
                        'feedback_summary'       => $reviewData['feedback_summary'] ?? '',
                        'published'              => '1',
                        'comment'                => 'AI-generated review #' . $r . ' for ' . $company->name,
                        'created_at'             => now(),
                        'updated_at'             => now(),
                    ]);

                    $ratingSum += $this->clampInt($reviewData['overall_rating'] ?? 4);
                    $created++;
                    $totalCreated++;

                    $this->command?->info("   ✅ Review #{$r} — {$reviewData['full_name']} ({$reviewData['overall_rating']}/5)");

                } catch (\Exception $e) {
                    $this->command?->error("   ❌ Review #{$r} failed: " . $e->getMessage());
                }

                // Small delay to avoid rate-limiting
                usleep(300000); // 300ms
            }

            // ── Update avg_review_score ───────────────────────────────────
            if ($created > 0) {
                $avgScore = round($ratingSum / $created, 2);
                DB::table('companies')->where('id', $company->id)->update([
                    'avg_review_score' => $avgScore,
                    'updated_at'       => now(),
                ]);
                $this->command?->info("   📊 avg_review_score → {$avgScore} ({$created} reviews)");
            }

            $this->command?->newLine();
        }

        $this->command?->info("🎉 Done! {$totalCreated} AI reviews created across {$companies->count()} companies.");
    }

    // ─── OpenAI Call ──────────────────────────────────────────────────────

    private function generateReviewViaAI($client, Company $company, int $reviewNum): ?array
    {
        $prompt = $this->buildPrompt($company, $reviewNum);

        $response = $client->chat()->create([
            'model'           => $this->model,
            'response_format' => ['type' => 'json_object'],
            'temperature'     => 0.85,
            'max_tokens'      => 2000,
            'messages'        => [
                [
                    'role'    => 'system',
                    'content' => 'You are a professional business reviewer. You write detailed, realistic client reviews for IT and digital services companies. Always respond with valid JSON only.',
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

    // ─── Prompt Builder ───────────────────────────────────────────────────

    private function buildPrompt(Company $company, int $reviewNum): string
    {
        $costRanges = ['$5000-$10000', '$10000-$25000', '$25000-$50000', '$50000-$100000', '$100000-$500000'];

        // Use cached lookup arrays (loaded once in run())
        $projectTypes = $this->cachedProjectTypes;  // subcategories
        $companyTypes = $this->cachedCompanyTypes;  // categories
        $companySizes = $this->cachedCompanySizes;  // sizes

        $positions = ['CTO', 'VP Engineering', 'Head of Digital', 'Product Manager', 'Director of IT', 'CEO', 'Marketing Director', 'COO', 'Founder', 'Head of Operations'];
        $countries = [
            ['country' => 'IN', 'cities' => ['Mumbai', 'Delhi', 'Bengaluru', 'Hyderabad', 'Pune', 'Chennai', 'Kolkata', 'Ahmedabad']],
            ['country' => 'US', 'cities' => ['New York', 'San Francisco', 'Chicago', 'Austin', 'Seattle', 'Boston', 'Los Angeles']],
            ['country' => 'GB', 'cities' => ['London', 'Manchester', 'Birmingham', 'Edinburgh']],
            ['country' => 'SG', 'cities' => ['Singapore']],
            ['country' => 'AE', 'cities' => ['Dubai', 'Abu Dhabi']],
            ['country' => 'CA', 'cities' => ['Toronto', 'Vancouver', 'Montreal']],
        ];

        $loc = $countries[array_rand($countries)];
        $city = $loc['cities'][array_rand($loc['cities'])];
        $costRange = $costRanges[array_rand($costRanges)];
        $projectType = $projectTypes[array_rand($projectTypes)];  // subcategory
        $companyType = $companyTypes[array_rand($companyTypes)];  // category (reviewer's business type)
        $position = $positions[array_rand($positions)];
        $companySize = $companySizes[array_rand($companySizes)];

        return <<<PROMPT
Generate a unique, detailed, and realistic client review #{$reviewNum} for the following company:

**Company Name:** {$company->name}
**Tagline:** {$company->tagline}
**Description:** {$company->short_description}
**Location:** {$company->email}

**Reviewer Context:**
- Reviewer is from: {$city}, {$loc['country']}
- Reviewer's company size: {$companySize}
- Services provided (project type): {$projectType}
- Reviewer's business category: {$companyType}
- Budget range: {$costRange}
- Reviewer position: {$position}

Return a JSON object with these exact keys (all values must be strings except ratings which are integers 1-5):

{
  "project_type": "{$projectType}",
  "project_title": "A specific, realistic project title (not generic)",
  "company_type": "{$companyType}",
  "cost_range": "{$costRange}",
  "company_position": "3-4 sentences describing the reviewer's business (what their company does, industry, size, revenue) and their specific role/responsibilities. Example: 'I am the {$position} at [company name], a mid-sized retail company specializing in premium fashion. We generate approximately $5M in annual revenue with 50+ employees. My role involves overseeing all technology initiatives, vendor relationships, and digital transformation projects.'",
  "for_what_project": "3-4 sentences explaining why they needed this project, the business problem, specific pain points",
  "how_select": "2-3 sentences on how they chose this company over competitors",
  "scope_of_work": "3-4 sentences detailing exact deliverables, technologies, integrations",
  "team_composition": "2-3 sentences describing the team assigned (roles and size)",
  "any_outcomes": "3-4 sentences with specific measurable outcomes (percentages, numbers, metrics)",
  "how_effective": "2-3 sentences on project management, delivery cadence, issue resolution",
  "most_impressive": "2-3 sentences on what stood out the most",
  "area_of_improvements": "1-2 sentences on constructive feedback (realistic, not harsh)",
  "quality": integer 3-5,
  "quality_review": "2 sentences reviewing code/deliverable quality",
  "timeliness": integer 3-5,
  "timeliness_review": "2 sentences reviewing schedule adherence",
  "cost": integer 3-5,
  "cost_review": "2 sentences reviewing value for money",
  "communication": integer 3-5,
  "communication_review": "2 sentences reviewing communication quality",
  "expertise": integer 3-5,
  "expertise_review": "2 sentences reviewing technical expertise",
  "ease_of_working": integer 3-5,
  "ease_of_working_review": "2 sentences reviewing collaboration ease",
  "refer_ability": integer 3-5,
  "refer_ability_review": "2 sentences on likelihood to recommend",
  "overall_rating": integer 3-5,
  "overall_rating_review": "2-3 sentences overall summary",
  "full_name": "A realistic full name matching the reviewer's country ({$loc['country']})",
  "position_title": "{$position}",
  "reviewer_company_name": "A realistic company name from {$city}",
  "company_size": "{$companySize}",
  "city": "{$city}",
  "state": "state/province code",
  "country": "{$loc['country']}",
  "company_email": "realistic email at reviewer's company domain",
  "phone_number": "realistic phone number for {$loc['country']}",
  "linkedin_url": "realistic LinkedIn URL for the reviewer",
  "company_url": "realistic company website URL",
  "project_summary": "2-3 sentence summary of the project and key results",
  "feedback_summary": "2-3 sentence summary of overall feedback"
}

IMPORTANT:
- Make each review UNIQUE — different projects, outcomes, names, companies
- Use realistic metrics and specific numbers (not vague)
- Ratings should mostly be 4-5 but occasionally 3 for realism
- Names should match the country/culture ({$loc['country']})
- Do NOT use placeholder text or lorem ipsum
PROMPT;
    }

    // ─── Helpers ──────────────────────────────────────────────────────────

    private function clampInt($val): int
    {
        return max(1, min(5, (int) $val));
    }

    private function randomPastDate(int $minMonths, int $maxMonths): Carbon
    {
        return Carbon::now()->subMonths(rand($minMonths, $maxMonths))->startOfMonth();
    }
}
