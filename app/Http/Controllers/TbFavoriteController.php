<?php

namespace App\Http\Controllers;

use App\tb_favorite;
use App\User;
use App\tb_data_jasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class TbFavoriteController extends Controller
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
        $data = new tb_favorite();
        $data->id_user=$request->id_user;
        $data->id_data_jasa=$request->id_data_jasa;

        if ($data->save()) {
            return response()->json([
                'status'=>true
            ],201);
        }
        return response()->json(['message'  => 'failed to create ketagori']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tb_favorite  $tb_favorite
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataFavorite = tb_favorite::where('id_user','=',$id)->get();

        $i = 0;
        foreach ($dataFavorite as $key) {
            $data_user[]=User::find($key->id_user);
            $i+=1;
        }

        $i = 0;
        foreach ($dataFavorite as $key) {
            $data_jasa[]=tb_data_jasa::find($key->id_data_jasa);
            $i+=1;
        }

        return response()->json(
                    $dataFavorite
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tb_favorite  $tb_favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(tb_favorite $tb_favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tb_favorite  $tb_favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tb_favorite $tb_favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tb_favorite  $tb_favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(tb_favorite $tb_favorite)
    {
        //
    }
}
