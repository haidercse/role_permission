<?php

namespace App;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\User\Internal\UsersController;
use App\Http\Controllers\RolePermission\RolesController;
use App\Http\Controllers\User\Client\UsersClientController;
use App\Http\Controllers\Notification\ShowNotificationController;


/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great!

// | */
// function hello()
// {}
// if(!function_exists('hello')){
//     dd('OjhHHHHH');
// }else{
//     dd('PJHGGHGGG');
// }

Route::get('/', function () {
    return redirect()->route('users.index');
})->middleware('auth');

//HOME VIEW
Route::resource('home', HomeController::class)->middleware(['auth']);

Route::group(['prefix' => 'user'], function () {
    //Authenticate user change password
    Route::get('change-password', [UsersController::class, 'changePasswordView'])->name('change.password');
    Route::post('change-password/{id}', [UsersController::class, 'changePassword'])->name('change_password.post');

    Route::group(['middleware' => ['auth']], function () {
        //USER
        Route::resource('users', UsersController::class);

        //CLIENT
        Route::resource('clients', UsersClientController::class);

        //ROLES
        Route::resource('roles', RolesController::class);

        //PERMISSIONS
        Route::resource('permissions', PermissionsController::class);


    });
});





//FIREBASE NOTIFICATION
Route::post('/fcm-token', [HomeController::class, 'updateToken'])->name('fcmToken');
// Route::post('/send',[TicketsController::class,'notification'])->name('notification');
require __DIR__ . '/auth.php';



Route::get('seen-notification', [ShowNotificationController::class, 'store'])->name('seen.notification');
Route::get('count-notification', [ShowNotificationController::class, 'index'])->name('count.notification');
