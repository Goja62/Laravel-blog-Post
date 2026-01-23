<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function homepage()
    {
        return '<h1>Home</h1><a href="/about">About</a>';
    }

    public function about()
    {
        return '<h1>About us</h1><a href="/">Home</a>';
    }
}
