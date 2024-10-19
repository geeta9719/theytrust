<?php


namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Faker\Factory as Faker;
// use Illuminate\Http\File;
use Illuminate\Support\Facades\Http; // For Laravel HTTP Client



class PortfolioItemSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        // Step 1: Fetch all company IDs from the companies table
        $companies = DB::table('companies')->pluck('id');

        // Step 2: Loop through each company and create 10 portfolio items
        foreach ($companies as $companyId) {
            foreach (range(1, 4) as $index) {
                
                         // Generate and download a dummy image using Laravel's Http client
                        // //  'logo' => 'https://via.placeholder.com/200x200.png?text=Company+' 
                        //  $imageUrl = 'https://via.placeholder.com/200x200.png?text=Company'; // Dummy image URL from Lorem Picsum
                        $imageUrl = 'https://picsum.photos/200'; 
                         $response = Http::get($imageUrl);
                         
                         if ($response->successful()) {
                             $imageContent = $response->body();
                             $imageName = 'image_' . $index . '.png';
                             $imagePath = Storage::put('media/' . $imageName, $imageContent); // Store in 'media' folder
                         } else {
                             // Handle the error, for example log it
                             \Log::error('Failed to fetch image for portfolio item ' . $index);
                         }
         
                         // Use a locally stored dummy PDF file
                         $pdfPath = Storage::putFileAs('media', new File(public_path('ChatGPT.pdf.pdf')), 'document_' . $index . '.pdf');
         
                         // Random services provided (web, mobile, AI, etc.)
                         $services = ['Web Development', 'Mobile Development', 'AI Solutions', 'Blockchain', 'Cloud Computing'];
         
                         // Generate a random fake YouTube video URL using Faker
                         $fakeYouTubeUrl = 'https://www.youtube.com/watch?v=' . $faker->regexify('[A-Za-z0-9]{11}');

                // Insert YouTube media
                DB::table('portfolio_items')->insert([
                    'company_id' => $companyId,
                    'media' => json_encode([
                        'url' => $fakeYouTubeUrl, // Faker-generated YouTube URL
                        'type' => 'youtube'
                    ]),
                    'project_title' => 'Project ' . $index . ' for Company ' . $companyId,
                    'client_name' => $faker->company, // Use Faker to generate a realistic company name
                    'country_location' => $faker->country, // Use Faker to generate a real country
                    'services_provided' => $faker->randomElement($services), // Randomly pick a service
                    'short_description' => 'This is a short description for project ' . $index,
                    'engagement_start_date' => now()->subDays(rand(1, 365)),
                    'engagement_end_date' => rand(0, 1) ? now() : null,
                    'position' => $index,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Insert File type media (Image)
                DB::table('portfolio_items')->insert([
                    'company_id' => $companyId,
                    'media' => json_encode([
                        'path' => 'media/' . $imageName,
                        'type' => 'file'
                    ]),
                    'project_title' => 'Image Project ' . $index . ' for Company ' . $companyId,
                    'client_name' => $faker->company, // Faker company name
                    'country_location' => $faker->address, // Faker address
                    'services_provided' => $faker->randomElement($services),
                    'short_description' => 'This is a short description for image project ' . $index,
                    'engagement_start_date' => now()->subDays(rand(1, 365)),
                    'engagement_end_date' => rand(0, 1) ? now() : null,
                    'position' => $index + 10,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Insert File type media (PDF)
                DB::table('portfolio_items')->insert([
                    'company_id' => $companyId,
                    'media' => json_encode([
                        'path' => 'media/document_' . $index . '.pdf',
                        'type' => 'file'
                    ]),
                    'project_title' => 'PDF Project ' . $index . ' for Company ' . $companyId,
                    'client_name' => $faker->company, // Faker company name
                    'country_location' => $faker->address, // Faker address
                    'services_provided' => $faker->randomElement($services),
                    'short_description' => 'This is a short description for PDF project ' . $index,
                    'engagement_start_date' => now()->subDays(rand(1, 365)),
                    'engagement_end_date' => rand(0, 1) ? now() : null,
                    'position' => $index + 20,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

