<?php
namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService{
    public function register($request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        $user = User::create($data);
        $token = $user->createToken(get_class($user))->plainTextToken;
        return response()->json(['message' => 'User registered successfully',
         'token' => $token],
          200);
    }


    public function login($request){
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'],
            500);
        }

        $token = $user->createToken(get_class($user))->plainTextToken;

        return response()->json(['token' => $token] ,
         200);
    }
}
