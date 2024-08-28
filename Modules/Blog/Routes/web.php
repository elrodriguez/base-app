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
use Modules\Blog\Http\Controllers\BlogCommentController;

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
        Route::middleware(['middleware' => 'role:Alumno'])
            ->get('article/{url}/show', [BlogArticlesController::class, 'show'])
            ->name('blog_article_show_studante');
        Route::middleware(['middleware' => 'role:Alumno'])
            ->post('comment/store', [BlogCommentController::class, 'store'])
            ->name('blog_comment_store');
        Route::middleware(['middleware' => 'role:Alumno'])
            ->post('comment/appreciate/store', [BlogCommentController::class, 'appreciateStore'])
            ->name('blog_comment_appreciate_store');
        Route::middleware(['middleware' => 'role:Alumno'])
            ->post('comment/reply/store', [BlogCommentController::class, 'storeReply'])
            ->name('blog_comment_reply_store');
        Route::middleware(['middleware' => 'role:Alumno'])
            ->delete('comment/destroy/{id}', [BlogCommentController::class, 'destroy'])
            ->name('blog_comment_destroy');

        Route::middleware(['middleware' => 'role:Alumno'])
            ->get('category/articles/{id}', [BlogCategoriesController::class, 'articlesAll'])
            ->name('blog_category_articles_all');

        Route::middleware(['middleware' => 'role:Alumno'])
            ->get('articles/archives/{year}/{month}', [BlogArticlesController::class, 'articlesArchive'])
            ->name('blog_articles_archive');

        Route::post('articles/search/title', [BlogArticlesController::class, 'searchArticles'])
            ->name('blog_search_articles');
    });
});
