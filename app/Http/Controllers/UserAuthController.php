<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    //
    function login(Request $request){
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            return ["success"=>false, "message"=>"Invalid email or password"];
        }
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $user['name'] = $user->name;
        return ["success"=>true,"data"=>$user, "token"=>$success['token'], "message"=>"User logged in successfully"];
    }
    function signup(Request $request){
        // return "signup function";
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $user['name'] = $user->name;
        return ["success"=>true,"data"=>$user, "token"=>$success['token'], "message"=>"User created successfully"];
    }
    
}