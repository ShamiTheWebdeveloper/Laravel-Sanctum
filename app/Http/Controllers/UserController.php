<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
     function login(Request $request){
         $user=User::where("email",$request->email)->first();
         if (!$user || !Hash::check($request->password,$user->password)){
             return response([
                 'message'=>['These credentials does not match to our records']
             ],404);
         }
         $token=$user->createToken('my-app-token')->plainTextToken;
         $response=[
             'user'=>$user,
             'token'=>$token
         ];
         return response($response,201);
     }
}
