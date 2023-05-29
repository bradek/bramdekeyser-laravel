<?php 
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegistratieController extends Controller
{
    /*public function uploadAvatar(Request $request)
    {
        $file = $request->file('avatar');

        $avatar = new Avatar();
        $avatar->name = $file->getClientOriginalName();
        $avatar->image = file_get_contents($file->getRealPath());
        $avatar->save();

        // Voer hier eventuele andere logica uit na het uploaden van de avatar

        return redirect()->back()->with('success', 'Avatar uploaded successfully.');
    }*/

    public function showRegistratieFormulier()
    {
        /*Deze dd heb ik toegevoegd omdat de redirect niet werkt.
        Deze toont zichzelf, wat er op wijst dat deze functie wel juist wordt aangeroepen.*/
        //dd("Show Registratie Formulier wordt uitgevoerd.");
        
        /*Ik return the view registreer die zich binnen de folder 'auth' bevindt.*/
        return view('auth.registreer');
    }

    /*De onderstaande functie dient de informatie te registreren.*/
    public function registreer(Request $request)
    {
        /*Ik valideer de ingevoerde gegevens.
        'required' is een keyword die ervoor zorgt dat deze niet leeg kan worden gelaten.
        De emailaddressen moeten uniek zijn en de wachtwoorden minimaal zes tekens lang.*/
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'about_me' => 'required|max:150',
            'birthdate' => 'required|date',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /*Ik maak een nieuwe gebruiker aan.
        De inputs in de velden worden opgeslagen in de databasetabel voor de users.*/
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->about_me = $request->input('about_me');
        $user->birthdate = $request->input('birthdate');

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('avatars', $avatarName, 'public');

            $user->avatar = $avatarName; // Voeg deze regel toe
        }

        $user->admin = false; //Standaard staat admin op false.
        $user->save();

        // Redirect naar een bedankpagina of een andere route
        return redirect()->route('index')->with("succes","Uw gebruikersaccount werd aangemaakt.");

        //return back()->with("succes", "Uw gebruikersaccount werd aangemaakt.");
    }
}