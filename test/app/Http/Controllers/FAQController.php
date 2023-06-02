<?php

namespace App\Http\Controllers;

use App\Models\FaqCategorie;

class FAQController extends Controller
{
    public function toonfaq()
    {
        $categorieen = FaqCategorie::with('vragen')->get();

        return view('faq', compact('categorieen'));
    }
}