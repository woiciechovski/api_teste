<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Validator;
use GuzzleHttp\Client;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'unique:users|required',
            'email'    => 'unique:users|required',
            'phone' => 'required',
            'password' => 'required',
        ];

        $input     = $request->only('name', 'email', 'password', 'phone');
        $validator = Validator::make($input, $rules);


        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $data = request()->only('email', 'name', 'password', 'phone');


        if ($request->route()->computedMiddleware[0] == 'api') {
            $token = $user->createToken($data['email'])->accessToken;
            return response()->json(['access_token' => $token]);
        }
    }
}
