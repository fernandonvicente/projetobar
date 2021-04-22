<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;
use Collection;
use Session;
use Cookie;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\View\ViewConsultores;
use App\Models\View\ViewClientes;
use App\Models\View\ViewClientesContratosSim;
use App\Models\View\ViewClientesContratosNao;


class AdminController extends Controller
{
    //private $invoiceModel;
    //private $dailyModel;


    private $qtRecordPage = 25;

    public function __construct(){
        //$this->invoiceModel = $invoice;
        //$this->dailyModel = $daily;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 

        $data = [                 


        ]; 


       return view('admin.dashboard.index',$data);
    }

    public function index2()
    { 

        $data = [                 


        ]; 


       return view('admin.dashboard.index2',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
