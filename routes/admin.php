<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TheaterController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AuthController;


Route::prefix('admin')->group(function () {
    //TODO Sign-in admin
    Route::get('/sign_in', [AdminController::class, 'sign_in']);
    Route::post('/sign_in', [AdminController::class, 'Post_sign_in']);
    Route::get('/sign_out', [AdminController::class, 'sign_out']);
});

Route::prefix('admin')->middleware('admin')->group(function (){
    Route::get('/', [AdminController::class, 'home']);
    Route::get('/filter-by-date', [AdminController::class, 'filter_by_date']);
    Route::get('/statistical-filter', [AdminController::class, 'statistical_filter']);
    Route::get('/statistical-sortby', [AdminController::class, 'statistical_sortby']);
    Route::prefix('movie')->group(function () {
        Route::get('/', [MovieController::class, 'movie']);
        Route::get('/create', [MovieController::class, 'getCreate']);
        Route::post('/create', [MovieController::class, 'postCreate']);
        Route::get('/edit/{id}', [MovieController::class, 'getEdit']);
        Route::post('/edit/{id}', [MovieController::class, 'postEdit']);
        Route::delete('/delete/{id}', [MovieController::class, 'delete']);
        Route::get('/status', [MovieController::class, 'status']);
        Route::get('/search', [MovieController::class, 'searchMovie']);
        Route::get('/moviegenre', [MovieController::class, 'movieGenre']);
        Route::get('/rating', [MovieController::class, 'movieGenre']);
    });

    Route::prefix('rating')->group(function (){
        Route::post('/create', [MovieController::class, 'postCreateRating']);
        Route::post('/edit/{id}', [MovieController::class, 'postEditRating']);
        Route::DELETE('/delete/{id}', [MovieController::class, 'deleteRating']);
    });

    Route::prefix('moviegenre')->group(function (){
        Route::post('/create', [MovieController::class, 'postCreateMovieGenre']);
        Route::post('/edit/{id}', [MovieController::class, 'postEditMovieGenre']);
        Route::get('/status', [MovieController::class, 'statusMovieGenre']);
        Route::DELETE('/delete/{id}', [MovieController::class, 'deleteMovieGenre']);
    });

    Route::prefix('theater')->group(function () {
        Route::get('/', [TheaterController::class, 'theater']);
        Route::post('/create', [TheaterController::class, 'postCreate']);
        Route::post('/edit/{id}', [TheaterController::class, 'postEdit']);
        Route::get('/status', [TheaterController::class, 'status']);
        Route::delete('/delete/{id}', [TheaterController::class, 'delete']);
    });

    Route::prefix('room')->group(function () {
        Route::get('/delete/{id}', [RoomController::class, 'delete']);
        Route::post('/create', [RoomController::class, 'postCreate']);
        Route::post('/edit/{id}', [RoomController::class, 'postEdit']);
        Route::get('/status', [RoomController::class, 'status']);
        Route::get('/', [RoomController::class, 'room']);
    });

    Route::prefix('ticket')->group(function () {
        Route::get('/', [TicketController::class, 'ticket']);
    });

    Route::prefix('prices')->group(function () {
        Route::get('/', [PriceController::class, 'price']);
        Route::post('/edit', [PriceController::class, 'edit']);
    });

    Route::prefix('schedule')->group(function () {
        Route::get('/', [ScheduleController::class, 'schedule']);
        Route::post('/create', [ScheduleController::class, 'postCreate']);
        Route::post('/edit', [ScheduleController::class, 'postEdit']);
        Route::get('/status', [ScheduleController::class, 'status']);
        Route::get('/early_status', [ScheduleController::class, 'early_status']);
        Route::get('/delete/{id}', [ScheduleController::class, 'delete']);
        Route::get('/deleteall', [ScheduleController::class, 'deleteAll']);
    });

    Route::prefix('food')->group(function () {
        Route::get('/', [FoodController::class, 'food']);
        Route::post('/create', [FoodController::class, 'postCreate']);
        Route::post('/edit/{id}', [FoodController::class, 'postEdit']);
        Route::delete('/delete/{id}', [FoodController::class, 'delete']);
        Route::get('/status', [FoodController::class, 'status']);
    });

    Route::prefix('combo')->group(function () {
        Route::get('/', [ComboController::class, 'combo']);
        Route::post('/create', [ComboController::class, 'postCreate']);
        Route::post('/edit/{id}', [ComboController::class, 'postEdit']);
        Route::get('/status', [ComboController::class, 'status']);
        Route::delete('/delete/{id}', [ComboController::class, 'delete']);
    });

    Route::prefix('banners')->group(function () {
        Route::get('/', [BannerController::class, 'banners']);
        Route::post('/create', [BannerController::class, 'postCreate']);
        Route::post('/edit/{id}', [BannerController::class, 'postEdit']);
        Route::delete('/delete/{id}', [BannerController::class, 'delete']);
        Route::get('/status', [BannerController::class, 'status']);
    });

    Route::prefix('info')->group(function () {
        Route::get('/', [AdminController::class, 'info']);
        Route::post('/', [AdminController::class, 'postInfo']);
    });

    Route::prefix('staff')->group(function () {
        Route::get('/', [AdminController::class, 'staff']);
        Route::get('/scanTicket', [StaffController::class, 'scanTicket']);
        Route::post('/create', [AdminController::class, 'postCreateStaff']);
        Route::post('/edit/{id}', [AdminController::class, 'editCreateStaff']);
        Route::post('/checkTicket', [StaffController::class, 'checkTicket']);
        Route::post('/confirmTicket', [StaffController::class, 'confirmTicket']);
        Route::delete('/delete/{id}', [AdminController::class, 'delete']);

    });

    Route::prefix('room')->group(function () {
        Route::get('/delete/{id}', [RoomController::class, 'delete']);
        Route::post('/create', [RoomController::class, 'postCreate']);
        Route::post('/edit/{id}', [RoomController::class, 'postEdit']);
        Route::get('/status', [RoomController::class, 'status']);
        Route::get('/', [RoomController::class, 'room']);
    });

    Route::prefix('seat')->group(function () {
        Route::get('/{id}', [SeatController::class, 'seats']);
        Route::post('/create', [SeatController::class, 'postCreate']);
        Route::post('/edit', [SeatController::class, 'postEdit']);
        Route::get('/on/{id},{room_id}', [SeatController::class, 'on']);
        Route::get('/off/{id},{room_id}', [SeatController::class, 'off']);
        Route::post('/row', [SeatController::class, 'postEditRow']);
        Route::get('/delete/{id}', [SeatController::class, 'delete']);
    });

    Route::prefix('seat')->group(function () {
        Route::get('/{id}', [SeatController::class, 'seats']);
        Route::post('/create', [SeatController::class, 'postCreate']);
        Route::post('/edit', [SeatController::class, 'postEdit']);
        Route::get('/on/{id},{room_id}', [SeatController::class, 'on']);
        Route::get('/off/{id},{room_id}', [SeatController::class, 'off']);
        Route::post('/row', [SeatController::class, 'postEditRow']);
        Route::get('/delete/{id}', [SeatController::class, 'delete']);
    });

    Route::prefix('discount')->group(function () {
        Route::get('/', [DiscountController::class, 'discount']);
        Route::post('/create', [DiscountController::class, 'postCreate']);
        Route::post('/edit/{id}', [DiscountController::class, 'postEdit']);
        Route::get('/status', [DiscountController::class, 'status']);
        Route::delete('/delete/{id}', [DiscountController::class, 'delete']);
    });

    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'news']);
        Route::post('/create', [NewsController::class, 'postCreate']);
        Route::post('/edit/{id}', [NewsController::class, 'postEdit']);
        Route::delete('/delete/{id}', [NewsController::class, 'delete']);
        Route::get('/status', [NewsController::class, 'status']);
    });

    Route::prefix('addUser')->group(function () {
        Route::get('/', [StaffController::class, 'addUser']);
        Route::get('/signUp', [AuthController::class, 'signUp']);
    });

    Route::prefix('buyTicket')->group(function () {
        Route::post('/handleResult', [StaffController::class, 'handleResult']);
        Route::post('/checkUser', [StaffController::class, 'checkUser']);
        Route::post('/checkDiscount', [StaffController::class, 'checkDiscount']);
        Route::post('/create', [StaffController::class, 'createTicket']);
        Route::delete('/delete/{id}', [StaffController::class, 'delete']);
        Route::get('/paymentQR/{ticket_id}', [StaffController::class, 'paymentQR']);
        Route::get('/Success', [StaffController::class, 'Hadpaid']);
        Route::get('/ticket/{schedule_id}', [StaffController::class, 'ticket']);
        Route::get('/', [StaffController::class, 'buyTicket']);
        Route::delete('/', [StaffController::class, 'buyTicket']);

    });

    Route::prefix('user')->group(function () {
        Route::get('/', [AdminController::class, 'user']);
        Route::get('/status', [AdminController::class, 'status']);
        Route::get('/search', [AdminController::class, 'searchUser']);
    });

    Route::post('/ticketCombo/create', [StaffController::class, 'createTicketCombo']);
    Route::prefix('buyCombo')->group(function () {
        Route::get('/', [StaffController::class, 'buyCombo']);
        Route::get('/QR', [StaffController::class, 'paymentQR2']);
        Route::get('/handleResult', [StaffController::class, 'handleResult']);
    });
});
