<?php

namespace App\Repository\Login;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginRepository implements LoginRepositoryInterface
{
    public function register($request)
    {
        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input("password"));
        $user->save();
        $user->assignRole('Administrator');

        return $user;
    }
}
