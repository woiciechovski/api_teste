<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Passport\Token;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //list all users
        return response()->json(['users' => User::all()], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create user
        $rules = [
            'name' => 'unique:users|required',
            'email'    => 'unique:users|required',
            'phone' => 'required',
            'password' => 'required',
            'photo' => 'required|max:10000|mimes:jpeg,jpg,png,gif',
        ];

        $input     = $request->only('name', 'email', 'password', 'phone');
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        //save photo
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name =  $file->getClientOriginalName();
            $file->move(public_path() . '/images/', time() . '-' . $file->getClientOriginalName());

            $input['photo_name'] = $name;
            $input['photo_path'] = '/images/' . time() . '-' . $file->getClientOriginalName();
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'photo_name' => $name ?? null,
            'photo_path' => $input['photo_path'] ?? null,
        ]);

        return response()->json(['users' => $user], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $user = User::find($user);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not exist'], 400);
        }
        return response()->json(['user' => $user], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $user = User::find($user);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not exist'], 400);
        }
        $rules = [
            'name' => 'required',
            'email'    => 'unique:users|required',
            'phone' => 'required',
            'password' => 'required',
            'photo' => 'max:10000|mimes:jpeg,jpg,png,gif',
        ];

        $request['email'] == $user->email ? $rules['email'] = 'required' : $rules['email'] = 'unique:users|required';

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->phone = $request->phone ?? $user->phone;

        //save photo

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $user->photo_name =  $file->getClientOriginalName();
            $file->move(public_path() . '/images/', time() . '-' . $file->getClientOriginalName());
            $user->photo_path =  time() . '-' . $file->getClientOriginalName();
        }

        $user->save();

        return response()->json(['users' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        //delete user
        $user = User::find($user);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true, 'message' => 'User deleted successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'User not exist'], 400);
        }
    }
}
