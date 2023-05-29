<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfielController extends Controller
{

    /*Deze functie dient de profielpagina te tonen.*/
    public function toon()
    {
        /*Gegevens van de user worden opgevraagd.*/
        $user = Auth::user();

        if (!empty($user->avatar)) {
            $user->avatar = asset('storage/avatars/' . $user->avatar);
        }

        //dd($user->avatar);

        /*De view, zijnde de profielpagina, wordt in onderstaande regel gereturnd.
        Op deze manier wordt de pagina zichtbaar.
        De compact('user') maakt een associatieve array aan met 'user' als variabele en de waarde van de variabele
        als waarde van de array.
        Dit doe ik om de variabele beschikbaar te maken in deze view.*/
        return view('profielpagina', compact('user'));
    }
    

    /*Onderstaande methode is een methode die informatie dient te verwerken en te updaten.
    Een gebruiker kan hierdoor eigen gegevens wijzigen.*/
    public function update(Request $request)
    {
        /*Gegevens van de user worden opgevraagd.*/
        $user = Auth::user();

        /*De request wordt gevalideerd.
        Naam, email en wachtwoord zijn required en strings.
        De naam mag maximaal 255 karakters lang zijn, net zoals de email.
        Het wachtwoord moet minimaal 8 tekens lang zijn.
        De email moet uniek zijn!*/
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'required|string|min:8|confirmed',
        ]);

        /*De gegevens in de databank worden gewijzigd en opgeslagen.*/
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        /*De gebruiker wordt geredirect naar de index pagina.
        Een bericht wordt meegegeven die de naam 'succes' draagt.
        Deze kan ik aanroepen in de code van de view.*/
        return redirect()->route('index')->with('success', 'Profielgegevens zijn bijgewerkt.');
    }
}