<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function homepage()
    {
        $ourName = 'Goja';
        $sports = ['Odbojka', 'Fudbal', 'Rukomet'];
        return view('homepage', ['name' => $ourName, 'sportovi' => $sports]);
    }

    public function about()
    {
        return view('single-post');
    }
}
