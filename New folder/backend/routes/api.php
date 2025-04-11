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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::delete('/logout', [AuthenticatedSessionController::class, 'destroy']);
});

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
