<?php

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
//url: public/login
Route::get('login',function(){
    return view('backend.login');
});
//sau khi an nut submit login
Route::post('login',function(){
    $email = request("email");
    $password = request("password");
    //Auth::Attempt -> tra ve true neu email, password khop voi bang users
    if(Auth::Attempt(["email"=>$email,"password"=>$password]))
        return redirect(url('admin/users'));
    else
        return redirect(url('login'));
});
//url: public/logout -> dang xuat
Route::get("logout",function(){
    Auth::logout(); //Auth la doi tuong co san cua laravel
    return redirect(url('login'));//di chuyen den mot url khac
});

//khai bao cac class controller o day
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\NewsController;
Route::group(["prefix"=>"admin","middleware"=>"checklogin"],function(){
    //---
    //chuc nang users - CRUD
    //read
    Route::get("users",[UsersController::class,"read"]);
    //update - GET
    Route::get("users/update/{id}",[UsersController::class,"update"]);
    //update - POST
    Route::post("users/update/{id}",[UsersController::class,"updatePost"]);
    //create - GET
    Route::get("users/create",[UsersController::class,"create"]);
    //create - POST
    Route::post("users/create",[UsersController::class,"createPost"]);
    //delete
    Route::get("users/delete/{id}",[UsersController::class,"delete"]);
    //---
    //---
    //chuc nang news - CRUD
    //read
    Route::get("news",[NewsController::class,"read"]);
    //update - GET
    Route::get("news/update/{id}",[NewsController::class,"update"]);
    //update - POST
    Route::post("news/update/{id}",[NewsController::class,"updatePost"]);
    //create - GET
    Route::get("news/create",[NewsController::class,"create"]);
    //create - POST
    Route::post("news/create",[NewsController::class,"createPost"]);
    //delete
    Route::get("news/delete/{id}",[NewsController::class,"delete"]);
    //---

    //---
    //chuc nang categories - CRUD
    //read
    Route::get("categories",[CategoriesController::class,"read"]);
    //update - GET
    Route::get("categories/update/{id}",[CategoriesController::class,"update"]);
    //update - POST
    Route::post("categories/update/{id}",[CategoriesController::class,"updatePost"]);
    //create - GET
    Route::get("categories/create",[CategoriesController::class,"create"]);
    //create - POST
    Route::post("categories/create",[CategoriesController::class,"createPost"]);
    //delete
    Route::get("categories/delete/{id}",[CategoriesController::class,"delete"]);
    //---
});
//frontend
//trang chu
Route::get('/', function () {
    return view('frontend.home');
});
//trang danh muc
Route::get('news/category/{category_id}', function ($category_id) {
    return view('frontend.newscategory',["category_id"=>$category_id]);
});
//trang chi tiet
Route::get('news/detail/{id}', function ($id) {
    return view('frontend.newsdetail',["id"=>$id]);
});