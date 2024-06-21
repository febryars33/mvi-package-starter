<?php

namespace MVI\Starter\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view(view: 'starter::home');
    }
}
