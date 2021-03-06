<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Events;
use App\Models\Menus;
use App\Models\Sous_menus;
use App\Models\TicketUser;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
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
    public function index()
    {
        session()->keep(['niova']);
        $niova = session()->get('niova');
        $user = Auth::user();

        if ($user->isAdmin()) {
            $alert = Alert::where('vu', '=', '0')->get();
            $all_events = Events::all();
            $all_users = User::all();
            $nombreOrganisateur = 0;
            $nombrePayment = 0;
            foreach ($all_users as $u) {
                if ($u->hasRole('organisateur')) $nombreOrganisateur++;
                foreach ($u->tickets as $achat) {
                    if ($achat->pivot->status_payment == 'SUCCESS') $nombrePayment++;
                }
            }
            return view('pages.admin.home', compact('alert', 'all_events', 'all_users', 'nombreOrganisateur','nombrePayment'));
        }
        if ($user->hasRole('organisateur')) {
            $menus = Menus::orderBy('id', 'desc')->get();
            $sousmenus = Sous_menus::orderBy('name', 'asc')->get();
            $events_passe = $user->events()->where('date_fin_event', '<', date('Y-m-d'))->get();
            $events_futur = $user->events()->where('date_debut_envent', '>', date('Y-m-d'))->get();
            $achats = $user->tickets()->orderBy('date_achat','desc')->get();
            return view('pages.user.home_organisateur')->with(compact('menus', 'sousmenus', 'events_passe', 'events_futur', 'achats', 'niova'));
        }
        if ($user->hasRole('user')) {
            $menus = Menus::orderBy('id', 'desc')->get();
            $sousmenus = Sous_menus::orderBy('name', 'asc')->get();
            $achats = $user->tickets()->orderBy('date_achat','desc')->get();
            return view('pages.user.home')->with(compact('menus', 'sousmenus', 'achats', 'niova'));
        }
        return view('pages.user.home');
    }

    public function editUser($userId)
    {
        try {
            $user = $this->getUserByUsername($userId);
        } catch (ModelNotFoundException $exception) {
            return view('pages.status')
                ->with('error', trans('profile.notYourProfile'))
                ->with('error_title', trans('profile.notYourProfileTitle'));
        }
        $themes = Theme::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();
        $currentTheme = Theme::find($user->profile->theme_id);
        $data = [
            'user' => $user,
            'themes' => $themes,
            'currentTheme' => $currentTheme

        ];
        return view('profiles.edit')->with($data);
    }
    public function annulerCommande($user_id, $id)
    {
        $user = User::find($user_id);
        foreach ($user->tickets as $u) {
            if ($u->pivot->id == $id) {
                $ut = TicketUser::find($u->pivot->id);
                $ut->delete();
            }
        }

        return redirect(url('/home'));
    }

}