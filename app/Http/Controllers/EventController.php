<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use App\Models\Sous_menus;
use Auth;
use App\Data;
use Validator;
use Response;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\Event;

class EventController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    protected function validator(array $data)
    {

        return Validator::make($data,
            [
                'title' => 'required|max:255|unique:events',
            ]
        );

    }

    protected function create(array $data)
    {

        $event = Event::create([
            'title' => $data['title']
        ]);

        return $event;

    }

    public function showEventForm()
    {
        $menus = Menus::orderBy('id', 'desc')->take(8)->get();
        $sousmenus = Sous_menus::orderBy('id', 'desc')->take(20)->get();
        //$events=Events::find(1)->sous_menus()->;
        //dd($events);
        //return View('/welcome', compact('menus', 'sousmenus'));
        return view('pages.admin.createevent',compact('menus', 'sousmenus'));
    }

    public function addEvent(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return view('pages.admin.event');
    }
}