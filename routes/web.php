<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
	return view('welcome');
});


Route::get('/about', function () {
	return view('about');
});

Route::get('/contact', [ContactController::class, 'index'])->name('cont')->middleware('checkAge');


//Category Controller
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('category.all');
Route::post('/category/add', [CategoryController::class, 'Add'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/category/soft_delete/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/permanent_delete/{id}', [CategoryController::class, 'PermanentDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);

// For Brand
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('brand.all');
Route::post('/brand/store', [BrandController::class, 'Store'])->name('brand.store');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

	//$users = User::all();
	$users = DB::table('users')->get();
	//$users = User::get();
		return view('dashboard',compact('users'));
})->name('dashboard');
