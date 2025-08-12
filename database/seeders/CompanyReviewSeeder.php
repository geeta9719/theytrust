<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\Company;
use App\Models\User;
use App\Models\CompanyReview;
use OpenAI\Factory;
use Carbon\Carbon;

class CompanyReviewSeeder extends Seeder
{
    protected $client;
    protected int $reviewsPerCompany = 1;   // change if needed
    protected int $sleepMsBetweenCalls = 250; // to avoid rate limits

    public function __construct()
    {
        Log::info('📌 CompanyReviewSeeder::__construct start');

        $apiKey = env('OPENAI_API_KEY');
        if (!$apiKey) {
            Log::error('❌ OPENAI_API_KEY missing in .env');
        } else {
            Log::info('✅ OPENAI_API_KEY found (not printing for security)');
        }

        try {
            $this->client = (new Factory())
                ->withApiKey($apiKey)
                ->make();
            Log::info('✅ OpenAI client initialized via Factory');
        } catch (\Throwable $e) {
            Log::error('❌ Failed to initialize OpenAI client', ['error' => $e->getMessage()]);
            $this->client = null;
        }

        Log::info('📌 CompanyReviewSeeder::__construct end');
    }

    public function run()
    {
        Log::info('🚀 CompanyReviewSeeder::run started');

        $companyIds = Company::pluck('id', 'id')->all();
        $users      = User::pluck('id', 'id')->all();

        Log::info('📊 Counts', [
            'companies' => count($companyIds),
            'users'     => count($users),
            'reviewsPerCompany' => $this->reviewsPerCompany
        ]);

        if (empty($companyIds) || empty($users)) {
            $this->command?->warn('No companies or users found. Seed those first.');
            Log::warning('⚠️ Aborting: companies or users missing');
            return;
        }

        $inserted = 0; $failed = 0;

        foreach ($companyIds as $companyId) {
            $company = Company::find($companyId);
            if (!$company) {
                Log::warning('⚠️ Company not found by id, skipping', ['company_id' => $companyId]);
                continue;
            }

            Log::info('🏢 Starting company', ['company_id' => $companyId, 'company_name' => $company->name]);

            for ($i = 1; $i <= $this->reviewsPerCompany; $i++) {
                Log::info('🧩 Review loop begin', ['company_id' => $companyId, 'review_idx' => $i]);

                try {
                    $payload = $this->generateReviewViaAI($company);

                    if (empty($payload)) {
                        Log::warning('⚠️ AI payload empty, using fallbacks', [
                            'company_id' => $companyId, 'review_idx' => $i
                        ]);
                    } else {
                        Log::info('✅ AI payload received', [
                            'company_id' => $companyId, 'review_idx' => $i,
                            'keys' => array_keys($payload)
                        ]);
                    }

                    // ensure dates valid
                    [$start, $end] = $this->normalizedDates(
                        $payload['project_start'] ?? null,
                        $payload['project_end'] ?? null
                    );
                    Log::info('📅 Normalized dates', ['start' => $start, 'end' => $end]);

                    $userId = array_rand($users);
                    $row = [
                        'company_id'             => $companyId,
                        'user_id'                => $userId,
                        'project_type'           => $payload['project_type']           ?? 'Web Development',
                        'project_title'          => $payload['project_title']          ?? 'Custom Development Project',
                        'company_type'           => $payload['company_type']           ?? 'Private',
                        'cost_range'             => $payload['cost_range']             ?? '$10000-$50000',
                        'project_start'          => $start,
                        'project_end'            => $end,
                        'company_position'       => $payload['company_position']       ?? 'Project Sponsor',
                        'for_what_project'       => $payload['for_what_project']       ?? 'Website revamp and SEO',
                        'how_select'             => $payload['how_select']             ?? 'Compared 3 vendors; chose for expertise and references.',
                        'scope_of_work'          => $payload['scope_of_work']          ?? 'Discovery, UI/UX, frontend, backend, QA, deployment.',
                        'team_composition'       => $payload['team_composition']       ?? 'PM, 2 FE devs, 2 BE devs, QA, designer.',
                        'any_outcome'           => $payload['any_outcome']           ?? 'Traffic +65%, conversion +22% post launch.',
                        'how_effective'          => $payload['how_effective']          ?? 'Milestone-based delivery with weekly demos; minimal rework.',
                        'most_impressive'        => $payload['most_impressive']        ?? 'Clear communication and proactive risk handling.',
                        'area_of_improvements'   => $payload['area_of_improvements']   ?? 'Add more performance benchmarks pre-release.',
                        'quality'                => $this->clampInt($payload['quality'] ?? 4),
                        'quality_review'         => $payload['quality_review']         ?? 'Code quality and UX were consistently strong.',
                        'timeliness'             => $this->clampInt($payload['timeliness'] ?? 4),
                        'timeliness_review'      => $payload['timeliness_review']      ?? 'Most sprints were delivered on time.',
                        'cost'                   => 3,
                        'cost_review'            => $payload['cost_review']            ?? 'Pricing aligned with scope; transparent change orders.',
                        'communication'          => $this->clampInt($payload['communication'] ?? 5),
                        'communication_review'   => $payload['communication_review']   ?? 'Daily Slack updates and weekly Zoom check-ins.',
                        'expertise'              => $this->clampInt($payload['expertise'] ?? 5),
                        'expertise_review'       => $payload['expertise_review']       ?? 'Deep knowledge of Laravel, React, and SEO.',
                        'ease_of_working'        => $this->clampInt($payload['ease_of_working'] ?? 5),
                        'ease_of_working_review' => $payload['ease_of_working_review'] ?? 'Flexible with scope and quick to respond.',
                        'refer_ability'          => $this->clampInt($payload['refer_ability'] ?? 5),
                        'refer_ability_review'   => $payload['refer_ability_review']   ?? 'Would recommend to peers for ecommerce builds.',
                        'overall_rating'         => $this->clampInt($payload['overall_rating'] ?? 5),
                        'overall_rating_review'  => $payload['overall_rating_review']  ?? 'Exceeded expectations across delivery and ROI.',
                        'full_name'              => $payload['full_name']              ?? 'A. Sharma',
                        'attribution'            => $payload['attribution']            ?? 'GrowthWorks Ltd.',
                        'position_title'         => $payload['position_title']         ?? 'Head of Digital',
                        'company_name'           => $payload['company_name']           ?? ($company->name ?? 'Client Company'),
                        'company_size'           => $payload['company_size']           ?? 'Medium',
                        'city'                   => $payload['city']                   ?? 'Bengaluru',
                        'state'                  => $payload['state']                  ?? 'KA',
                        'country'                => $payload['country']                ?? 'IN',
                        'company_email'          => $payload['company_email']          ?? 'contact@example.com',
                        'phone_number'           => $payload['phone_number']          ?? '+91-9876543210',
                        'linkedin_url'           => $payload['linkedin_url']          ?? 'https://www.linkedin.com/company/example',
                        'company_url'            => $payload['company_url']            ?? 'https://example.com',
                        'status'                 => 1,
                        'project_summary'        => $payload['project_summary']        ?? 'Replatform to Laravel + React with SEO.',
                        'feedback_summary'       => $payload['feedback_summary']       ?? 'Strong ownership, measurable business impact.',
                        'published'              => (string)($payload['published'] ?? '1'),
                        'created_at'             => now(),
                        'updated_at'             => now(),
                        'comment'                => $payload['comment']                ?? 'Detailed scope delivered as planned.',
                    ];

                    Log::info('🧾 Row built (summary)', [
                        'company_id' => $companyId,
                        'review_idx' => $i,
                        'title' => $row['project_title'],
                        'rating' => $row['overall_rating'],
                        'cost' => $row['cost'],
                        'dates' => $row['project_start'] . ' → ' . $row['project_end'],
                    ]);

                    CompanyReview::create($row);

                    $inserted++;
                    Log::info('✅ Review inserted', ['company_id' => $companyId, 'review_idx' => $i]);

                    // rate-limit friendly
                    usleep($this->sleepMsBetweenCalls * 1000);

                } catch (\Throwable $e) {
                    $failed++;
                    Log::error('❌ Review insert failed', [
                        'company_id' => $companyId,
                        'review_idx' => $i,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            Log::info('🏁 Finished company', [
                'company_id' => $companyId,
                'inserted_so_far' => $inserted,
                'failed_so_far' => $failed
            ]);
        }

        Log::info('🎯 Seeding complete', ['inserted' => $inserted, 'failed' => $failed]);
    }

    private function generateReviewViaAI($company): array
    {
        Log::info('🔍 generateReviewViaAI called', ['company' => $company->name ?? 'N/A']);

        if (!$this->client) {
            Log::error('❌ OpenAI client not initialized – returning empty payload');
            return [];
        }
        if (!env('OPENAI_API_KEY')) {
            Log::error('❌ OPENAI_API_KEY missing – returning empty payload');
            return [];
        }

        $companyName  = $company->name ?? 'The Vendor';
        $industryHint = $this->guessIndustryFromServiceLines($company) ?? 'Web Development';
        $prompt       = $this->promptTemplate($companyName, $industryHint);

        try {
            Log::info('📤 Sending chat.create', [
                'model' => 'gpt-4o-mini',
                'company' => $companyName,
                'industry' => $industryHint
            ]);

            $res = $this->client->chat()->create([
                'model' => 'gpt-4o-mini',
                'temperature' => 0.7,
                'messages' => [
                    ['role' => 'system', 'content' => 'You generate realistic B2B client reviews. Return ONLY strict JSON that matches the schema.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'response_format' => ['type' => 'json_object']
            ]);

            // Avoid logging entire object (can be huge); log essentials:
            $content = $res->choices[0]->message->content ?? '{}';
            Log::info('📥 OpenAI response content snippet', ['first_200' => mb_substr($content, 0, 200)]);

            $data = json_decode($content, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('❌ JSON decode error', ['error' => json_last_error_msg()]);
                return [];
            }

            Log::info('✅ AI JSON parsed', ['keys' => array_keys($data)]);
            return is_array($data) ? $data : [];

        } catch (\Throwable $e) {
            Log::error('❌ OpenAI API error', ['error' => $e->getMessage()]);
            return [];
        }
    }

    private function promptTemplate(string $companyName, string $industry): string
    {
        return <<<PROMPT
Write a realistic, first-person client review for "{$companyName}" about a {$industry} engagement.
Keep tone professional, specific, and measurable (traffic, conversion, load time, revenue).
Dates should be plausible within last 2 years. Ratings are integers 1–5.

Return STRICT JSON ONLY with ALL keys:

{
  "project_title": "string (5-9 words)",
  "project_type": "one of: Web Development | Mobile App | Consulting | SEO | PPC | Ecommerce",
  "company_type": "Private or Public",
  "cost_range": "like "$10000-$50000"",
  "project_start": "YYYY-MM-DD",
  "project_end": "YYYY-MM-DD (>= start)",
  "company_position": "string (client role)",
  "for_what_project": "3-7 lines describing the main challenges, pain points, and context before starting the project",
  "how_select": "Write 2–3 sentences explaining the decision-making process in selecting the vendor, including key differentiators such as industry expertise, relevant case studies, cost transparency, responsiveness during the proposal stage, proven track record, and client references."
  "scope_of_work": "Write 2–3 sentences describing the specific services and deliverables provided by the vendor. Mention concrete items such as website redesign, e-commerce setup, SEO optimization, mobile app development, UI/UX design, backend integration, digital marketing campaigns, or analytics implementation, depending on the type of project."
 "team_composition": "2–3 sentences explaining what factors led to the selection of the vendor, such as industry expertise, relevant past work, client references, competitive pricing, responsiveness, or innovative approach."
  "any_outcome": "Write 2–3 sentences explaining how the vendor contributed to the success of the project, mentioning specific actions they took and measurable results (e.g., percentage increase in traffic, sales, engagement, or efficiency gains)."
"how_effective": "Write 2–3 sentences describing the measurable positive impact {$companyName}’s services had on the client’s business, such as increased sales, improved brand awareness, enhanced user engagement, reduced operational costs, or improved efficiency. Include at least one metric or specific example."
"most_impressive": "In 1–2 sentences, state the top three strengths you found most impressive about {$companyName}, and optionally add a short final remark about the overall experience."
 "area_of_improvements": "Write 2 realistic sentence describing a main concern, bottleneck, or improvement area in the project, framed constructively and professionally."
  "quality": 1,
  "quality_review": "4 sentence",
  "timeliness": 1,
  "timeliness_review": "4 sentence",
  "cost": 12000,
  "cost_review": "4 sentence",
  "communication": 1,
  "communication_review": "4 sentence",
  "expertise": 1,
  "expertise_review": "4 sentence",
  "ease_of_working": 1,
  "ease_of_working_review": "4 sentence",
  "refer_ability": 1,
  "refer_ability_review": "4 sentence",
  "overall_rating": 1,
  "overall_rating_review": "4 sentence",
  "full_name": "realistic Indian name",
  "attribution": "client org",
  "position_title": "client job title",
  "company_name": "{$companyName}",
  "company_size": "Small | Medium | Large",
  "city": "city",
  "state": "state/region",
  "country": "country code or name",
  "company_email": "email",
  "phone_number": "phone",
  "linkedin_url": "url",
  "company_url": "url",
  "project_summary": "5 sentence summary",
  "feedback_summary": "5 sentence summary",
  "published": "0 or 1",
  "comment": "short internal note"
}
Rules:
- Dates: end >= start; use recent realistic dates.
- Ratings: integers 1–5; keep overall_rating aligned with others (avg ±1).
- Numbers must be numbers (cost).
PROMPT;
    }

    private function guessIndustryFromServiceLines($company): ?string
    {
        $name = Str::lower($company->name ?? '');
        if (Str::contains($name, ['app', 'mobile'])) return 'Mobile App';
        if (Str::contains($name, ['seo', 'search'])) return 'SEO';
        if (Str::contains($name, ['commerce', 'shop', 'cart'])) return 'Ecommerce';
        return 'Web Development';
    }

    private function normalizedDates($start, $end): array
    {
        try {
            $s = $start ? Carbon::parse($start) : now()->subMonths(rand(6, 18))->startOfMonth();
        } catch (\Throwable $e) {
            Log::warning('⚠️ project_start parse failed; using default', ['err' => $e->getMessage()]);
            $s = now()->subMonths(rand(6, 18))->startOfMonth();
        }
        try {
            $e = $end ? Carbon::parse($end) : (clone $s)->addMonths(rand(2, 6))->endOfMonth();
        } catch (\Throwable $e2) {
            Log::warning('⚠️ project_end parse failed; using default', ['err' => $e2->getMessage()]);
            $e = (clone $s)->addMonths(rand(2, 6))->endOfMonth();
        }
        if ($e->lt($s)) {
            Log::warning('⚠️ project_end < project_start; fixing by +2 months');
            $e = (clone $s)->addMonths(2);
        }
        return [$s->toDateString(), $e->toDateString()];
    }

    private function clampInt($v): int
    {
        $v = (int) $v;
        if ($v < 1) $v = 1;
        if ($v > 5) $v = 5;
        return $v;
    }

    private function clampCost($v): float
    {
        $v = (float) $v;
        if ($v < 1000)   $v = 1000;
        if ($v > 500000) $v = 500000;
        return round($v, 2);
    }
}
