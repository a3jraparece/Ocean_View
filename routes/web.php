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

Route::get('/Ocean View/login/ocean_view', [LoginController::class, 'ocean_view'])->name('login.ocean_view');
Route::get('/Ocean View/login/resort_admin', [LoginController::class, 'resort_admin'])->name('login.resort_admin');
Route::get('/Ocean View/login/user', [LoginController::class, 'user'])->name('login.user');
Route::get('/Ocean View/login/user/register', [LoginController::class, 'register'])->name('login.user.register');

Route::post('/Ocean View/login/user/verify', [LoginController::class, 'user_login_verify'])->name('login.user.verify');
Route::post('/Ocean View/login/resort_admin/verify', [LoginController::class, 'resort_admin_login_verify'])->name('login.resort_admin.verify');

// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Route::get('/Ocean View/admin', [ResortController::class, 'index'])->name('admin.index');
Route::get('/Ocean View/admin/resorts', [ResortController::class, 'resorts'])->name('admin.resorts');
Route::post('/Ocean View/admin/resorts/limit', [ResortController::class, 'resortsWithLimit'])->name('admin.resortswithlimit');

Route::post('/Ocean View/admin/resorts', [ResortController::class, 'store'])->name('admin.resorts.store');
Route::delete('/Ocean View/admin/resorts/{resortID}/destroy', [ResortController::class, 'destroy'])->name('admin.resorts.destroy');
Route::put('/Ocean View/admin/resorts', [ResortController::class, 'update'])->name('admin.resorts.update');

Route::get('/Ocean View/admin/accounts', [AdminUserController::class, 'index'])->name('admin.accounts');
Route::get('/Ocean View/admin/profile', [AdminUserController::class, 'profile'])->name('admin.viewuser');

// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/Ocean View/resort-admin', [RoomController::class, 'index'])->name('resort_admin.index');
Route::get('/Ocean View/resort-admin/logout', [ResortController::class, 'logout'])->name('resort_admin.logout');
Route::get('/Ocean View/resort-admin/manage', [ResortController::class, 'manage'])->name('resort_admin.manage');
Route::put('/Ocean View/resort-admin/manage', [ResortController::class, 'manage_update'])->name('resort_admin.manage_update');
Route::get('/Ocean View/resort-admin/rooms', [RoomController::class, 'rooms'])->name('resort_admin.rooms');
Route::put('/Ocean View/resort-admin/rooms/{id}/{status}', [RoomController::class, 'room_status'])->name('resort_admin.rooms.status');
Route::delete('/Ocean View/resort-admin/rooms/{id}/destroy', [RoomController::class, 'destroy'])->name('resort_admin.rooms.destroy');
Route::put('/Ocean View/resort-admin/rooms/update', [RoomController::class, 'update'])->name('resort_admin.update');

Route::get('/resort admin/resort-admin/reservations', [BookingController::class, 'index'])->name('resort_admin.reservations');

// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/Ocean View', [UserController::class, 'home'])->name('user.index');
Route::get('/Ocean View/about us', [UserController::class, 'home_about_us'])->name('user.index.about_us');
Route::get('/Ocean View/logout', [UserController::class, 'logout'])->name('user.logout');
Route::put('/Ocean View/resorts/{resortID}/rooms', [UserController::class, 'resort_available_rooms'])->name('resort_available_rooms');
Route::get('/Ocean View/resorts/{resortID}/rooms/view-schedule', [UserController::class, 'resort_available_rooms_view'])->name('resort_available_rooms_view');

Route::get('/Ocean View/resorts', [UserController::class, 'resort_lists'])->name('user.resorts');
Route::get('/Ocean View/resorts/{resortID}', [UserController::class, 'resort_details'])->name('user.resort.details');
Route::post('/Ocean View/resorts', [ReviewController::class, 'addReview'])->name('user.add_review');
Route::put('/Ocean View/resorts', [ReviewController::class, 'update'])->name('user.update_review');
Route::delete('/Ocean View/resorts', [ReviewController::class, 'destroy'])->name('user.remove_review');

Route::get('/Ocean View/resorts/{resortID}/rooms', [UserController::class, 'resort_rooms'])->name('user.resort.rooms');
Route::post('/Ocean View/resorts/{resortID}/rooms', [UserController::class, 'bookings_store'])->name('user.resort.rooms.book');

// Route::get('/Ocean View/user/{userID}/chats', [UserController::class, 'chats'])->name('user.chats');
Route::get('/Ocean View/user', [UserController::class, 'my_account'])->name('user.my_account');
Route::get('/Ocean View/user/transcation history', [UserController::class, 'transcation_history'])->name('user.transcation_history');
Route::get('/Ocean View/user/bookmarks', [UserController::class, 'bookmarks'])->name('user.bookmarks');
Route::post('/Ocean View/user/bookmarks', [UserController::class, 'add_bookmarks'])->name('user.add_bookmarks');
Route::delete('/Ocean View/bookmarks/{id}/destroy', [UserController::class, 'destroy_bookmak'])->name('user.bookmarks.destroy');
Route::get('/Ocean View/user/reservations', [UserController::class, 'my_reservations'])->name('user.my_reservations');

Route::put('/Ocean View/update/{id}', [UserController::class, 'update'])->name('update.guest');
/*

----------------TO DO------------------
add og descriptions tables
mag start nag bookings table then e refer ang mga data na dapat unique siya within a specific range sa katong date (NOTE IMPORTANTE DAPAT NAA SILAY ID^2 kono KAY PARA IF MABULAG SAME JAPUN SILA OR MA GROUO JAPUN SILA THEN IF DIDTU NA
    SA MAY RETRIEVE BANDA, MAS OKAY NA YUNG  |||||| WHAT IF MAS OKAY IF BY DAY NAALNG JUD. NAA BITAW YUNG ID NA MAGPA GROUP SA ILAHA, I HIMO NAALNG TO AS FOREIGN KEY ANG ILANG ID WITH THE RRANSACTION ID PARA MAKA BOOK JAPUN SILAG MISAG PILA)
owno

*/
