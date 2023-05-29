<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ContactController extends Controller
{
    /*toonContactFormulier() is een methode die de view contact returnd.
    Deze wordt aangeroepen in de routes bij web.php.*/
    public function toonContactFormulier()
    {
        return view('contact');
    }

    /*De methode indienenContactFormulier dient ingegeven informatie te verzenden.*/
    public function indienenContactFormulier(Request $request)
{
    /*De huidige ingelogde gebruiker wordt opgehaald.
    Er wordt gebruik gemaakt van de naam van de user, het emailadres en de message die deze indient.*/
    $user = auth()->user();

    $name = $user->name;
    $email = $user->email;
    $message = $request->message;

    /*Er wordt gezogd naar de gebruikers die adminrechten hebben.*/
    $admins = User::where('admin', true)->get();

    /*Bij elke admin wordt er een mail opgemaakt en doorgestuurd.
    De structuur van deze mail wordt in ContactEmail weergegeven en bevat de parameters name, email en message.*/
    foreach ($admins as $admin) {
        Mail::to($admin->email)->send(new ContactEmail($name, $email, $message));
    }

    /*Als dit gelukt is, wordt er geredirect naar de index-pagina.
    Als dit slaagt, zou de code moeten hebben gewerkt.
    Men kan altijd in de mails nakijken of de mails is ontvangen.*/
    return redirect('/')->with('success', 'Het contactformulier is succesvol ingediend.');
}
}