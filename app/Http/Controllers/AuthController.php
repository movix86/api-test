<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'codes']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
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
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


    public function codes($code){

        // Sentencia SQL de llamada al procedimiento
        $sql = "CALL respuesta( :param1 )";

        $params = array();
        $params['param1'] = $code;

        $code = DB::select($sql, $params);

        $data =[
            "zip_code"=> $code[0]->zip_code,
            "locality"=> $code[0]->locality,
            "federal_entity"=> [
                "key"=> $code[0]->llave_estado,
                "name"=> $code[0]->estado_federal,
                "code"=> $code[0]->code
            ]
            ,
            "settlements"=> [[
                "key"=> $code[0]->key,
                "name"=> $code[0]->name,
                "zone_type"=> $code[0]->zone_type,
                "settlement_type"=>[
                    "name"=>$code[0]->nombre_asentamiento,
                ]

            ]]
            ,
            "municipality"=>[
                "key"=> $code[0]->llave_municipal,
                "name"=> $code[0]->municipio
            ]

        ];
        return response()->json($data);

    }

}
