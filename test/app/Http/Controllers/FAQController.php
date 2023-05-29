<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FAQController extends Controller
{
    /*De methode toonFaq, treturnd de faq-view.*/
    public function toonFaq(){
        return view('faq');
    }
}