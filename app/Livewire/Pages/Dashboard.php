<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        if (Auth::user()->is_admin) {
            $stats = $this->getAllStats();
            $recentServices = $this->getRecentServices();
            $recentRequests = $this->getRecentRequests();
            $chartData = $this->getMonthlyRequestStats();
            return view('livewire.pages.dashboard', compact('stats', 'recentServices', 'recentRequests', 'chartData'))->layout('layouts.volt');
        } else {
            $userStats = $this->getUserStats();
            $recentUserRequests = $this->getRecentUserRequests();
            $totals = $this->getAllStats();
            return view('livewire.pages.dashboard', compact('userStats','totals', 'recentUserRequests'))->layout('layouts.volt');
        }
    }

    private function getUserStats()
    {
        $userId = Auth::id();
        return [
            // 'your_services' => Service::where('user_id', $userId)->count(),
            'your_requests' => ServiceRequest::where('user_id', $userId)->count(),
            'your_completed_requests' => ServiceRequest::where('user_id', $userId)->where('status', 'completed')->count(),
            'your_active_requests' => ServiceRequest::where('user_id', $userId)->where('status', 'active')->count(),
            'your_pending_requests' => ServiceRequest::where('user_id', $userId)->where('status', 'pending')->count(),
            'your_cancelled_requests' => ServiceRequest::where('user_id', $userId)->where('status', 'cancelled')->count(),
            'your_in_progress_requests' => ServiceRequest::where('user_id', $userId)->where('status', 'in_progress')->count(),
            'monthly_requests' => $this->getuserMonthlyRequestStats(),
        ];
    }
    private function getAllStats()
    {
        return [
            'total_services' => Service::count(),
            'total_users' => User::where('is_admin', 0)->count(),
            'total_admins' => User::where('is_admin', 1)->count(),
            'total_requests' => ServiceRequest::count(),
            'total_completed_requests' => ServiceRequest::where('status', 'completed')->count(),
            'total_pending_requests' => ServiceRequest::where('status', 'pending')->count(),
            'total_cancelled_requests' => ServiceRequest::where('status', 'canceled')->count(),
            'total_in_progress_requests' => ServiceRequest::where('status', 'in_progress')->count(),
            'monthly_requests' => $this->getallMonthlyRequestStats(),
        ];
    }

    private function getallMonthlyRequestStats()
    {
        $userId = Auth::id();
        $currentYear = date('Y');
        return ServiceRequest::where('user_id', $userId)
            ->whereYear('created_at', $currentYear)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->map(function ($count, $month) {
                return [
                    'month' => date('F', mktime(0, 0, 0, $month, 1)),
                    'count' => $count
                ];
            })
            ->values()
            ->toArray();
    }
    private function getuserMonthlyRequestStats()
    {
        $userId = Auth::id();
        $currentYear = date('Y');
        return ServiceRequest::where('user_id', $userId)
            ->whereYear('created_at', $currentYear)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->map(function ($count, $month) {
                return [
                    'month' => date('F', mktime(0, 0, 0, $month, 1)),
                    'count' => $count
                ];
            })
            ->values()
            ->toArray();
    }

    private function getRecentServices()
    {
        return Service::latest()->take(5)->get();
    }

    private function getRecentRequests()
    {
        return ServiceRequest::with('service', 'user')
            ->latest()
            ->take(5)
            ->get();
    }

    private function getRecentUserRequests()
    {
        $userId = Auth::id();
        return ServiceRequest::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();
    }
    private function getMonthlyRequestStats()
{
    // Initialize an array to hold the counts for each month and status
    $monthlyData = [
        'january_pending' => 0, 'february_pending' => 0, 'march_pending' => 0,
        'april_pending' => 0, 'may_pending' => 0, 'june_pending' => 0,
        'july_pending' => 0, 'august_pending' => 0, 'september_pending' => 0,
        'october_pending' => 0, 'november_pending' => 0, 'december_pending' => 0,
        'january_cancelled' => 0, 'february_cancelled' => 0, 'march_cancelled' => 0,
        'april_cancelled' => 0, 'may_cancelled' => 0, 'june_cancelled' => 0,
        'july_cancelled' => 0, 'august_cancelled' => 0, 'september_cancelled' => 0,
        'october_cancelled' => 0, 'november_cancelled' => 0, 'december_cancelled' => 0,
        'january_completed' => 0, 'february_completed' => 0, 'march_completed' => 0,
        'april_completed' => 0, 'may_completed' => 0, 'june_completed' => 0,
        'july_completed' => 0, 'august_completed' => 0, 'september_completed' => 0,
        'october_completed' => 0, 'november_completed' => 0, 'december_completed' => 0,
        'january_in_progress' => 0, 'february_in_progress' => 0, 'march_in_progress' => 0,
        'april_in_progress' => 0, 'may_in_progress' => 0, 'june_in_progress' => 0,
        'july_in_progress' => 0, 'august_in_progress' => 0, 'september_in_progress' => 0,
        'october_in_progress' => 0, 'november_in_progress' => 0, 'december_in_progress' => 0,
    ];

    // Get the current year
    $currentYear = date('Y');

    // Query for each status and month
    foreach (['pending', 'cancelled', 'completed', 'in_progress'] as $status) {
        $monthlyCounts = ServiceRequest::where('status', $status)
            ->whereYear('created_at', $currentYear)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month');

        // Assign counts to the corresponding month in the monthlyData array
        foreach ($monthlyCounts as $month => $count) {
            $monthName = strtolower(date('F', mktime(0, 0, 0, $month, 1))); // Get month name in lowercase
            $monthlyData["{$monthName}_{$status}"] = $count;
        }
    }

    return $monthlyData;
}
}
