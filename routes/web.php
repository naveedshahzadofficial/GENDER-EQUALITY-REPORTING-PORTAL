<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ {
    HomeController,
    UsersController,
    TargetController,
    VoluntaryNationalReportController,
    ProjectController,
    ProjectTypeController,
    AnnualDevelopmentProjectController,
    IndicatorController,
    PoliceDepartmentViolenceController
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::group(['middleware'=>['auth'] ] ,function() {

    Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth')->name('home');
    Route::get('profile', [UsersController::class, 'profile'])->name('profile');
    Route::post('profile/update', [UsersController::class, 'profileUpdate'])->name('profile.update');
    Route::get('change_password', [UsersController::class, 'changePassword'])->name('change_password');
    Route::post('update_password', [UsersController::class, 'passwordUpdate'])->name('new_password.update');
    Route::resource('users', UsersController::class);
    Route::resource('targets', TargetController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('project-types', ProjectTypeController::class);
    Route::resource('voluntary-national-report', VoluntaryNationalReportController::class);
    Route::post('annual-development-projects/find-project', [AnnualDevelopmentProjectController::class, 'findProject'])->name('annual-development-projects.find-project');
    Route::resource('annual-development-projects', AnnualDevelopmentProjectController::class);
    Route::resource('indicators', IndicatorController::class);
    Route::resource('police-department-violences', PoliceDepartmentViolenceController::class);

});
