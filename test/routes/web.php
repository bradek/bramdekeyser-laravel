<?php

use Illuminate\Support\Facades\Route;

/*Om gebruik te maken van controller methods bij de routes, moest ik verwijzen naar de juiste controller.
Hiervoor gebruik ik 'use'.*/
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BoekenController;
use App\Http\Controllers\RegistratieController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfielController;
use App\Http\Controllers\ContactController;

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

/*Dit waren de oorspronkelijke routes naar de views.
Bij deze had ik nog geen gebruik gemaakt van controller methods.*/ 

/*Route::get('/', function () {
    return view('index');
});*/

/*Route::get('about', function () {
    return view('about');
});*/

Route::get('/', function () {
    return view('index');
})->name('index');

/*Hieronder heb ik een versie van de routes gemaakt a.d.h.v. controller methods.*/
//Route::get('/', [AboutController::class, 'index']);
Route::get('about', [AboutController::class, 'index']);

/*Deze route verwijst naar een test-pagina die dient na te gaan of de database connectie werkt.
Ik heb reeds geconstateerd dat deze werkt, dus eigenlijk is deze pagina momenteel niet meer echt nodig.
Misschien dat het nog van nut zou kunnen zijn wanneer dit project op de phpmyadmin van u (Kevin) moet geraken
via de migrations.
Als daar iets misgaat, kun nagaan of de databaseconnectie überhaupt goed is verlopen?*/
Route::get('/dbconnectie', function(){
    return view('dbconnectie');
});

Route::get('/boeken', [BoekenController::class, 'index']);

/*Routes voor het registratieformulier.*/
/*Eerst heb ik de onderstaande stringnotatie gebruikt, maar deze heb ik later laten varen omdat deze problemen gaf.
Ik snap nog altijd niet helemaal wat het probleem hier was, maar met de andere schrijfwijze heb ik dit probleem niet.*/
//Route::get('/registreer', 'RegistratieController@showRegistratieFormulier')->name('registreer');
//Route::post('/registreer', 'RegistratieController@registreer');

/*Dit zijn de uiteindelijke twee routes.
De get route wordt gebruikt om het formulier weer te geven, waar de post dient om deze te verwerken.*/
Route::get('/registreer', [RegistratieController::class, 'showRegistratieFormulier'])->name('registreer');
Route::post('/registreer', [RegistratieController::class, 'registreer']);

/*Hieronder staan de routes voor het inlogsysteem.
De eerste route wordt gebruikt om het formulier te tonen, de tweede route voor de uitvgoering hiervan
en ten slotte de derde route voor het uitloggen.
De eerste route is een get omdat de informatie moet worden ingegeven en opgehaald.
De twee volgende routes zijn posts aangezien deze informatie verwerken.
Deze drie routes werken op een methode die zich in de LoginController bevinden.*/

/*Ik heb gebruik gemaakt van grouproutes bij de routes die gelinkt zijn aan de LoginController.
Ik maak gebruik van auth middelware die helpt met authenticatie en beveiliging.*/
Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers'], function () {
    Route::post('/uitloggen', [LoginController::class, 'uitloggen'])->name('uitloggen');
    Route::get('/login', [LoginController::class, 'showLoginFormulier'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
})->middleware('auth');

/*De admin routes bevinden zich hieronder.
De eerste route is een route naar de admin-pagina zelf.
De tweede route dient de admin-status te wijzigen.*/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    /*Met patch kan een gedeeltelijke update worden aangevraagd.*/
    Route::patch('/admin/user/{userId}/toggle-admin', [AdminController::class, 'toggleAdminStatus'])
        ->name('admin.toggleAdminStatus');
});

/*Deze grouproute maakt gebruik van de auth middleware.
Elk van deze routes werken op een methode in de Profielcontroller.*/
Route::middleware(['auth'])->group(function () {
    /*Route naar de profielpagina zelf.*/
    Route::get('/profielpagina', [ProfielController::class, 'toon'])->name('profielpagina');
    
    /*Dit is de route om het profiel bij te werken.
    Via een PUT-verzoek wordt een verzoek naar de update()-methode gestuurd.*/
    Route::put('/profielpagina', [ProfielController::class, 'update'])->name('profielpagina.update');
});

Route::get('/contact', [ContactController::class, 'toonContactFormulier'])->name('contact');
Route::post('/contact', [ContactController::class, 'indienenContactFormulier'])->name('contact.indienen');