<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data = $this->filterArray($data);

        return Validator::make($data, [
            'first_name' => 'required|regex:/^\b[a-z\s-]+\b$/i|max:255',
            'middle_name' => 'regex:/^\b[a-z\s-]+\b$/i|max:255',
            'last_name' => 'required|regex:/^\b[a-z\s-]+\b$/i|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    private function filterArray(array $data)
    {
        $data['first_name'] = $this->formatData($data['first_name']);
        $data['middle_name'] = $this->formatData($data['middle_name']);
        $data['last_name'] = $this->formatData($data['last_name']);

        return $data;
    }

    private function formatData($data)
    {
        $regexrep = [
            '/\s+/' => ' ',
            '/-+/' => '-',
            '/\s?-\s?/' => '-',
        ];

        return ucwords(strtolower(preg_replace(array_keys($regexrep), array_values($regexrep), trim($data))));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $data = $this->filterArray($data);

        return User::create([
            'fname' => $data['first_name'],
            'mname' => $data['middle_name'],
            'lname' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
