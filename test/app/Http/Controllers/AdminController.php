<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    /*Ik maak een constructor aan.
    Ik verwijs in deze constructor naar de middleware die ik wil gebruiken.
    Ik wil 'auth' gebruiken voor authenticatie en 'admin' voor administratie.*/
    public function __construct()
{
    $this->middleware(['auth', 'admin']);
}

    public function index()
    {
        $users = User::all();

        /*Ik return de view die zich in de admin folder bevindt.
        Deze folder bevindt zich bij de views.*/
        return view('admin.index', compact('users'));
    }

    /*Het idee is dat bij het togglen van de button, ik de admin status van de gebruiker verander.
    (Van false naar true en van true naar false.)*/
    public function toggleAdminStatus(Request $request, $userId)
    {
        /*De userId wordt gebruikt om de gebruiker op te halen.*/
        $user = User::findOrFail($userId);

        /*Ik ga na of de gebruiker een admin is.
        De isAdmin() methode heb ik eerder aangemaakt in de model Users.*/
        if (auth()->user()->isAdmin()) {
            /*Admin status wordt gewijzigd.*/
            $user->admin = !$user->admin;

            /*De wijzigingen worden opgeslagen.*/
            $user->save();

            // Redirect naar de gewenste pagina
            return redirect()->back()->with('success', 'Admin-status is gewijzigd.');
        }

        /*Ik laat de gebruiker redirecten als deze geen admin is.*/
        return redirect('/')->back()->with('error', 'Alleen admins kunnen de admin-status wijzigen.');
    }
}