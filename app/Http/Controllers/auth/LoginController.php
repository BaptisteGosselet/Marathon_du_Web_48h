<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WelcomeController;
use Illuminate\Http\Request;
use Illuminate\Routing\RedirectController;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function logout() {
        Auth::logout();
        return redirect()->route('welcome');
    }
}
