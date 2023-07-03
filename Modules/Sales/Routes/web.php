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

use Illuminate\Support\Facades\Route;
use Modules\Sales\Http\Controllers\PettyCashController;
use Modules\Sales\Http\Controllers\ProductController;
use Modules\Sales\Http\Controllers\ProviderController;
use Modules\Sales\Http\Controllers\ReportController;
use Modules\Sales\Http\Controllers\SaleController;
use Modules\Sales\Http\Controllers\SaleDocumentController;

Route::middleware(['auth', 'verified'])->prefix('sales')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('pettycash', PettyCashController::class);
    Route::resource('providers', ProviderController::class);

    Route::post('petty/cash/close/{petty_id}', [PettyCashController::class, 'close_petty'])->name('close_petty_cash');

    Route::post('petty/cash/expense/store', [PettyCashController::class, 'store_expense'])->name('store_expense');

    Route::resource('sales', SaleController::class);

    Route::get('pdf/sales/ticket/{id}', [SaleController::class, 'ticketPdf'])->name('ticketpdf_sales');

    Route::post('search/products', [ProductController::class, 'searchProduct'])->name('search_product');

    Route::post('search/products/all', [ProductController::class, 'searchProductAll'])->name('search_product_all');

    Route::post('get/product/local/', [ProductController::class, 'getProductByLocal'])->name('get_product_by_local');

    Route::post('search/scaner/products', [ProductController::class, 'searchScanerProduct'])->name('search_scaner_product');

    Route::post('show/detail_product', [ProductController::class, 'showDetailProduct'])->name('show_detail_product');

    Route::post('showdetails/products/{id}', [ProductController::class, 'showdetails'])->name('showdetails');

    Route::post('input/products', [ProductController::class, 'saveInput'])->name('input_products');

    Route::post('local/series', [LocalSaleController::class, 'series'])->name('localseriesbyid');

    Route::get('get/locals', [LocalSaleController::class, 'get_locals'])->name('get_locals');

    Route::resource('series', SerieController::class);

    Route::get('reports/list', [ReportController::class, 'index'])->name('reports');
    Route::get('reports/sales/by/dates/{start?}/{end?}/{local_id?}/{consulta?}', [ReportController::class, 'sales_report_dates'])->name('sales_report_dates');

    Route::post('upload/image/product', [ProductController::class, 'imageUpload'])->name('product_upload_image');

    Route::post('prices/product/bylocal', [ProductController::class, 'savePrices'])->name('product_prices_establishments');

    Route::get('prices/product/{id}', [ProductController::class, 'getPricesProduct'])->name('product_prices');
    Route::get('reports/saleindate', [ReportController::class, 'sales_report'])->name('sale_report');
    Route::get('reports/pettycash/{petty_cash_id}/report', [ReportController::class, 'PettyCashReport'])->name('PettyCashReport');

    Route::get('reports/inventoryindate', [ReportController::class, 'inventory_report_export'])->name('inventory_report');

    Route::get('reports/inventory/{local_id}', [ReportController::class, 'inventory_report_by_local'])->name('inventory_report_by_local');

    Route::get('reports/sales/{begin_date}/{end_date}/{download}', [ReportController::class, 'sales_report_export'])->name('sales_report_export');

    Route::get('print/sales/user/{date}', [SaleController::class, 'printSalesDay'])->name('print_sale_user');

    Route::post('relocate/product/sizes', [ProductController::class, 'saveRelocate'])->name('relocate_product_sizes');

    Route::get('reports/payment/method/motals', [ReportController::class, 'reportPaymentMethodTotals'])->name('report_payment_method_totals');

    Route::post('data/payment/method/motals', [ReportController::class, 'dataPaymentMethodTotals'])->name('data_payment_method_totals');

    Route::post('import/product/data', [ProductController::class, 'import'])->name('import_product_data');

    Route::resource('saledocuments', SaleDocumentController::class);
});
