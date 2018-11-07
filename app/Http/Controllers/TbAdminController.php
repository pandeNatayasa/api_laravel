<?php

namespace App\Http\Controllers;

use App\tb_admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class TbAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\tb_admin  $tb_admin
     * @return \Illuminate\Http\Response
     */
    public function show(tb_admin $tb_admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tb_admin  $tb_admin
     * @return \Illuminate\Http\Response
     */
    public function edit(tb_admin $tb_admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tb_admin  $tb_admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tb_admin $tb_admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tb_admin  $tb_admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(tb_admin $tb_admin)
    {
        //
    }
}
