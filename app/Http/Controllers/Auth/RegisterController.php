<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Repository\Login\LoginRepositoryInterface;

class RegisterController extends Controller
{
    public $loginRepository;

    public function __construct(LoginRepositoryInterface $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }
    public function showRegisterForm()
    {
        return Inertia::render('Auth/Register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:4']
        ]);

        $student = $this->loginRepository->register($request);

        $request->session()->flash('success', 'User registered successfully! you can sign in now');

        return Redirect::route('showLoginForm');
    }
}