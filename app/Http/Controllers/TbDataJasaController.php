<?php

namespace App\Http\Controllers;

use App\tb_data_jasa;
use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class TbDataJasaController extends Controller
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

        $data_jasa = new tb_data_jasa([
            'id_kategori' => $request->input('id_kategori'),
            'id_user' => $request->input('id_user'),
            'id_user_admin' => 1,
            'pekerjaan'=>$request->input('pekerjaan'),
            'estimasi_gaji'=>$request->input('estimasi_gaji'),
            'pengalaman_kerja'=>$request->input('pengalaman_kerja'),
            'usia'=>$request->input('usia'),
            'no_telp'=>$request->input('no_telp'),
            'email'=>$request->input('email'),
            'status'=>$request->input('status'),
            'status_validasi'=>'non_valid',
            'alamat'=>$request->input('alamat')
        ]);

        // $data_jasa->save();

        if ($data_jasa->save()) {
            return response()->json([
                'message' => 'data jasa created successfully.'
            ], 201);
        }
        return response()->json(['message'  => 'failed to create data jasa']);       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tb_data_jasa  $tb_data_jasa
     * @return \Illuminate\Http\Response
     */
    public function show($id_kategori)
    {
        //percobaan pertama
        $id_user_admin_default = 1;
        $data_jasa = tb_data_jasa::where('id_kategori','=',$id_kategori)->where('status_validasi','=','valid')->get();

        //percobaan kedua
        // $data_jasa = DB::table('tb_data_jasas')->where('id_kategori','=',$id_kategori)->get();
        // return response()->json([            
        //     'dataJasa'=>$data_jasa,           
        // ]);

        //cara 1 (klasik dengan 2 objek, sudah jadi di android)
        $data_user=[];
        
        $i = 0;
        foreach ($data_jasa as $key) {
            $data_user[]=User::find($key->id_user);
            $i+=1;
        }

        return response()->json([
                'dataJasa'=>$data_jasa,
                'dataUser'=>$data_user
            ]);

        // return $data_jasa;

        // return response()->json($data_jasa);       

        // //cara 2 dari wahyu(koplar) belum jadi di android

        // $newValue = "";
        // $i = 0;
        // foreach ($data_jasa as $key) {
        //     $data_user[]=User::find($key->id_user);
        //     $a = 0;
        //     foreach ($data_user as $key2) {
        //         $data_jasa->$newValue=$key2->name;
        //         $data_jasa->$newValue=$key2->email;
        //         $a+=1;
        //     }
            
        //     $i+=1;
        // }

        // return response()->json($data_jasa);
        
    }

    public function showDataJasaforAdmin($id_kategori)
    {
        $data_jasa = tb_data_jasa::where('id_kategori','=',$id_kategori)->get();

        $data_user=[];
        
        $i = 0;
        foreach ($data_jasa as $key) {
            $data_user[]=User::find($key->id_user);
            $i+=1;
        }

        return response()->json([
                'dataJasa'=>$data_jasa,
                'dataUser'=>$data_user
            ]);
    }

    public function showDataJasaUser($id_user){
        $data_jasa = tb_data_jasa::where('id_user','=',$id_user)->get();

        // $data_user=[];
        
        // $i = 0;
        // foreach ($data_jasa as $key) {
        //     $data_user[]=User::find($key->id_user);
        //     $i+=1;
        // }

        return response()->json($data_jasa
            );


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tb_data_jasa  $tb_data_jasa
     * @return \Illuminate\Http\Response
     */
    public function edit(tb_data_jasa $tb_data_jasa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tb_data_jasa  $tb_data_jasa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tb_data_jasa $tb_data_jasa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tb_data_jasa  $tb_data_jasa
     * @return \Illuminate\Http\Response
     */
    public function destroy(tb_data_jasa $tb_data_jasa)
    {
        //
    }
}
