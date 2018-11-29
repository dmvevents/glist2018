<?php
namespace App\Http\Controllers\Auth;

use App\Number;
use App\User;
use App\UserNumber;
use App\Services\TelApi;
use App\Services\Mandrill;


use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
                'first' => 'required|max:255',
                'last' => 'required|max:255',
                'username' => 'required|max:255|unique:users',
                'number' =>'required|digits:10',
                'email' => 'required|email|max:255|unique:users',
                'dob' => 'required|date',
                'password' => 'required|confirmed|min:6',
            ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = new User();


        $user->first = $data['first'];
        $user->last = $data['last'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->dob = $data['dob'];
        $user->gender = $data['gender'];
        $user->instagram = $data['instagram'];
        $user->twitter = $data['twitter'];
        $user->facebook = $data['facebook'];

        $user->password = bcrypt($data['password']);
        $user->save();

        if(!is_null($data['number'])) {
            //Create new Number
            $number = new Number();
            $number->number = str_replace(array(' ', '(', ')', '-'), array(''), $data['number']);
            $number->type = 'Mobile';
            $number->save();

            //Create Company User Instance
            $usernumber = new UserNumber();

            //Assign new values and save
            $usernumber->number_id = $number->id;
            $usernumber->user_id = $user->id;
            $usernumber->save();

            $telapi = new TelApi();
            $msgnum = $number->number;
            $username = $user->first;
            $msg = $username.', you have been registered for AsiaFridays.com!';
            $telapi->sendSms($msgnum,$msg);
        }

        $mandrill = new Mandrill();
        $mandrill->sendSignUp($user);

        return $user;

    }
}
