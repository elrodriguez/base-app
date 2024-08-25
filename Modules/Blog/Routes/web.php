<?php

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

use Modules\Blog\Http\Controllers\BlogArticlesController;
use Modules\Blog\Http\Controllers\BlogCategoriesController;

Route::prefix('blog')->group(function () {
    Route::get('/', 'BlogController@index');

    Route::middleware(['auth'])->group(function () {
        Route::middleware(['middleware' => 'permission:blog_dashboard'])
            ->get('/dashboard', 'BlogController@dashboard')
            ->name('blog_dashboard');
        Route::middleware(['middleware' => 'permission:blog_categorias'])
            ->resource('blog-category', BlogCategoriesController::class);
        Route::middleware(['middleware' => 'permission:blog_articulos'])
            ->resource('blog-article', BlogArticlesController::class);
        Route::middleware(['middleware' => 'permission:blog_articulos_editar'])
            ->post('blog-article-update', 'BlogArticlesController@updateArticle')
            ->name('blog-article-update');
        Route::middleware(['middleware' => 'permission:blog_articulos_editar'])
            ->post('upload/article/image', 'BlogArticlesController@updateImage')
            ->name('blog_article_upload_image');
        Route::middleware(['middleware' => 'permission:blog_articulos_editar'])
            ->post('blog-article-upload-image', 'BlogArticlesController@uploadImageCkeditor')
            ->name('blog_article_uploa_image_tiny');
        Route::get('article/{url}/show', [BlogArticlesController::class, 'show'])
            ->name('blog_article_show_studante');
    });
});
