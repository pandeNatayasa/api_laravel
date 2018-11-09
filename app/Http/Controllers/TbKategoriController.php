<?php

namespace App\Http\Controllers;

use App\tb_kategori;
use Illuminate\Http\Request;

class TbKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_kategori = tb_kategori::all();
        return response()->json([
            'dataKategori' => $data_kategori   
        ]);
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
     * @param  \App\tb_kategori  $tb_kategori
     * @return \Illuminate\Http\Response
     */
    public function show(tb_kategori $tb_kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tb_kategori  $tb_kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(tb_kategori $tb_kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tb_kategori  $tb_kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tb_kategori $tb_kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tb_kategori  $tb_kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(tb_kategori $tb_kategori)
    {
        //
    }
}
