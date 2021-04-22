<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class HomeController extends Controller
{
	public function index(){
		return redirect("/login");
    } 

}
