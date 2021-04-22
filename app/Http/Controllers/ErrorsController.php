<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorsController extends Controller
{
    public function show404()
    {
        return view('errors.404');
    }
}
