<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gastenboek;

class GastenboekController extends Controller
{
    public function index()
    {
        $messages = Gastenboek::latest()->get();
        return view('gastenboek.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'message' => 'required',
        ]);

        Gastenboek::create($data);

        return redirect()->route('gastenboek.index');
    }
}
