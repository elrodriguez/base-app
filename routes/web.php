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
use App\Mail\StudentRegistrationMailable;
use Illuminate\Support\Facades\Mail;
use Modules\Blog\Http\Controllers\BlogController;

/* Sitio Webs KENTHA
Route::get('/kentha', [WebController::class, 'index'])->name('cms_principal');
Route::get('/nosotros', [KenthaController::class, 'nosotros'])->name('web_nosotros');
Route::get('/servicios', [KenthaController::class, 'servicios'])->name('web_servicios');
Route::get('/proyectos', [KenthaController::class, 'proyectos'])->name('web_proyectos');
Route::get('/contacto', [KenthaController::class, 'contacto'])->name('web_contacto');
*/

Route::get('/test-image/{content}/{fecha?}', [WebController::class, 'testimage'])->name('test-image');
Route::get('/capperu', [WebController::class, 'capperu'])->name('cms_principal');
Route::get('/nosotros', [CapperuController::class, 'nosotros'])->name('web_nosotros');
Route::get('/categoria-sector/{sector}', [CapperuController::class, 'categoriasector'])->name('web_categoria_sector');
Route::get('/categoria-modalidad', [CapperuController::class, 'categoriamodalidad'])->name('web_categoria_modalidad');
Route::get('/categoria-modalidad-en-vivo', [CapperuController::class, 'categoriamodalidadenvivo'])->name('web_categoria_modalidad_en_vivo');
Route::get('/categoria-modalidad-e-learning', [CapperuController::class, 'categoriamodalidadelearning'])->name('web_categoria_modalidad_e_learning');
Route::get('/categoria-programa-cursos', [CapperuController::class, 'categoriaprogramacursos'])->name('web_categoria_programa_cursos');
Route::get('/categoria-programa-diplomados', [CapperuController::class, 'categoriaprogramadiplomados'])->name('web_categoria_programa_diplomados');
Route::get('/modalidad-presencial', [CapperuController::class, 'modalidadpresencial'])->name('web_modalidad_presencial');
Route::get('/sectors/{sector}/{tipo}', [CapperuController::class, 'sector_programs'])->name('web_sectors');
Route::get('/descripcion-programa/{id}', [CapperuController::class, 'descripcionPrograma'])->name('web_descripcion_programa'); //describe cursos, diplomados, e-learning o en vivo
Route::get('/descripcion-e-learning', [CapperuController::class, 'descripcionelearning'])->name('web_descripcion_e_learning');
Route::get('/perfil-docente/{teacher_id}', [CapperuController::class, 'perfildocente'])->name('web_perfil_docente');
Route::get('/carrito', [CapperuController::class, 'carrito'])->name('web_carrito');
Route::get('/pagar', [CapperuController::class, 'pagar'])->name('web_pagar');
Route::get('/gracias/{sale_id}', [CapperuController::class, 'gracias'])->name('web_gracias');

Route::get('/convenios', [CapperuController::class, 'convenios'])->name('web_convenios');
Route::get('/contacto', [CapperuController::class, 'contacto'])->name('web_contacto');


Route::get('/categorias', [CapperuController::class, 'categorias'])->name('web_categorias');



Route::get('/download/brochure/{id}', [CapperuController::class, 'download_brochure'])->name('download_brochure');

Route::get('/blog/home', [BlogController::class, 'index'])->name('blog_principal');
Route::get('/article/{url}', [BlogController::class, 'article'])->name('blog_article_by_url');
Route::get('/category/{id}', [BlogController::class, 'category'])->name('blog_category');
Route::get('/policies', [BlogController::class, 'policies'])->name('blog_policies');
Route::get('/contact-us', [BlogController::class, 'contactUs'])->name('blog_contact_us');

Route::get('/stories/article/{url}', [BlogController::class, 'storiesArticle'])->name('blog_stories_article_by_url');
Route::get('/stories/policies', [BlogController::class, 'storiesPolicies'])->name('blog_stories_policies');
Route::get('/stories/contact-us', [BlogController::class, 'storiesContactUs'])->name('blog_stories_contact_us');


Route::get('/mipais', function () {
    $ip = $_SERVER['REMOTE_ADDR']; // Esto contendrá la ip de la solicitud.

    // Puedes usar un método más sofisticado para recuperar el contenido de una página web con PHP usando una biblioteca o algo así
    // Vamos a recuperar los datos rápidamente con file_get_contents
    $dataArray = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

    //var_dump($dataArray);

    dd($dataArray);
});

Route::get('/email', function () {
    Mail::to('elrodriguez2423@gmail.com')
        ->send(new StudentRegistrationMailable('data'));
    return 'mensaje enviado';
});

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
	
	Route::delete('establishments/destroies/{id}', [LocalSaleController::class, 'destroy'])->name('establishment_destroies');
    Route::post('establishments/updated', [LocalSaleController::class, 'update'])->name('establishment_updated');
	
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
