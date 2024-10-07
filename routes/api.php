<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('apiTesting', function () {
    $data = [
        'message' => 'Api testing'
    ];
    return response()->json($data, 200);
});

// GET
Route::get('product/list', [RouteController::class, 'productList']);
Route::get('delete/product/{id}', [RouteController::class, 'deleteProduct']);
Route::get('category/list', [RouteController::class, 'categoryList']);
Route::get('category/list/{id}', [RouteController::class, 'categoryDetails']);
Route::get('delete/category/{id}', [RouteController::class, 'deleteCategory']);
Route::get('contact/list', [RouteController::class,'contactList']);
Route::get('delete/contact/{id}', [RouteController::class,'deleteContact']);

// POST
Route::post('create/category', [RouteController::class, 'createCategory']);
Route::post('create/product', [RouteController::class,'createProduct']);
Route::post('create/contact', [RouteController::class, 'createContact']);
Route::post('update/category', [RouteController::class,'updateCategory']);
Route::post('update/product', [RouteController::class,'updateProduct']);
Route::post('update/contact', [RouteController::class,'updateContact']);


/*

product list
localhost:8000/api/product/list (GET)

category list
localhost:8000/api/category/list (GET)

create category
localhost:8000/api/create/category (POST)
body{
    'name': ''
}

category detail
localhost:8000/api/category/details/{id} (GET)

delete category
localhost:8000/api/delete/category/{id} (GET)

update category
localhost:8000/api/update/category (POST)
key => category_name, category_id

*/
