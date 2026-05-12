<?php

namespace App\Http\Controllers;

use App\Models\Maison;
//use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $maisons = Maison::latest()->take(6)->get();
        return view('home', compact('maisons'));
    }
}