<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MemberListController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\RewardItemController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductSubcategoryController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentMethodController;
use App\Models\User;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::delete('/logout', [AuthenticatedSessionController::class, 'destroy']);
});

// Route::get('/alluser', function () {
//     return User::all();
// });
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);


// Routes
Route::apiResource('Tests', MemberListController::class);
Route::apiResource('Slots', SlotController::class);
Route::match(['put', 'patch'],'/Slot/Generate/{id}', [SlotController::class, 'generateCode']);
Route::apiResource('Memberships', MembershipController::class);
Route::apiResource('ProductCategory', ProductCategoryController::class);
Route::apiResource('ProductSubCategory', ProductSubcategoryController::class);
Route::apiResource('Items', ItemController::class);
Route::apiResource('RewardItems', RewardItemController::class);
Route::apiResource('Codes', CodeController::class);
Route::apiResource('Inventories', InventoryController::class);
Route::apiResource('Carts', CartController::class);
Route::apiResource('OrderItems', OrderItemController::class);
Route::apiResource('Orders', OrdersController::class);
Route::apiResource('PaymentMethods', PaymentMethodController::class);
Route::apiResource('Currencies', CurrencyController::class);
