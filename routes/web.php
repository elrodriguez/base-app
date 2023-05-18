<?php


use App\Http\Controllers\ClientController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\LocalSaleController;
use App\Http\Controllers\PersonController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PettyCashController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use Modules\Blog\Http\Controllers\BlogController;

Route::get('/', [BlogController::class, 'index'])->name('blog_principal');
Route::get('/article/{url}', [BlogController::class, 'article'])->name('blog_article_by_url');
Route::get('/policies', [BlogController::class, 'policies'])->name('blog_policies');
Route::get('/contact-us', [BlogController::class, 'contactUs'])->name('blog_contact_us');

Route::get('/stories/article/{url}', [BlogController::class, 'storiesArticle'])->name('blog_stories_article_by_url');
Route::get('/stories/policies', [BlogController::class, 'storiesPolicies'])->name('blog_stories_policies');
Route::get('/stories/contact-us', [BlogController::class, 'storiesContactUs'])->name('blog_stories_contact_us');

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('pettycash', PettyCashController::class);
    Route::resource('providers', ProviderController::class);

    Route::post(
        'petty/cash/close/{petty_id}',
        [PettyCashController::class, 'close_petty']
    )->name('close_petty_cash');

    Route::post(
        'petty/cash/expense/store',
        [PettyCashController::class, 'store_expense']
    )->name('store_expense');

    Route::resource('sales', SaleController::class);

    Route::get(
        'pdf/sales/ticket/{id}',
        [SaleController::class, 'ticketPdf']
    )->name('ticketpdf_sales');


    Route::post(
        'search/products',
        [ProductController::class, 'searchProduct']
    )->name('search_product');

    Route::post(
        'search/products/all',
        [ProductController::class, 'searchProductAll']
    )->name('search_product_all');

    Route::post(
        'get/product/local/',
        [ProductController::class, 'getProductByLocal']
    )->name('get_product_by_local');

    Route::post(
        'search/scaner/products',
        [ProductController::class, 'searchScanerProduct']
    )->name('search_scaner_product');

    Route::post(
        'show/detail_product',
        [ProductController::class, 'showDetailProduct']
    )->name('show_detail_product');

    Route::post(
        'showdetails/products/{id}',
        [ProductController::class, 'showdetails']
    )->name('showdetails');

    Route::post(
        'input/products',
        [ProductController::class, 'saveInput']
    )->name('input_products');


    Route::resource('clients', ClientController::class);
    Route::resource('users', UserController::class);
    Route::resource('establishments', LocalSaleController::class);


    Route::post(
        'local/series',
        [LocalSaleController::class, 'series']
    )->name('localseriesbyid');

    Route::get(
        'get/locals',
        [LocalSaleController::class, 'get_locals']
    )->name('get_locals');

    Route::resource('series', SerieController::class);

    Route::get(
        'reports/list',
        [ReportController::class, 'index']
    )->name('reports');

    Route::get(
        'reports/saleindate',
        [ReportController::class, 'sales_report']
    )->name('sale_report');

    Route::get(
        'reports/pettycash/{petty_cash_id}/report',
        [ReportController::class, 'PettyCashReport']
    )->name('PettyCashReport');

    Route::get(
        'reports/inventoryindate',
        [ReportController::class, 'inventory_report_export']
    )->name('inventory_report');

    Route::get(
        'reports/inventory/{local_id}',
        [ReportController::class, 'inventory_report_by_local']
    )->name('inventory_report_by_local');

    Route::get(
        'reports/sales/{begin_date}/{end_date}/{download}',
        [ReportController::class, 'sales_report_export']
    )->name('sales_report_export');

    Route::get(
        'reports/sales/by/dates/{start?}/{end?}/{local_id?}/{consulta?}',
        [ReportController::class, 'sales_report_dates']
    )->name('sales_report_dates');

    Route::post(
        'upload/image/product',
        [ProductController::class, 'imageUpload']
    )->name('product_upload_image');

    Route::post(
        'prices/product/bylocal',
        [ProductController::class, 'savePrices']
    )->name('product_prices_establishments');
    Route::get(
        'prices/product/{id}',
        [ProductController::class, 'getPricesProduct']
    )->name('product_prices');

    Route::get(
        'inventory/product/establishment',
        [KardexController::class, 'index']
    )->name('kardex_index');

    Route::post(
        'inventory/product/sizes',
        [KardexController::class, 'kardexDeailsSises']
    )->name('kardex_sizes');



    Route::get(
        'print/sales/user/{date}',
        [SaleController::class, 'printSalesDay']
    )->name('print_sale_user');

    Route::post(
        'relocate/product/sizes',
        [ProductController::class, 'saveRelocate']
    )->name('relocate_product_sizes');

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
        'reports/payment/method/motals',
        [ReportController::class, 'reportPaymentMethodTotals']
    )->name('report_payment_method_totals');

    Route::post(
        'data/payment/method/motals',
        [ReportController::class, 'dataPaymentMethodTotals']
    )->name('data_payment_method_totals');
});

require __DIR__ . '/auth.php';
