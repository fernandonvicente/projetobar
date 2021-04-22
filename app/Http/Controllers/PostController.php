<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;

class PostController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable()
    {

        return view('datatable');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPosts()
    {
    	$users = DB::table('clients')->select('id');

        count($users);

        exit;


        /*return DataTables::of($users)
            ->make(true);*/

        return Datatables::of($users)
			         ->addColumn('action', function ($user) {

			         	
			                return '<a href="#edit-'.$user->id.'" class="btn btn-xs btn-primary"> Edit</a> | <a href="#edit-'.$user->id.'" class="btn btn-xs btn-primary"> Delete</a>';
			            })
                      ->make(true);
    }
}


