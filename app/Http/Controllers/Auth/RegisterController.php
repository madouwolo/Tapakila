<?php

namespace App\Http\Controllers\Auth;

use App;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ActivationTrait;
use App\Traits\CaptchaTrait;
use App\Traits\CaptureIpTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Tokken\RandomToken;

use jeremykenedy\LaravelRoles\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use ActivationTrait;
    use CaptchaTrait;
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/activate';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', [
            'except' => 'logout'
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        /*$data['captcha'] = $this->captchaCheck();

        if (!config('settings.reCaptchStatus')) {
            $data['captcha'] = true;
        }*/
        session()->flash('cache', "register");
        return Validator::make($data,
            [
                'name' => 'required|max:255',
                'first_name' => 'required|max:255',
                'last_name' => '',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required|same:password',
                'numero'=>'numeric|max:0349999999|min:0320000000',
                //'g-recaptcha-response'  => '',
                //'captcha'               => 'required|min:1'
            ],
            [
                //'name.unique'                   => trans('auth.userNameTaken'),
                'name.required' => trans('auth.userNameRequired'),
                'first_name.required' => trans('auth.fNameRequired'),
                'last_name.required' => trans('auth.lNameRequired'),
                'email.required' => trans('auth.emailRequired'),
                'email.email' => trans('auth.emailInvalid'),
                'password.required' => trans('auth.passwordRequired'),
                'password.min' => trans('auth.PasswordMin'),
                'password.max' => trans('auth.PasswordMax'),
                'numero.max'=>trans('auth.NumeroMax'),
                'numero.min'=>trans('auth.NumeroMin'),
                'numero.numeric'=>trans('auth.NumeroNum'),
                //'g-recaptcha-response.required' => trans('auth.captchaRequire'),
                //'captcha.min'                   => trans('auth.CaptchaWrong')
            ]
        );

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $ipAddress = new CaptureIpTrait;
        $role = Role::where('slug', '=', 'unverified')->first();
        $isOrganisateur = false;
        if (isset($data['isOrganisateur'])) $isOrganisateur = true;
        $user = User::create([
            'name' => $data['name'],
            'first_name' => $data['first_name'],
            'last_name' => null,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'isOrganisateur' => $isOrganisateur,
            'token' => str_random(64),
            'signup_ip_address' => $ipAddress->getClientIp(),
            'activated' => !config('settings.activation'),
            'numero' =>$data['numero'],
            'client_key' => RandomToken::random(32)
        ]);

        $user->attachRole($role);
        $this->initiateEmailActivation($user);

        return $user;

    }
}
