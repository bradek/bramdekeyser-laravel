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
use App\Http\Controllers\WachtwoordVergetenController;
use App\Http\Controllers\LaatsteNieuwsController;
use App\Http\Controllers\FAQController;

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
Route::get('/registreer', [RegistratieController::class, 'showRegistratieFormulier'])->name('showRegistratieFormulier');
Route::post('/registreer', [RegistratieController::class, 'registreer'])->name('registreer');


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

/*Er zijn twee routes aangemaakt die gebruik maken van de ContactController.
De route met de naam 'contact' voert de methode 'toonContactFormulier' uit,
die vanzelfsprekend de route opent naar het formulier.
contact.indienen verwijst naar de methode indienenContactFormulier(),
die voor de verwerking zorgt.*/
Route::get('/contact', [ContactController::class, 'toonContactFormulier'])->name('contact');
Route::post('/contact', [ContactController::class, 'indienenContactFormulier'])->name('contact.indienen');

/*Hieronder staan twee routes aangaande de functionaliteit waarin je je wachtwoord kan resetten.
De vier methoden waarnaar worden verwijst, bevinden zich in de WachtwoordvergetenController.
Twee hiervan zijn GET en dienen om een view te tonen.
Elke GET krijgt nog een POST die verwijst naar de uitvoeringsmethoden die worden opgestart na de indieningen van de form.
De twee routes die betrekking hebben tot het resetformulier (de route om hem te tonen en de route om hem te verwerken),
maken gebruik van een request token.
In eerdere definities wordt deze van 60 willekeurige tekens voorzien.*/
Route::get('/auth/passwords/email', [WachtwoordVergetenController::class, 'toonRequestFormulier'])->name('password.request');
Route::post('/auth/passwords/email', [WachtwoordVergetenController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/auth/passwords/reset/{token}', [WachtwoordVergetenController::class, 'toonResetFormulier'])->name('password.reset');
Route::post('/auth/passwords/reset/{token}', [WachtwoordVergetenController::class, 'resetPassword'])->name('password.update');

Route::post('/avatars', 'RegistratieController@uploadAvatar')->name('upload.avatar');

Route::get('/laatstenieuws', [LaatsteNieuwsController::class, 'toonLaatsteNieuws'])->name('laatstenieuws');

Route::get('/faq', [FAQController::class, 'toonFaq'])->name('faq');
