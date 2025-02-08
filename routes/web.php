<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ResortController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;


Route::get('/Ocean View/login', function () {
    return view('home.log_in');
});

Route::prefix('Ocean View')->group(
    function () {
        Route::prefix('login/')->group(function () {
            Route::get('ocean_view', [LoginController::class, 'ocean_view'])->name('login.ocean_view');
            Route::get('resort_admin', [LoginController::class, 'resort_admin'])->name('login.resort_admin');
            Route::get('user', [LoginController::class, 'user'])->name('login.user');
            Route::get('user/register', [LoginController::class, 'register'])->name('login.user.register');

            Route::post('user/verify', [LoginController::class, 'user_login_verify'])->name('login.user.verify');
            Route::post('resort_admin/verify', [LoginController::class, 'resort_admin_login_verify'])->name('login.resort_admin.verify');
        });

        Route::prefix('admin')->group(function () {
            Route::get('', [ResortController::class, 'index'])->name('admin.index');
            Route::get('resorts', [ResortController::class, 'resorts'])->name('admin.resorts');
            Route::post('resorts/limit', [ResortController::class, 'resortsWithLimit'])->name('admin.resortswithlimit');

            Route::post('resorts', [ResortController::class, 'store'])->name('admin.resorts.store');
            Route::delete('resorts/{resortID}/destroy', [ResortController::class, 'destroy'])->name('admin.resorts.destroy');
            Route::put('resorts', [ResortController::class, 'update'])->name('admin.resorts.update');

            Route::get('accounts', [AdminUserController::class, 'index'])->name('admin.accounts');
            Route::get('profile', [AdminUserController::class, 'profile'])->name('admin.viewuser');
        });

        Route::prefix('resort-admin')->group(function () {
            Route::get('', [RoomController::class, 'index'])->name('resort_admin.index');
            Route::get('logout', [ResortController::class, 'logout'])->name('resort_admin.logout');
            Route::get('manage', [ResortController::class, 'manage'])->name('resort_admin.manage');
            Route::put('manage', [ResortController::class, 'manage_update'])->name('resort_admin.manage_update');
            Route::get('rooms', [RoomController::class, 'rooms'])->name('resort_admin.rooms');
            Route::put('rooms/{id}/{status}', [RoomController::class, 'room_status'])->name('resort_admin.rooms.status');
            Route::delete('rooms/{id}/destroy', [RoomController::class, 'destroy'])->name('resort_admin.rooms.destroy');
            Route::put('rooms/update', [RoomController::class, 'update'])->name('resort_admin.update');

            Route::get('resort-admin/reservations', [BookingController::class, 'index'])->name('resort_admin.reservations');
        });

        Route::get('', [UserController::class, 'home'])->name('user.index');
        Route::get('about us', [UserController::class, 'home_about_us'])->name('user.index.about_us');
        Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
        Route::put('resorts/{resortID}/rooms', [UserController::class, 'resort_available_rooms'])->name('resort_available_rooms');
        Route::get('resorts/{resortID}/rooms/view-schedule', [UserController::class, 'resort_available_rooms_view'])->name('resort_available_rooms_view');

        Route::get('resorts', [UserController::class, 'resort_lists'])->name('user.resorts');
        Route::get('resorts/{resortID}', [UserController::class, 'resort_details'])->name('user.resort.details');
        Route::post('resorts', [ReviewController::class, 'addReview'])->name('user.add_review');
        Route::put('resorts', [ReviewController::class, 'update'])->name('user.update_review');
        Route::delete('resorts', [ReviewController::class, 'destroy'])->name('user.remove_review');

        Route::get('resorts/{resortID}/rooms', [UserController::class, 'resort_rooms'])->name('user.resort.rooms');
        Route::post('resorts/{resortID}/rooms', [UserController::class, 'bookings_store'])->name('user.resort.rooms.book');

        Route::prefix('user')->group(function () {

            // Route::get('/Ocean View/user/{userID}/chats', [UserController::class, 'chats'])->name('user.chats');
            Route::get('', [UserController::class, 'my_account'])->name('user.my_account');
            Route::get('transcation history', [UserController::class, 'transcation_history'])->name('user.transcation_history');
            Route::get('bookmarks', [UserController::class, 'bookmarks'])->name('user.bookmarks');
            Route::post('bookmarks', [UserController::class, 'add_bookmarks'])->name('user.add_bookmarks');
            Route::delete('{id}/destroy', [UserController::class, 'destroy_bookmak'])->name('user.bookmarks.destroy');
            Route::get('reservations', [UserController::class, 'my_reservations'])->name('user.my_reservations');

            Route::put('update/{id}', [UserController::class, 'update'])->name('update.guest');
        });
    }
);
/*

----------------TO DO------------------
add og descriptions tables
mag start nag bookings table then e refer ang mga data na dapat unique siya within a specific range sa katong date (NOTE IMPORTANTE DAPAT NAA SILAY ID^2 kono KAY PARA IF MABULAG SAME JAPUN SILA OR MA GROUO JAPUN SILA THEN IF DIDTU NA
    SA MAY RETRIEVE BANDA, MAS OKAY NA YUNG  |||||| WHAT IF MAS OKAY IF BY DAY NAALNG JUD. NAA BITAW YUNG ID NA MAGPA GROUP SA ILAHA, I HIMO NAALNG TO AS FOREIGN KEY ANG ILANG ID WITH THE RRANSACTION ID PARA MAKA BOOK JAPUN SILAG MISAG PILA)
owno

*/
