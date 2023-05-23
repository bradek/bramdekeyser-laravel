<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*Wanneer de functie showLoginFormulier wordt uitgevoerd, wordt de login pagina geopend.
    Deze bevindt zich binnen de views in de 'auth' folder.*/
    public function showLoginFormulier()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        /*In het registratieformulier laat ik de gebruiker zowel de username, email en password ingeven.
        (Met een bevestiging van het wachtwoord.)
        Bij het login formulier vraag ik echter alleen naar de email en passwoord.*/
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            /*De redirect vindt slechts plaats wanneer de authenticatie is geslaagd.
            Als de redirect niet plaatsvindt, is er een probleem met de authenticatie.
            Deze redirect leidt naar de home-pagina.*/
            return redirect()->intended('/');
        } else {
            /*Als authenticatie faalt, zullen de gegevens ongeldig zijn.*/
            return back()->withErrors(['email' => 'Kon niet inloggen. De inloggegevens zijn ongeldig.']);
        }
    }

    /*Hieronder staat de methode om uit te loggen.
    Deze redirect naar de login-pagina.*/
    public function uitloggen()
    {
        /*Deze functie is blijkbaar ergens ingebakken in Laravel.
        Ik probeerde eerder Auth::uitloggen();, maar dat werkte niet.
        Wanneer er wordt uitgelogd, wordt men opnieuw naar de index pagina geredirect.*/
        Auth::logout();
        return redirect()->route('index');
    }
}