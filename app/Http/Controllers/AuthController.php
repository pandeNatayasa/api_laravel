<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\Controller;

use App\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

		/**
     * Create user account
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){

        if ($request->hasFile('foto_profille')) {
            $fileFotoProfille=$request->file('foto_profille');
            $fileFotoProfille->move('img/foto_profille',$fileFotoProfille->getClientOriginalName());
            $nameFotoProfille = $fileFotoProfille->getClientOriginalName();
        }else{
            // return 'no selected image Profil Picture';
            $nameFotoProfille = 'contact.jpg';
        }

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'foto_profille'=>'/img/foto_profille/'.$nameFotoProfille,
            'jenis_kelamin'=>$request->input('jenis_kelamin'),
            'no_telp'=>$request->input('no_telp'),
            'tanggal_lahir'=>$request->input('tanggal_lahir')
        ]);
        if ($user->save()) {
            return response()->json([
                'message' => 'user created successfully.',
                'user' => [
                    'href' => 'api/v1/login',
                    'method' => 'get',
                    'params' => 'email, password'
                ]
            ], 201);
        }
        return response()->json(['message'  => 'failed to create user']);
    }


    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // $credentials = $request->only('email', 'password');

        // if ($token = $this->guard()->attempt($credentials)) {
        //     return $this->respondWithToken($token);
        // }

        // return response()->json(['error' => 'Unauthorized'], 401);

    	$credentials = [
            'email' => $request->input('email'), 
            'password' => $request->input('password')
        ];
        // return response()->json(['user_id' => auth()->user()]);
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        
        // $token = $this->respondWithToken($token);
        $email = $request->input('email');
        $nameUser = DB::table('users')->select('name')->where('email', '=', $email)->get();

        $user = Auth::user();
        return response()->json([
            'token' => $token,
            'status' => true,
            'dataUser'=>$user            
        ]);

    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function data(Request $request)
    // {
    //     $email = $request->email;
    //     $user = User::where('email', '=', $email)->get();
    //     // return $user;
    //     // $credentials = [
    //     //     'email' => $request->input('email')
    //     // ];
    //     // return response()->json($credentials);
    //     return response()->json($user);
    // }
    public function getAuthenticatedUser()
            {
                    try {

                            if (! $user = JWTAuth::parseToken()->authenticate()) {
                                    return response()->json(['user_not_found'], 404);
                            }

                    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                            return response()->json(['token_expired'], $e->getStatusCode());

                    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                            return response()->json(['token_invalid'], $e->getStatusCode());

                    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                            return response()->json(['token_absent'], $e->getStatusCode());

                    }

                    return response()->json(compact('user'));
            }

    public function updateFotoProfille(Request $request)
    {
        if ($request->hasFile('foto_profille')) {
            $fileFotoProfille=$request->file('foto_profille');
            $fileFotoProfille->move('img/foto_profille',$fileFotoProfille->getClientOriginalName());
            $nameFotoProfille = $fileFotoProfille->getClientOriginalName();
        }else{
            // return 'no selected image Profil Picture';
            $nameFotoProfille = 'contact.jpg';
        }
        $data = JWTAuth::parseToken()->authenticate();

        // $data = User::find($id);
        $data->foto_profille='/img/foto_profille/'.$nameFotoProfille;
        $token = "";
        if ($data->save()) {
            $dataUser=JWTAuth::parseToken()->authenticate();
            return response()->json([
                'token' => $token,
                'status' => true,
                'dataUser'=>$dataUser            
            ], 201);
        }
        return response()->json(['message'  => 'failed to create user']);
    }

    public function updateProfille(Request $request,$id){
        $user=User::find($id);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->jenis_kelamin=$request->jenis_kelamin;
        $user->no_telp=$request->no_telp;
        $user->tanggal_lahir=$request->tanggal_lahir;
        
        $token = "";
        if ($user->save()) {
            $dataUser=User::find($id);
            return response()->json([
                'token' => $token,
                'status' => true,
                'dataUser'=>$dataUser            
            ]);
        }
        return response()->json(['message'  => 'failed to create user']);
    }

}
