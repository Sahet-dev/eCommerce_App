<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function redirect(): RedirectResponse
    {
        // You can add any logic here before redirecting

        return redirect('/');
    }
}
