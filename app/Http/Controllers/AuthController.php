<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        try{
            $user = new User([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
            ]);
            $user->save(); // returns false
            /*return response()->json([
                'message' => 'Successfully created user!'], 201);
            */
            if($user->save()){
                return response()->json([
                    'message' => 'Success created user!'], 201);
            }else{
                return response()->json([
                    'message' => 'Error creating user!'], 409);
            }
        }
        catch(\Exception $e){
            // do task when error
            //echo $e->getMessage();   // insert query
            return response()->json([
                'message' => 'Error creating user!'], 409);
        }

    }
    public function login(Request $request)
    {
        /*$request = (object) array(
            'email'     => 'prueba@email.com',
            'password'    => '123456789',
            'remember_me' => true
        );*/

        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean',
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                ->toDateTimeString(),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>
            'Successfully logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
