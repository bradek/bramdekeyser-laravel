<?php

namespace App\Http\Controllers;

/*Ik heb verscheidene errors gehad dat bepaalde zaken binnen de illuminate folder niet gevonden konden worden.
ResetsPasswords, CanResetPassword, Password en PasswordReset hebben betrekking tot het wijzigen van het wachtwoord.
Ik weet niet eens of ik al die password-gerelateerde verwijzingen echt nodig heb, maar het werkt nu wel.
De Facades/Hash is nodig om wachtwoorden te kunnen hashen.*/
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class WachtwoordVergetenController extends Controller
{
    use ResetsPasswords, CanResetPassword;

    /*Wanneer de toonRequestFormulier via de route wordt aangeroep,
    returnd hij de email-pagina die zich bevindt in view/auth/passwords/email.blade.php.
    Dat is de pagina waarop je je emailadres geeft, waar vervolgens een mail naar wordt gestuurd.*/
    public function toonRequestFormulier()
    {
        return view('auth.passwords.email');
    }

    /*De onderstaande functie stuurt de resetlink naar het door jou ingegeven emailadres.*/
    public function sendResetLinkEmail(Request $request)
    {
        /*Ik maak gebruik van de validateEmail function.
        Initieel is deze protected. Door $this->validateEmail te doen, kan ik deze uitvoeren.*/
        $this->validateEmail($request);

        /*De resetlink wordt gestuurd naar de email.
        Het email adres is het enige dat moet worden doorgegeven.*/
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        /*De response wordt gereturned.*/
        return $response == Password::RESET_LINK_SENT
            ? back()->with('status', trans($response))
            : back()->withErrors(['email' => trans($response)]);
    }

    /*De email wordt gevalideerd.
    Deze functie is protected en kan alleen worden gebruikt wanneer deze wordt aangeroepen.
    Bij de eerste regel van sendResetLinkEmail, wordt er via $this->validateEmail($request); hiernaar gelinkt.*/
    protected function validateEmail(Request $request)
    {
        /*Het emailadres ingeven is required.
        Dit betekent dat je niet kan vragen om een resetlink als er geen emailadres is ingegeven.
        Het werkt ook niet als het emailadres niet in de databank staat.*/
        $request->validate([
            'email' => 'required|email',
        ]);
    }

    /*Deze functie toont het reset formulier.
    Deze functie wordt aangeroepen wanneer de link wordt geopend via de mail.
    Deze maakt gebruik van een token.
    De token is zegmaar de toegang die je krijgt via de mail om iets te wijzigen.*/
    public function toonResetFormulier(Request $request, $token)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /*Hieronder is de functie die wordt gebruikt om het wachtwoord te wijzigen.*/
    public function resetPassword(Request $request, $token = null)
{
    /*De gegevens voor de aanvraag worden gevalideerd.
    Alle drie de onderdelen zijn required.
    Het wachtwoord moet worden bevestigd en dient minimaal acht regels lang te wezen.
    De token is ook verplicht, maar die is een hidden input die er automatisch is.
    Om de token hoeft de gebruiker zich dus niet echt te bekommeren.*/
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8',
    ]);

    /*Hieronder wordt het wachtwoord gewijzigd.
    In de request wordt gebruik gemaakt van de email, de password, password_confirmation en de token.*/
    $resetPasswordStatus = $this->broker()->reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),

        /*De password wordt gelinkt aan de password van de database tabel user.
        De password wordt gehasdh, wat inhoudt dat het wachtwoord wordt versleuteld.
        Door die versleuteling kan ik geen misbruik maken en wachtwoorden van anderen zelf inlezen in de database.*/
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
                /*De remember token wordt aangemaakt voor het passwoord.
                Dit is een string die bestaat uit zestig random characters.*/
            ])->setRememberToken(Str::random(60));

            /*De gegevens die gewijzigd zijn in de tabel worden opgeslagen.*/
            $user->save();

            /*Het gebruikersobject wordt doorgegeven.
            De PasswordReset-event wordt geactiveerd.
            Deze event bevindt zich in de folder: Illuminate\Auth\Events\PasswordReset;
            Deze is dus niet door mij zelf gemaakt.*/
            event(new PasswordReset($user));
        }
    );

    /*Als het resetten van het password gelukt is, wordt ik geredirect naar de login pagina.
    Daar kun je je dan inloggen met je nieuwe password.*/
    if ($resetPasswordStatus == Password::PASSWORD_RESET) {
        return redirect()->route('login')->with('status', trans($resetPasswordStatus));
    } 
    /*Als dit niet gelukt is, worden er opmerkingen/meldingen gegeven.*/
    else {
        return back()
            ->withErrors(['email' => trans($resetPasswordStatus)])
            ->withInput($request->only('email'));
    }
}
}