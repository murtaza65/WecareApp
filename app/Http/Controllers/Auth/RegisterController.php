<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends BaseController
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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'firstname'            => ['required', 'string', 'max:255'],
            'lastname'             => ['required', 'string', 'max:255'],
            'email'                => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'             => ['required', 'string', 'min:8', 'confirmed'],
            'terms_and_conditions' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    //web registrations
    protected function create(array $data)
    {

        $user = User::firstOrCreate(
            [
                'username' => $data['firstname'] . " " . $data['lastname'],
                'email'    => $data['email'],
            ],
            [
                'password'             => Hash::make($data['password']),
                'terms_and_conditions' => true,
            ]
        );

        if (! $user) {
            return back()->with('error', "Registration Failed!!");
        }

        $user = User::where('email', $user->email)->first();
        // try {
        //     $result = $this->createUserAccounts($user);
        // } catch (Exception $e) {
        //     info($e->getMessage());
        //     return back()->with('error', "Failed to create associated accounts");
        // }

        return $user;
    }

    public function createUserAccounts(User $user)
    {
        # code...
        try {
            $this->createProfile($user);
            return true;
        } catch (Exception $e) {
            info(["registration_error" => $e->getMessage()]);
            return $e->getMessage();
        }
    }

    public function createProfile(User $user)
    {
        # code...
        $result = $user->profile()->create([
            "user_id"       => $user->id,
            "profile_image" => "",
        ]);

        return $result;
    }

}
