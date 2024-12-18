<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Service;
use Carbon\Carbon;

class RequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        DB::table('requests')->delete();

        // Get existing users and services (assumes you have these models and some data)
        $users = User::all();
        $services = Service::all();

        // Create sample requests
        $requests = [
            [
                'user_id' => $users->random()->id,
                'service_id' => $services->random()->id,
                'status' => 'pending',
                'notes' => 'Initial request for service consultation',
                'documents' => json_encode([
                    'initial_document.pdf',
                    'supporting_evidence.docx'
                ]),
                'price' => 250.00,
                'expiry_date' => Carbon::now()->addDays(30),
            ],
            [
                'user_id' => $users->random()->id,
                'service_id' => $services->random()->id,
                'status' => 'in_progress',
                'notes' => 'Ongoing review and processing',
                'documents' => json_encode([
                    'progress_report.pdf'
                ]),
                'price' => 500.50,
                'expiry_date' => Carbon::now()->addDays(45),
            ],
            [
                'user_id' => $users->random()->id,
                'service_id' => $services->random()->id,
                'status' => 'completed',
                'notes' => 'Service successfully delivered',
                'documents' => json_encode([
                    'final_report.pdf',
                    'completion_certificate.docx'
                ]),
                'price' => 1000.75,
                'expiry_date' => Carbon::now()->subDays(7),
            ],
            [
                'user_id' => $users->random()->id,
                'service_id' => $services->random()->id,
                'status' => 'expired',
                'notes' => 'Request time limit exceeded',
                'documents' => null,
                'price' => 175.25,
                'expiry_date' => Carbon::now()->subDays(15),
            ],
        ];

        // Insert the sample requests
        DB::table('requests')->insert($requests);
    }
}
