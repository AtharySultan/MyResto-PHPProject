
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\menuContoller;
use App\Http\Controllers\BookTableContoller;
use App\Http\Controllers\aboutContoller;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\DishesControllerA;
use App\Http\Controllers\CategoryControllerA;
use App\Http\Controllers\adminBookingController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminAuthController;


Route::get('/DashboardAdmain/admin/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/DashboardAdmain/admin/register', [AdminAuthController::class, 'register']);

    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login']);
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::get('/Dashboard',[dashboardController::class,'IndexDashboardController'])->name('Dashboard');
    Route::get('/addDishes',[DishesControllerA::class,'CreatDishes'])->name('Dashboard.CreatDishes');
    Route::post('/admin/dishes/store', [DishesControllerA::class, 'store'])->name('admin.dishes.store');
    Route::get('/admin/dishes', [DishesControllerA::class, 'index'])->name('admin.dishes.index');
    Route::get('/admin/dishes/{id}/edit', [DishesControllerA::class, 'edit'])->name('admin.dishes.edit');
    Route::put('/admin/dishes/{id}', [DishesControllerA::class, 'update'])->name('admin.dishes.update');
    Route::get('/delete-dish/{id}', [DishesControllerA::class, 'delete'])->name('admin.dishes.delete');
    Route::get('/showMenu', [DishesControllerA::class, 'showMenu'])->name('Dashboard.showMenu');
    
    
    
    Route::get('/CreatCategory',[CategoryControllerA::class,'CreatCategory'])->name('Dashboard.CreatCategory');
    Route::post('/store-category', [CategoryControllerA::class, 'store'])->name('categories.store');
    Route::get('/delete/{id}', [CategoryControllerA::class, 'delete'])->name('categories.delet');
    Route::get('/categories/edit/{id}', [CategoryControllerA::class, 'edit'])->name('categories.edit');
    Route::put('/categories/update/{id}', [CategoryControllerA::class, 'update'])->name('categories.update');
    
    
    Route::post('/bookings/store', [adminBookingController::class, 'storeReservation'])->name('Dashboard.StoreReservation');
    Route::get('/ManageBook',[adminBookingController::class,'ManageBookFunction'])->name('Dashboard.ManageBook');
    Route::get('/dashboard/bookings/{id}/details',[adminBookingController::class,'ShowBookingDetails'])->name('Dashboard.ShowBookingDetails');
    
    Route::get('/orders', [App\Http\Controllers\AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{id}', [App\Http\Controllers\AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('/orders/{id}', [App\Http\Controllers\AdminOrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('/orders/{id}', [App\Http\Controllers\AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');
    Route::get('/previous-orders', [App\Http\Controllers\AdminOrderController::class, 'previous'])->name('admin.orders.previous');
    Route::get('/completed-orders', [App\Http\Controllers\AdminOrderController::class, 'completed'])->name('admin.orders.completed');
    Route::get('/adminnn', function () {
        return view('admin.showMenu');
    });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




    
Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
});
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    

Route::middleware('auth')->group(function () {
    Route::get('/customer/edit', [ProfileController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/update', [ProfileController::class, 'update'])->name('customer.update');
});

Route::get('/menu',[menuContoller::class,'showMenu'])->name('Customer.menu');
Route::get('/BookTable',[BookTableContoller::class,'BookTable'])->name('Customer.BookTable');
Route::get('/about',[aboutContoller::class,'about'])->name('Customer.about');
Route::get('/profile',[ProfileController::class,'index'])->middleware('auth')->name('customer.profile');
Route::get('/',[IndexController::class,'showIndex'])->name('Customer.index');
Route::get('/order', [orderController::class, 'showOrder'])->name('Customer.order');
Route::get('/checkout', [orderController::class, 'checkOut'])->name('Customer.checkOut');
Route::post('/place-order', [orderController::class, 'placeOrder'])->name('Customer.placeOrder');
Route::get('/orders/{id}', [ProfileController::class, 'showOrder'])->name('order.show');
Route::post('/orders/{order}/cancel', [orderController::class, 'cancel'])->name('order.cancel');
