<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $hashPassowrd = Hash::make($password);

        $user = User::create([
            'email' => $email,
            'password' => $hashPassowrd
        ]);

        return response()->json([
            'code'  => 200,
            'descriptions' => "Berhasil registrasi",
            'contents'  => $user
        ]);

    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json([
                'code'      => 401,
                'descriptions' => "Email/Password salah",
            ]);
        }

        $isValidPassword = Hash::check($password, $user->password);
        if (!$isValidPassword) {
            return response()->json([
                'code'      => 401,
                'descriptions' => "Password tidak sesuai"
            ]);
        }

        $generateToken = bin2hex(random_bytes(40));
        $user->update([
            'token' => $generateToken
        ]);

        return response()->json([
            'code'  => 200,
            'descriptions' => "Berhasil login",
            'contents' => $user
        ]);
    }

    //
}
