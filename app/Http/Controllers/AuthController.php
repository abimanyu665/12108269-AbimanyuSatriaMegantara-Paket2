<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function loginInput(Request $request){

        try {
            $data = $request->validate([
                'email' => 'required|exists:users,email',
                'password' => 'required'
            ],[
                'email.exists' => 'This User Doesnt Exists'
            ]);

            Auth::attempt($data);

            return redirect('/');
        } catch (\Throwable $th) {
            return back()->with('fail', 'Failed to login');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }


    public function index(){
        $data = User::all();
        return view('admin.index', compact('data'));
    }

    public function edit($id){
        $user = User::where('id', $id)->first();
        return view('admin.edit-user', compact('user'));
    }

    public function update(Request $request, $id){
        try {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'role' => 'required'
            ]);

            User::where('id', $id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role']
            ]);

            return redirect('/user')->with('success', 'Success');
        } catch (\Throwable $th) {

            return back()->withInput()->with('fail', 'Failed!');
        }
    }
    public function create(){
        return view('admin.create-user');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role']
        ]);
        return redirect('/user')->with('success', 'Success');
    }

    public function destroy(){
        User::where('id', $id)->delete();
        return redirect('/user');
    }
}
