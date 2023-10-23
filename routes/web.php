<?php


use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\KenthaController;
use App\Http\Controllers\CapperuController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\LocalSaleController;
use App\Http\Controllers\ParametersController;
use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use Modules\Blog\Http\Controllers\BlogController;

/* Sitio Webs KENTHA
Route::get('/kentha', [WebController::class, 'index'])->name('cms_principal');
Route::get('/nosotros', [KenthaController::class, 'nosotros'])->name('web_nosotros');
Route::get('/servicios', [KenthaController::class, 'servicios'])->name('web_servicios');
Route::get('/proyectos', [KenthaController::class, 'proyectos'])->name('web_proyectos');
Route::get('/contacto', [KenthaController::class, 'contacto'])->name('web_contacto');
*/

Route::get('/capperu', [WebController::class, 'capperu'])->name('cms_principal');
Route::get('/nosotros', [CapperuController::class, 'nosotros'])->name('web_nosotros');
Route::get('/categorias', [CapperuController::class, 'categorias'])->name('web_categorias');
Route::get('/categoria-sector', [CapperuController::class, 'categoriasector'])->name('web_categoria_sector');
Route::get('/categoria-modalidad', [CapperuController::class, 'categoriamodalidad'])->name('web_categoria_modalidad');
Route::get('/categoria-programa-cursos', [CapperuController::class, 'categoriaprogramacursos'])->name('web_categoria_programa_cursos');
Route::get('/categoria-programa-diplomados', [CapperuController::class, 'categoriaprogramadiplomados'])->name('web_categoria_programa_diplomados');
Route::get('/modalidad-presencial', [CapperuController::class, 'modalidadpresencial'])->name('web_modalidad_presencial');
Route::get('/carrito', [CapperuController::class, 'carrito'])->name('web_carrito');
Route::get('/contacto', [CapperuController::class, 'contacto'])->name('web_contacto');

Route::get('/blog/home', [BlogController::class, 'index'])->name('blog_principal');
Route::get('/article/{url}', [BlogController::class, 'article'])->name('blog_article_by_url');
Route::get('/category/{id}', [BlogController::class, 'category'])->name('blog_category');
Route::get('/policies', [BlogController::class, 'policies'])->name('blog_policies');
Route::get('/contact-us', [BlogController::class, 'contactUs'])->name('blog_contact_us');

Route::get('/stories/article/{url}', [BlogController::class, 'storiesArticle'])->name('blog_stories_article_by_url');
Route::get('/stories/policies', [BlogController::class, 'storiesPolicies'])->name('blog_stories_policies');
Route::get('/stories/contact-us', [BlogController::class, 'storiesContactUs'])->name('blog_stories_contact_us');






Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('clients', ClientController::class);
    Route::resource('users', UserController::class);
    Route::resource('establishments', LocalSaleController::class);
    Route::get(
        'inventory/product/establishment',
        [KardexController::class, 'index']
    )->name('kardex_index');

    Route::post(
        'inventory/product/sizes',
        [KardexController::class, 'kardexDeailsSises']
    )->name('kardex_sizes');

    Route::post(
        'search/person/number',
        [PersonController::class, 'searchByNumberType']
    )->name('search_person_number');

    Route::post(
        'save/person/update/create',
        [PersonController::class, 'saveUpdateOrCreate']
    )->name('save_person_update_create');

    Route::post(
        'search/person/full_name/number',
        [PersonController::class, 'searchByNameOrNumber']
    )->name('search_person_fullname_number');

    Route::get(
        'general/stock',
        [KardexController::class, 'generalStock']
    )->name('generalstock');



    Route::get(
        'company/show',
        [CompanyController::class, 'show']
    )->name('company_show');

    Route::post(
        'company/update_create',
        [CompanyController::class, 'updateCreate']
    )->name('company_update_create');

    Route::get(
        'company/getdata',
        [CompanyController::class, 'getdata']
    )->middleware(['auth', 'verified'])->name('datosempresa');

    Route::get('parameters/list', [ParametersController::class, 'index'])->name('parameters');
    Route::get('parameters/create', [ParametersController::class, 'create'])->name('parameters_create');
    Route::post('parameters/store', [ParametersController::class, 'store'])->name('parameters_store');
});

require __DIR__ . '/auth.php';
