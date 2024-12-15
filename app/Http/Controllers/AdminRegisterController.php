<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    public function index()
    {
        return view('AdminRegister');
    }

    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $data = $request->all();
        $this->create($data);

        return redirect()->to('/load-login')->with('success', 'Registration successful. Please log in.');
    }

    protected function create(array $data)
    {
        // Determine role based on email
        $role = strpos($data['email'], '@esprit') !== false ? 'admin' : 'client';

        $user = User::create([
            'name' => $data['name'] ,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Assign the role to the user
        $user->assignRole($role);

        return $user;
    }
}
