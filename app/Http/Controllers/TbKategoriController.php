<?php

namespace App\Http\Controllers;

use App\tb_kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class TbKategoriController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
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
        if ($request->hasFile('logo_kategori')) {
            $fileLogoKategori=$request->file('logo_kategori');
            $fileLogoKategori->move('img/logo_kategori',$fileLogoKategori->getClientOriginalName());
            $nameLogoKategori = $fileLogoKategori->getClientOriginalName();
        }else{
            $nameLogoKategori = 'kerja.png';
        }

        $data = new tb_kategori();
        $data->logo_kategori='/img/logo_kategori/'.$nameLogoKategori;
        $data->kategori=$request->kategori;

        
        if ($data->save()) {
            $data_kategori = tb_kategori::all();
            return response()->json([
                'dataKategori' => $data_kategori,
                'status'=>true
            ],201);
        }
        return response()->json(['message'  => 'failed to create ketagori']);
        
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
    public function update(Request $request, $id)
    {
        if ($request->hasFile('logo_kategori')) {
            $fileLogoKategori=$request->file('logo_kategori');
            $fileLogoKategori->move('img/logo_kategori',$fileLogoKategori->getClientOriginalName());
            $nameLogoKategori = $fileLogoKategori->getClientOriginalName();
        }else{
            $nameLogoKategori = 'kerja.png';
        }

        $data = tb_kategori::find($id);
        $data->logo_kategori='/img/logo_kategori/'.$nameLogoKategori;
        $data->kategori=$request->kategori;

        
        if ($data->save()) {
            $data_kategori = tb_kategori::all();
            return response()->json([
                'dataKategori' => $data_kategori,
                'status'=>true
            ],201);
        }
        return response()->json(['message'  => 'failed to create ketagori']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tb_kategori  $tb_kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataKategori = tb_kategori::find($id);

        if ($dataKategori->delete()) {
            $data_kategori_all = tb_kategori::all();
            return response()->json([
                'dataKategori' => $data_kategori_all,
                'status'=>true
            ],201);
        }
        return response()->json(['message'  => 'failed to create ketagori']);

    }
}
