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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/texto', function () {
    return "Olá";
});

Route::get('/view', function () {
    return view('site.contact');
});

Route::any('/any', function () { //pode ser acessado com qualquer tipo
    return "Any";
});

Route::match(['get', 'post'], '/match', function () { //eu defino quais tipos podem acessar
    return "Match";
});

Route::get('/var/{var1}', function ($var1) { //enviando variavel dinamica pela rota, n precisa ser o msm nome na variavel
    return "Variavel da rota: $var1";
});

Route::get('/var/{var2}/rota', function ($var2) { //enviando variavel dinamica pela rota, precisa ser o msm nome na variavel
    return "Variavel da rota: $var2";
});

//redirecionando rotas----------------------------
Route::redirect('/red1', 'red2');

/*Route::get('/red1', function () {
    return redirect('/red2');
});*/

Route::get('/red2', function () {
    return "Pág 02";
});
//------------------------------------------------

Route::View('/rview', 'welcome');

Route::get('/rnomeada', function() {
    return "Rotas nomeadas";
})->name('url.nomeada');

Route::get('/red3', function() {
    return redirect()->route('url.nomeada');
});

//Grupo de rotas
Route::middleware(['auth'])->group(function(){ //middleware = autenticações pré-definidas, auth = ve se ta logado, caso n manda pro login
    Route::prefix('Admin')->group(function(){ //prefix = prefixo em comum. '/Admin'
        Route::get('/', function () {
            return "Pág Admin";
        });
        Route::get('/Rh', function () {
            return "Recursos humanos";
        });
        Route::get('/Financeiro', function () {
            return "Área financeira";
        });
    });
});
Route::get('/login', function () {
    return "Login";
})->name('login');

//Controller --------------------------------------------------------------
Route::namespace('Admin')->group(function() { //namespace = pasta do controller
    Route::name('admin.')->group(function() { //name = name dos routes tem o admin. antes de tds
        Route::get('/Controller', 'TesteController@teste')->name('testeController');
        Route::get('/Controller2', 'TesteController@teste')->name('testeController');
        Route::get('/Controller3', 'TesteController@teste')->name('testeController');
    });
});
//--------------------------------------------------------------------------
//Grupo de rotas mais sintético
Route::group([
    'prefix' => 'Admin',
    'middleware' => [],
    'namespace' => 'Admin'
], function() {
    Route::get('/gsint1', 'TesteController@teste')->name('testeController');
    Route::get('/gsint2', 'TesteController@teste')->name('testeController');
    Route::get('/gsint3', 'TesteController@teste')->name('testeController');
});

//---------------------------------------------------------------------------



/*Route::get('/products', 'ProductController@index')->name('products.index');
Route::get('/products/{id}', 'ProductController@show')->name('products.show');
Route::post('/products', 'ProductController@create')->name('products.create');
Route::post('/products', 'ProductController@store')->name('products.store');
Route::get('/products/{id}/edit', 'ProductController@edit')->name('products.edit');
Route::put('/products/{id}', 'ProductController@update')->name('products.uptade');
Route::delete('/products/{id}', 'ProductController@destroy')->name('products.destroy');*/
Auth::routes(['register' => false]);

Route::any('products/search', 'ProductController@search')->name('products.search')->middleware('auth');
Route::resource('/products', 'ProductController')->middleware(['auth', 'check.is.admin']);


