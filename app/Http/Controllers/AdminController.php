<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    /**
     * load a User
     */
    public function loadUser(){
        $user = User::orderBy('username', 'ASC')->get();
        return response()->json([
            'success' => true,
            'users' => $user
        ], 200);
    }
    /**
     * add new user
     */
    public function addUser(Request $request){
        $success = true;
        $message = "";
        if(!$request->username && !$request->password){
            $success = false;
            $message = "The username and password fields is required";

        } else if(!$request->username){
            $success = false;
            $message = "The username field is required !";

        } else if(!$request->password){
            $success = false;
            $message = "The password field is required !";
        } 
        if(!$success){
            return response()->json([
                'succes' => $success,
                'message' => $message
            ], 200);
        }

        //create user
        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'user'
        ]);

        $token = JWTAuth::fromUser($user);
        return response()->json([
            'success' => true,
            'message' => 'add user successfully !',
            'username' => $request->username
        ], 200);
    }

    /**
     * add new Admin default
     */
    public function createAdmin(Request $request){

        $success = true;
        $message = "";

        if(!$request->username && !$request->password){
            $success = false;
            $message = "The username and password fields is required";

        } else if(!$request->username){
            $success = false;
            $message = "The username field is required !";

        } else if(!$request->password){
            $success = false;
            $message = "The password field is required !";
        }

        //if validasi error / tidak terpenuhi
        if(!$success){
            return response()->json([
                'succes' => $success,
                'message' => $message
            ], 200);
        }

        //jika semua validasi terpenuhi
        //create user
        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'admin'
        ]);

        $token = JWTAuth::fromUser($user);
        return response()->json([
            'success' => true,
            'message' => 'create admin success.',
            'username' => $request->username
        ], 200);
    }

    /**
     * create validator user
     * @param Request request
     */
    public function createValidator(Request $request){
        $success = true;
        $message = "";

        if(!$request->username && !$request->password){
            $success = false;
            $message = "The username and password field is required";
            
        } else if(!$request->username){
            $success = false;
            $message = "The username field is required";
        
        } else if(!$request->password){
            $success = false;
            $message = "The password field is required";

        } else if(strlen($request->password) < 6){
            $success = false;
            $message = "The password min 6 char length";
        }
        
        //if validasi errror / tidak terpenuhi
        if(!$success){
            return response()->json([
                'success' => $success,
                'message' => $message
            ], 200);
        }

        //jika semua validasi terpenuhi
        //create validator
        $roleValidator = $request->validator_type;
        $validatorType = '';
        if($roleValidator == '1'){
            $validatorType = 'validator1';

        } else if($roleValidator == '2') {
            $validatorType = 'validator2';

        } else if($roleValidator == '3'){
            $validatorType = 'validator3';
        }

        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $validatorType
        ]);

        $token = JWTAuth::fromUser($user);
        
        return response()->json([
            'success' => true,
            'message' => 'create validator success.',
            'username' => $request->username
        ], 200);

    }

    /**
     * delete a user
     */
    public function deleteUser(Request $request){
        $delete = DB::table('users')->where('id', $request->id)->delete();
        if($delete){
            return response()->json([
                'success' => true, 
                'message' => 'user successfully deleted.'
            ], 200);
        } else {
            return response()->json([
                'success' => false, 
                'message' => 'failed delete user'
            ], 400);
        }
    }
}
