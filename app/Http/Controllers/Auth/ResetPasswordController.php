<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest', ['except' => ['changePassword']]);
        $this->middleware('auth', ['only' => ['changePassword']]);
    }

    public function changePassword(Request $request)
    {

        if (Hash::check($request->oldPassword, $request->user()->password)) {
            $this->validate($request, $this->rules(), $this->validationErrorMessages());

            $request->user()->fill([
                'password' => Hash::make($request->newPassword)
            ])->save();

            return redirect('account')->withStatus('Your password was successfully changed.');
        } else
            return redirect()->back()->withErrors(['oldPassword' => ['Your password is incorrect']]);

    }

    protected function rules()
    {
        return [
            'oldPassword' => 'required',
            'newPassword' => 'required|confirmed|min:6',
        ];
    }
}
