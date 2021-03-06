<?php

  use Illuminate\Support\Facades\Route;
  use App\Http\Controllers\RestTestController;

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

  Auth::routes();
  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


  Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function () {
    Route::resource('posts', '\App\Http\Controllers\Blog\PostController')->names('blog.posts');
  });

  // Админка
  $groupData = [
    'namespace' => 'Blog\Admin',
    'prefix' => 'admin/blog'
  ];
  Route::group($groupData, function () {
    // Категория блога
    $methods = ['index', 'edit', 'update', 'create', 'store'];
    Route::resource('categories', '\App\Http\Controllers\Blog\Admin\CategoryController')
      ->only($methods)
      ->names('blog.admin.categories');
  });

