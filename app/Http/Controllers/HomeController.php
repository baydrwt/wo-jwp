<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Katalog $katalog)
    {
        return view('home',[
            'title' => 'Home',
            'katalogs' => Katalog::all()
        ]);
    }
}