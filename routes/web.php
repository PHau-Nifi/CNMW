<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TheaterController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
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

require 'admin.php';

Route::get('/verify-email/{user_id}/{token}/{type}',[AuthController::class,'verify_email'])->name('verify_email');

Route::get('/handle_verify-email',[AuthController::class,'handle_verify_email']);

Route::get('/', [WebController::class, 'home']);

Route::get('/home', [WebController::class, 'home']);

Route::get('/movie/{id}', [WebController::class, 'movieDetails']);

Route::get('/news', [WebController::class, 'news']);
Route::get('/news-detail/{id}',[WebController::class,'news_detail']);

Route::get('/contact', [WebController::class, 'contact']);

Route::get('/login', [WebController::class, 'login']);

Route::get('/register', [WebController::class, 'register']);

Route::post('/signIn', [AuthController::class, 'signIn']);

Route::post('/signUp', [AuthController::class, 'signUp']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/movies', [WebController::class, 'movies']);

Route::get('/movies/filter', [WebController::class, 'movieFilter']);

Route::get('/theater', [WebController::class, 'theater']);

Route::get('/ticket/{schedule_id}', [WebController::class, 'ticket']);

Route::post('/ticketCreate', [WebController::class, 'createTicket']);

Route::get('/ticketPaid/{ticket_id}', [WebController::class, 'ticketPaid'])->name('ticketPaid');

Route::get('/paymentQR/{ticket_id}', [WebController::class, 'paymentQR']);

Route::get('/paymentATM/{ticket_id}', [WebController::class, 'paymentATM']);

Route::get('/search', [WebController::class, 'search']);

Route::get('/profile',[WebController::class,'profile']);

Route::post('/refund-ticket',[WebController::class,'refund_ticket']);

Route::post('/ticketPaid/image',[WebController::class,'ticketPaid_image']);
Route::post('/checkDiscount',[WebController::class,'checkDiscount']);

Route::post('/forgot_password',[AuthController::class,'forgot_password']);