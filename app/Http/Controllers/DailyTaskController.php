<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\ServiceRequest; // Adjust this to your actual ServiceRequest model
use App\Models\Notification; // Adjust based on your Notification model
use App\Models\User;
use Carbon\Carbon;

class DailyTaskController extends Controller
{
    public function run()
    {
        $now = Carbon::now();
        $threshold = $now->copy()->addDays(30); // Notify 30 days before expiry

        // Fetch expiring service requests
        $expiringRequests = ServiceRequest::where('expiry_date', '<=', $threshold)
            ->where('expiry_date', '>=', $now)
            ->where('notification_sent', false) // Only get requests that haven't been notified
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
                    'created_at' => now()
                ]);
            }
            // Update the request to mark the notification as sent
        $request->notification_sent = true;
        $request->save();
        }

        Log::info('Notifications sent for expiring requests.');
        return response()->json(['message' => 'Notifications sent for expiring requests.']);
    }
}
