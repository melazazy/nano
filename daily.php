<?php

// Load the Laravel application
require __DIR__.'/bootstrap/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

// Use necessary classes
use Illuminate\Support\Facades\Log;
use App\Models\ServiceRequestModel; // Adjust this to your actual ServiceRequest model
use App\Models\Notification; // Adjust based on your Notification model
use Carbon\Carbon; // For date handling

// Function to notify admins about expiring service requests
function notifyExpiringRequests()
{
    $now = Carbon::now();
    $threshold = $now->copy()->addDays(30); // Notify 3 days before expiry

    // Fetch expiring service requests
    $expiringRequests = ServiceRequestModel::where('expiry_date', '<=', $threshold)
        ->where('expiry_date', '>=', $now)
        ->get();

    foreach ($expiringRequests as $request) {
        // Notify admins
        $adminUsers = User::where('is_admin', true)->get();
        foreach ($adminUsers as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'request_id' => $request->id,
                'en_title' => 'Service Request Expiry Alert',
                'en_message' => "The service request '{$request->id}' is set to expire on {$request->expiry_date}.",
                'ar_title' => 'تنبيه انتهاء طلب الخدمة',
                'ar_message' => "طلب الخدمة '{$request->id}' سينتهي في {$request->expiry_date}.",
                'is_read' => false,
            ]);
        }
    }
    echo "Notifications sent for expiring requests.\n";

    Log::info('Notifications sent for expiring requests.');
}

// Execute the notification function
notifyExpiringRequests();