<?php

use App\Http\Controllers\Admin\AdminAccountSettingsController;
use App\Http\Controllers\Admin\AdminApplicationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminUserManagementController;
use App\Http\Controllers\Employer\EmployerAccountSettingsController;
use App\Http\Controllers\Employer\EmployerApplicationController;
use App\Http\Controllers\Employer\EmployerDashboardController;
use App\Http\Controllers\Employer\EmployerJobController;
use App\Http\Controllers\Employer\EmployerProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobSeeker\BookmarkController;
use App\Http\Controllers\JobSeeker\JobSeekerAccountSettingsController;
use App\Http\Controllers\JobSeeker\JobSeekerApplicationController;
use App\Http\Controllers\JobSeeker\JobSeekerJobController;
use App\Http\Controllers\JobSeeker\JobSeekerProfileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::middleware('guest')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/jobs', [JobSeekerJobController::class, 'index'])->name('job_seeker.jobs.index');
});


Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {

        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('jobs', [AdminJobController::class, 'index'])->name('admin.jobs');
        Route::get('applications', [AdminApplicationController::class, 'index'])->name('admin.applications.index');
        Route::get('applications/{jobs}', [AdminApplicationController::class, 'show'])->name('admin.applications.show');
        Route::get('applications/{application}/applicant', [AdminApplicationController::class, 'showApplicant'])->name('admin.application.applicant.show');

        Route::get('profile', [AdminProfileController::class, 'index'])->name('admin.profile.index');
        Route::put('/profile/{user}/update', [AdminProfileController::class, 'updateProfile'])->name('admin.profile.update');

        Route::get('account_settings', [AdminAccountSettingsController::class, 'index'])->name('admin.account_settings.index');
        Route::put('account_settings/password/update', [AdminAccountSettingsController::class, 'changePassword'])->name('admin.account_settings.change_password');


        Route::get('manage_user', [AdminUserManagementController::class, 'index'])->name('admin.manage_users.index');
        Route::get('manage_user/{user}/edit', [AdminUserManagementController::class, 'edit'])->name('admin.manage_users.edit');
        Route::put('manage_user/{user}/update', [AdminUserManagementController::class, 'update'])->name('admin.manage_users.update');
    });

    Route::group(['middleware' => ['employer'], 'prefix' => 'employer'], function () {

        Route::get('dashboard', [EmployerDashboardController::class, 'index'])->name('employer.dashboard');

        Route::resource('jobs', EmployerJobController::class)->names([
            'index' => 'employer.jobs.index',      // Rename the index route
            'create' => 'employer.jobs.create',    // Rename the create route
            'store' => 'employer.jobs.store',      // Rename the store route
            'show' => 'employer.jobs.show',        // Rename the show route
            'edit' => 'employer.jobs.edit',        // Rename the edit route
            'update' => 'employer.jobs.update',    // Rename the update route
            'destroy' => 'employer.jobs.destroy',  // Rename the destroy route
        ]);

        Route::get('applications', [EmployerApplicationController::class, 'index'])->name('employer.applications.index');

        Route::get('applications/{jobs}', [EmployerApplicationController::class, 'show'])->name('employer.applications.show');

        Route::get('applications/{application}/applicant', [EmployerApplicationController::class, 'showApplicant'])->name('employer.application.applicant.show');

        Route::get('applications/{application}/applicant/edit', [EmployerApplicationController::class, 'edit'])->name('employer.application.applicant.edit');

        Route::put('applications/{application}/applicant/update', [EmployerApplicationController::class, 'update'])->name('employer.application.applicant.update');

        Route::get('profile', [EmployerProfileController::class, 'index'])->name('employer.profile.index');
        Route::put('/profile/{user}/update', [EmployerProfileController::class, 'updateProfile'])->name('employer.profile.update');
        Route::put('/profile/company_profile/{user}/update', [EmployerProfileController::class, 'updateCompanyProfile'])->name('employer.profile.company_profile.update');

        Route::get('account_settings', [EmployerAccountSettingsController::class, 'index'])->name('employer.account_settings.index');
        Route::put('account_settings/password/update', [EmployerAccountSettingsController::class, 'changePassword'])->name('employer.account_settings.change_password');
    });



    Route::group(['middleware' => ['job_seeker'], 'prefix' => 'job_seeker'], function () {


        Route::get('/profile', [JobSeekerProfileController::class, 'index'])->name('job_seeker.profile.index');
        Route::put('/profile/{user}/update', [JobSeekerProfileController::class, 'updateProfile'])->name('job_seeker.profile.update');
        Route::post('profile/education', [JobSeekerProfileController::class, 'addEducation'])->name('job_seeker.profile.education.store');
        Route::put('profile/{user}/education', [JobSeekerProfileController::class, 'updateEducation'])->name('job_seeker.profile.education.update');
        Route::put('profile/{user}/resume', [JobSeekerProfileController::class, 'addResume'])->name('job_seeker.profile.resume.store');
        Route::post('/profile/{user}/skill', [JobSeekerProfileController::class, 'addSkill'])->name('job_seeker.profile.skill.store');
        Route::delete('/profile/{skill}/skill', [JobSeekerProfileController::class, 'deleteSkill'])->name('job_seeker.profile.skill.destroy');


        Route::get('/job/{job}', [JobSeekerJobController::class, 'show'])->name('job_seeker.jobs.show');
        Route::get('bookmark', [BookmarkController::class, 'index'])->name('bookmark.index');
        Route::post('job/{job}/bookmark', [BookmarkController::class, 'store'])->name('bookmark.store');
        Route::delete('bookmark/{id}', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');

        Route::get('application', [JobSeekerApplicationController::class, 'index'])->name('job_seeker.application.index');
        Route::post('application/{job}', [JobSeekerApplicationController::class, 'store'])->name('job_seeker.application.store');
        Route::get('application/{application}', [JobSeekerApplicationController::class, 'show'])->name('job_seeker.application.show');
        Route::put('application/{id}/withdrawn', [JobSeekerApplicationController::class, 'withdrawn'])->name('job_seeker.application.withdrawn');

        Route::get('account_settings', [JobSeekerAccountSettingsController::class, 'index'])->name('job_seeker.account_settings.index');
        Route::put('account_settings/password/update', [JobSeekerAccountSettingsController::class, 'changePassword'])->name('job_seeker.account_settings.change_password');
    });
});
