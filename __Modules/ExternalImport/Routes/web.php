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
declare(strict_types=1);
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;


Route::middleware([
    'web',
    \App\Http\Middleware\Tenant\InitializeTenancyByDomainCustomisedMiddleware::class,
    PreventAccessFromCentralDomains::class,
    'auth:admin',
    'tenant_admin_glvar',
    'package_expire',
    'tenantAdminPanelMailVerify',
    'setlang'

])->prefix('admin-home')->name('externalimport.')->group(function(){
    Route::get('/externalimport', 'ExternalImportController@index')->name('index');
    Route::get('/externalimport/cjdropshipping', 'ExternalImportController@cj')->name('cjdropshipping');
    Route::get('/externalimport/aliexpress', 'ExternalImportController@aliexpress')->name('aliexpress');
    Route::post('/externalimport/post-imported-product', 'ExternalImportController@store')->name('storeproduct');
});
