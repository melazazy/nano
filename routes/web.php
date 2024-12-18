<?php

use App\Livewire\Pages\Dashboard;
use App\Livewire\ServiceManagement;
use App\Livewire\Profile\Edit;
use App\Livewire\Profile\Show;
use App\Livewire\ServiceRequest as LivewireServiceRequest;
use App\Livewire\Pages\Goldenspeed;
use Illuminate\Support\Facades\Route;
use App\Livewire\ManageRequests;
use App\Livewire\ManageServices;
use App\Livewire\ManageUsers;
use App\Livewire\ShowService;
use App\Livewire\ServiceCreate;
use App\Livewire\ShowRequest;
use App\Livewire\NotificationManager;
use App\Livewire\StateUpdate;
use App\Livewire\UserManagement;
use App\Livewire\AdminManagement;
use App\Http\Controllers\LocaleController;
use App\Livewire\CompanyInfo;
use App\Livewire\ManageAdmin;
use App\Livewire\Pages\Home;
use App\Livewire\Profile\UpdatePasswordForm;
use App\Http\Controllers\DailyTaskController;

Route::group([], function () {
    // Public Routes
    // Livewire::setUpdateRoute(function ($handle) {
    Route::get('/', Goldenspeed::class)->name('home');
    // Route::get('/', Home::class)->name('home');
    Route::get('/services/{service}', ShowService::class)->name('services.show');
    Route::get('change', [LocaleController::class, 'change'])->name("lang.change");
    Route::get('/run-daily-task', [DailyTaskController::class, 'run']);

    Route::middleware(['auth', 'verified'])->group(function () {
        // Dashboard & Management Routes
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
        Route::get('/manage-requests', ManageRequests::class)->name('manage.requests');
        Route::get('/manage-services', ManageServices::class)->name('manage.services');
        Route::get('/manage-users', ManageUsers::class)->name('manage.users');
        Route::get('/manage-admin', ManageAdmin::class)->name('manage.admin');

        // Service Request Routes
        Route::get('/request-service', LivewireServiceRequest::class)->name('request.service');
        Route::get('/create-service', ServiceCreate::class)->name('create.service');
        Route::get('/create-service/edit/{id}', ServiceCreate::class)->name('services.edit');
        Route::get('/requests/{id}', ShowRequest::class)->name('requests.show');

        // User Management Routes
        Route::get('/user-management', UserManagement::class)->name('users.management');
        Route::get('/user-management/edit/{id}', UserManagement::class)->name('users.edit');
        // Admin Management Routes
        Route::get('/admin-management', AdminManagement::class)->name('admin.management');
        Route::get('/admin-management/edit/{id}', AdminManagement::class)->name('admin.edit');

        // Profile Routes
        Route::get('/profile', Show::class)->name('profile');
        Route::get('/profile/edit', Edit::class)->name('profile.edit');
        // route for update password
        Route::get('/profile/update-password', UpdatePasswordForm::class)->name('profile.update-password');
        // Service Management Routes
        Route::get('/services/manage', ServiceManagement::class)->name('services.manage');

        // Notifications
        Route::get('/notifications', NotificationManager::class)->name('notifications');

        // State Updates
        Route::get('/request/{id}/update', StateUpdate::class)->name('request.update');

        Route::get('/company-info', CompanyInfo::class)->name('company.info');


        // Logout Route
        Route::post('logout', function () {
            auth()->guard('web')->logout();
            session()->invalidate();
            session()->regenerateToken();
            return redirect('/');
        })->name('logout');
    });
});
// });

require __DIR__ . '/auth.php';
