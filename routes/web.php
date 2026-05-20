<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BirthdayCornerController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IpController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login-administrator', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login-administrator', [LoginController::class, 'login'])->middleware('throttle:5,1');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register-administrator', [RegisterController::class, 'showRegister'])->middleware('check.registration.code')->name('register');
Route::post('/register-administrator', [RegisterController::class, 'register']);
Route::post('/verify-registration-code', function (\Illuminate\Http\Request $request) {

    if ($request->code === config('app.registration_code')) {
        session(['registration_code_verified' => true]);
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
})->name('verify.registration.code');

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware('auth')->name('dashboard'); 

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AnnouncementController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/announcements/create', [AnnouncementController::class, 'create'])->name('announcement.create');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcement.store');
    Route::get('/announcement/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcement.edit');
    Route::put('/announcement/{announcement}', [AnnouncementController::class, 'update'])->name('announcement.update');
    Route::delete('/announcement/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');
    Route::get('/announcements/all-announcement', [AnnouncementController::class, 'announcementIndex'])->name('announcement.index');

});
    Route::get('/dashboard/announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcement.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.delete');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::post('/calendar/store', [CalendarController::class, 'store'])->name('calendar.store');
    Route::delete('/calendar/{holiday}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
    Route::put('/calendar/{holiday}', [CalendarController::class, 'update'])->name('calendar.update');
    Route::get('/calendar/{holiday}/edit', [CalendarController::class, 'edit'])->name('calendar.edit');
});

    Route::get('/public-calendar', [CalendarController::class, 'publicIndex'])
        ->name('pages.calendar-view');


Route::middleware(['auth'])->group(function () {
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/departments/store', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/edit/{id}', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::post('/departments/update/{id}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::post('/departments/delete/{id}', [DepartmentController::class, 'destroy'])->name('departments.delete');
    Route::get('/departments/{id}', [DepartmentController::class, 'show'])->name('departments.show');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/departments/employees/create/{department}', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/departments/employees/store', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/departments/employees/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::post('/departments/employees/update/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::post('/departments/employees/delete/{id}', [EmployeeController::class, 'destroy'])->name('employees.delete');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/birthday-corner', [BirthdayCornerController::class, 'index'])->name('birthday.index');
    Route::get('/birthday-corner/create', [BirthdayCornerController::class, 'create'])->name('birthday.create');
    Route::post('/birthday-corner/store', [BirthdayCornerController::class, 'store'])->name('birthday.store');
    Route::get('/birthday-corner/edit/{birthday}', [BirthdayCornerController::class, 'edit'])->name('birthday.edit');
    Route::put('/birthday-corner/update/{birthday}', [BirthdayCornerController::class, 'update'])->name('birthday.update');
    Route::delete('/birthday-corner/delete/{birthday}', [BirthdayCornerController::class, 'destroy'])->name('birthday.delete');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/ip-management', [IpController::class, 'index'])->name('ip.index');
    Route::get('/ip-management/create', [IpController::class, 'create'])->name('ip.create');
    Route::post('/ip-management/store', [IpController::class, 'store'])->name('ip.store');
    Route::get('/ip-management/{id}/edit', [IpController::class, 'edit'])->name('ip.edit');
    Route::put('/ip-management/{id}', [IpController::class, 'update'])->name('ip.update');
    Route::delete('/ip-management/{id}', [IpController::class, 'delete'])->name('ip.delete');
    Route::get('/ip-management/check-ip', [IpController::class, 'checkIp'])->name('ip.check');
});