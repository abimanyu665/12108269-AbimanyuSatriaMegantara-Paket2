<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
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

Route::middleware('isLogin')->group(function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/create', [ProductController::class, 'create']);
    Route::post('/product/post', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::post('/product/delete/{id}', [ProductController::class, 'destroy']);


    Route::get('/selling', [SalesController::class, 'index']);
    Route::get('/selling/create', [SalesController::class, 'create']);
    Route::post('/selling/post', [SalesController::class, 'store']);
    Route::get('/selling/detail/{id}', [SalesController::class, 'show']);
    Route::get('/selling/download/{id}', [SalesController::class, 'download']);
    Route::post('/selling/delete/{id}', [SalesController::class, 'destroy']);

    Route::get('/user', [AuthController::class, 'index']);
    Route::get('/user/create', [AuthController::class, 'create']);
    Route::post('/user/post', [AuthController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [AuthController::class, 'edit']);
    Route::post('/user/update/{id}', [AuthController::class, 'update'])->name('user.update');
});

Route::middleware('isGuest')->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login/post', [AuthController::class, 'loginInput'])->name('login.post');
});
