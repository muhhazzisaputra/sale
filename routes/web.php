<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\BankController;
use App\Http\Controllers\Master\SupplierController;
use App\Http\Controllers\Master\CustomerController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\ProductGroupController;
use App\Http\Controllers\MerkController;
use App\Http\Controllers\Product\SizeController;
use App\Http\Controllers\Product\ColorController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\Master\ReportController;

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

Route::get('/testing', [TestingController::class, 'index'])->name('testing')->middleware('auth');
Route::get('/report', [ReportController::class, 'index']);

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/admin', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/bank', [BankController::class, 'index'])->middleware('auth');
Route::get('/bank/read', [BankController::class, 'read'])->middleware('auth');
Route::get('/bank/add', [BankController::class, 'add'])->middleware('auth');
Route::post('/bank/store', [BankController::class, 'store'])->middleware('auth');
Route::get('/bank/show', [BankController::class, 'show'])->middleware('auth');
Route::post('/bank/update', [BankController::class, 'update'])->middleware('auth');
Route::post('/bank/destroy', [BankController::class, 'destroy'])->middleware('auth');
Route::get('/bank/trash', [BankController::class, 'trash'])->middleware('auth');
Route::get('/bank/restore/{id?}', [BankController::class, 'restore'])->middleware('auth');
Route::get('/bank/forceDelete/{id?}', [BankController::class, 'forceDelete'])->middleware('auth');

Route::get('/supplier', [SupplierController::class, 'index'])->middleware('auth');
Route::get('/supplier/read', [SupplierController::class, 'read'])->middleware('auth');
Route::get('/supplier/add', [SupplierController::class, 'add'])->middleware('auth');
Route::post('/supplier/store', [SupplierController::class, 'store'])->middleware('auth');
Route::get('/supplier/show', [SupplierController::class, 'show'])->middleware('auth');
Route::post('/supplier/update', [SupplierController::class, 'update'])->middleware('auth');
Route::post('/supplier/destroy', [SupplierController::class, 'destroy'])->middleware('auth');
Route::get('/supplier/trash', [SupplierController::class, 'trash'])->middleware('auth');
Route::get('/supplier/restore/{id?}', [SupplierController::class, 'restore'])->middleware('auth');
Route::get('/supplier/forceDelete/{id?}', [SupplierController::class, 'forceDelete'])->middleware('auth');

Route::get('/customer', [CustomerController::class, 'index'])->middleware('auth');
Route::get('/customer/read', [CustomerController::class, 'read'])->middleware('auth');
Route::get('/customer/add', [CustomerController::class, 'add'])->middleware('auth');
Route::post('/customer/store', [CustomerController::class, 'store'])->middleware('auth');
Route::get('/customer/show', [CustomerController::class, 'show'])->middleware('auth');
Route::post('/customer/update', [CustomerController::class, 'update'])->middleware('auth');
Route::post('/customer/destroy', [CustomerController::class, 'destroy'])->middleware('auth');
Route::get('/customer/trash', [CustomerController::class, 'trash'])->middleware('auth');
Route::get('/customer/restore/{id?}', [CustomerController::class, 'restore'])->middleware('auth');
Route::get('/customer/forceDelete/{id?}', [CustomerController::class, 'forceDelete'])->middleware('auth');

Route::get('/category', [CategoryController::class, 'index'])->middleware('auth');
Route::get('/category/add', [CategoryController::class, 'add'])->middleware('auth');
Route::get('/category/read', [CategoryController::class, 'read'])->middleware('auth');
Route::post('/category/store', [CategoryController::class,'store'])->middleware('auth');
Route::get('/category/show',[CategoryController::class,'show'])->middleware('auth');
Route::post('/category/update',[CategoryController::class,'update'])->middleware('auth');
Route::post('/category/destroy',[CategoryController::class,'destroy'])->middleware('auth');
Route::get('/category/trash', [CategoryController::class, 'trash'])->middleware('auth');
Route::get('/category/restore/{id?}', [CategoryController::class, 'restore'])->middleware('auth');
Route::get('/category/forceDelete/{id?}', [CategoryController::class, 'forceDelete'])->middleware('auth');

Route::get('/product_group', [ProductGroupController::class, 'index'])->middleware('auth');
Route::get('/product_group/read', [ProductGroupController::class, 'read'])->middleware('auth');
Route::get('/product_group/add', [ProductGroupController::class, 'add'])->middleware('auth');
Route::post('/product_group/store', [ProductGroupController::class,'store'])->middleware('auth');
Route::get('/product_group/show',[ProductGroupController::class,'show'])->middleware('auth');
Route::post('/product_group/update',[ProductGroupController::class,'update'])->middleware('auth');
Route::post('/product_group/destroy',[ProductGroupController::class,'destroy'])->middleware('auth');
Route::get('/product_group/trash', [ProductGroupController::class, 'trash'])->middleware('auth');
Route::get('/product_group/restore/{id?}', [ProductGroupController::class, 'restore'])->middleware('auth');
Route::get('/product_group/forceDelete/{id?}', [ProductGroupController::class, 'forceDelete'])->middleware('auth');

Route::get('/merk/read', [MerkController::class, 'read'])->middleware('auth');
Route::get('/merk/store', [MerkController::class,'store'])->middleware('auth');
Route::get('/merk/show/{id}',[MerkController::class,'show'])->middleware('auth');
Route::get('/merk/update/{id}',[MerkController::class,'update'])->middleware('auth');
Route::get('/merk/destroy/{id}',[MerkController::class,'destroy'])->middleware('auth');
Route::get('/merk/trash', [MerkController::class, 'trash'])->middleware('auth');
Route::get('/merk/restore/{id?}', [MerkController::class, 'restore'])->middleware('auth');
Route::get('/merk/forceDelete/{id?}', [MerkController::class, 'forceDelete'])->middleware('auth');
Route::resource('/merk', MerkController::class)->middleware('auth');

Route::get('/size', [SizeController::class, 'index'])->middleware('auth');
Route::get('/size/add', [SizeController::class, 'create'])->middleware('auth');
Route::get('/size/read', [SizeController::class, 'read'])->middleware('auth');
Route::post('/size/store', [SizeController::class,'store'])->middleware('auth');
Route::get('/size/show',[SizeController::class,'show'])->middleware('auth');
Route::post('/size/update',[SizeController::class,'update'])->middleware('auth');
Route::post('/size/destroy',[SizeController::class,'destroy'])->middleware('auth');
Route::get('/size/trash', [SizeController::class, 'trash'])->middleware('auth');
Route::get('/size/restore/{id?}', [SizeController::class, 'restore'])->middleware('auth');
Route::get('/size/forceDelete/{id?}', [SizeController::class, 'forceDelete'])->middleware('auth');

Route::get('/color', [ColorController::class, 'index'])->middleware('auth');
Route::get('/color/add', [ColorController::class, 'create'])->middleware('auth');
Route::get('/color/read', [ColorController::class, 'read'])->middleware('auth');
Route::post('/color/store', [ColorController::class,'store'])->middleware('auth');
Route::get('/color/show',[ColorController::class,'show'])->middleware('auth');
Route::post('/color/update',[ColorController::class,'update'])->middleware('auth');
Route::post('/color/destroy',[ColorController::class,'destroy'])->middleware('auth');
Route::get('/color/trash', [ColorController::class, 'trash'])->middleware('auth');
Route::get('/color/restore/{id?}', [ColorController::class, 'restore'])->middleware('auth');
Route::get('/color/forceDelete/{id?}', [ColorController::class, 'forceDelete'])->middleware('auth');

// PRODUCT
Route::get('/product/getSlug', [ProductController::class, 'getSlug'])->middleware('auth');
Route::resource('/product', ProductController::class)->middleware('auth');
Route::post('/product/upload', [ProductController::class, 'uploadImage'])->middleware('auth');
Route::get('/product/deleteImage/{id}', [ProductController::class, 'deleteImage'])->middleware('auth');
Route::post('/product/storeVariant', [ProductController::class, 'storeVariant'])->middleware('auth');
Route::post('/product/updateVariant', [ProductController::class, 'updateVariant'])->middleware('auth');
Route::get('/product/showVariant/{id}', [ProductController::class, 'showVariant'])->middleware('auth');
Route::get('/product/deleteVariant/{id}', [ProductController::class, 'deleteVariant'])->middleware('auth');

// Route::get('/image-intervention', [ImageUploadController::class, 'index']);
// Route::post('/upload', [ImageUploadController::class, 'upload']);

// PURCHASE
Route::get('/purchase', [PurchaseController::class, 'index'])->middleware('auth');
Route::get('/purchase/create', [PurchaseController::class, 'create'])->middleware('auth');
Route::get('/purchase/getVariant/{id}', [PurchaseController::class, 'getVariant']);
Route::get('/purchase/chooseProduct', [PurchaseController::class, 'chooseProduct']);
Route::post('/purchase/store',[PurchaseController::class,'store'])->middleware('auth');

//User Group
Route::get('/group', [GroupController::class, 'index'])->middleware('auth');
Route::get('/group/read', [GroupController::class, 'read'])->middleware('auth');
Route::post('/group/store', [GroupController::class,'store'])->middleware('auth');
Route::get('/group/show/{id}',[GroupController::class,'show'])->middleware('auth');
Route::post('/group/update',[GroupController::class,'update'])->middleware('auth');
Route::post('/group/destroy',[GroupController::class,'destroy'])->middleware('auth');
Route::get('/group/trash', [GroupController::class, 'trash'])->middleware('auth');
// Route::get('/size/restore/{id?}', [GroupController::class, 'restore'])->middleware('auth');
// Route::get('/size/forceDelete/{id?}', [GroupController::class, 'forceDelete'])->middleware('auth');