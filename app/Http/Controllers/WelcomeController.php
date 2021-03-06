<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;
use App\Models\Sous_menus;
use App\Models\Events;
use App\Models\Slides;

class WelcomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $menus = Menus::orderBy('id', 'desc')->get();
        $sousmenus = Sous_menus::orderBy('name', 'asc')->get();
        // $slides= Slides::orderBy('id','desc')->where('active','=','1');
        $slides = Slides::orderBy('id', 'desc')->where('active', '=', true)->get();
        return View('/welcome', compact('menus', 'sousmenus', 'slides'));

    }

}
