<?php

namespace App\Http\Controllers\Api;

use App\Meal;
use App\User;
use App\TableType;
use Socialite;
use DateTime;
use File;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends ApiBaseController
{
    public function facebookLogin(Request $request){

    	$token = $request->token;
    	

    // 	try {

  	$fb_login_user = Socialite::driver('facebook')->userFromToken($token);
        
        	
        	return response()->json($fb_login_user);

            $fileContents = file_get_contents($fb_login_user->getAvatar());

   	// 	} catch (\Exception $e) {
        	
    //     	$message = "Login information is incorrect";

    // 		$status = "401";

    // 		return $this->sendFailResponse($message,$status);

    // 	}

    	if (isset($fb_login_user)) {
    		
    		return $this->findOrStore($fb_login_user, $fileContents);    	

    	}else{

    		$message = "Login information is incorrect";

    		$status = "401";

    		return $this->sendFailResponse($message,$status);

    	}    	
    }

    public function findOrStore($fb_login_user, $fileContents){

    	$email = $fb_login_user->email;

    // 	if (is_null($email)) {
    		
    // 		$message = "Can't Find user's resource";

    // 		$status = "422";

    // 		return $this->sendFailResponse($message,$status);

    // 	}else{

    		$customer = User::where('email', $fb_login_user->email)->first();

            $now = $now = new DateTime('Asia/Yangon');

            $today = $now->format('Y-m-d H:i:s');

    		if (empty($customer)) {
    			
    			$customer = User::create([
                    'name' => $fb_login_user->name,
                    'email' => $fb_login_user->email,
                    'role_flag' => 3,
                    'prohibition_flag' => 1,
                    'email_verified_at' => $today,
                ]);

                $image =  time()."-".$customer->id;
                // return response()->json($image);
                
                File::put(public_path() . '/image/Profile/' . $image . ".jpg", $fileContents);
                $customer->photo_path = $image;
                $customer->save();

                $tokenResult = $customer->createToken('Laravel Personal Access Client')->accessToken;

        		return response()->json([
			        'message' => "Successful",
                    'status' => 200,
                    'access_token' => $tokenResult,               
                    'user' => $customer,            
                ]);
    		}
    		else{

    			$tokenResult = $customer->createToken('Laravel Personal Access Client')->accessToken;
                return response()->json([
			        'message' => "Successful",
                    'status' => 200,
                    'access_token' => $tokenResult,               
                    'user' => $customer,            
                ]);
    			
    		}
    // 	}
    }
    
    protected function registerEmail(Request $request){

    	$validator = Validator::make($request->all(), [
			'email' => 'required|min:6',
		]);		

		if ($validator->fails()) {			

			return $this->sendFailResponse("Something Wrong! Validation Error","422");
		}
		

        try {

            $user = User::find($request->user_id);
            $user->email = $request->email;
            $user->save();
            
        } catch (\Exception $e) {
        	
           return $this->sendFailResponse("Something Wrong! Adding Phone number Error","422");
        }       

        $meal_lists = Meal::select('id','name')->get();

        $tokenResult = $user->createToken('Laravel Personal Access Client')->accessToken;


        return response()->json([
			'message' => "Successful",
            'status' => 200,
            'access_token' => $tokenResult,               
            'user' => $user,            
            'meal_lists' => $meal_lists,          
        ]);
    }
    
    
    protected function register(Request $request){

    	$validator = Validator::make($request->all(), [
			'name' => 'required',
            'email' => 'required|email|unique:users',
			'password' => 'required|confirmed',
			'phone' => 'required|min:6',
			'address' => 'required',
		]);		

		if ($validator->fails()) {			

			return $this->sendFailResponse("Something Wrong! Validation Error","422");
		}

        $image_name = "user.jpg";

        try {

            $user = User::create([
	            'name' => $request->name,
	            'email' => $request->email,
	            'password' => \Hash::make($request->password),
	            'photo_path' => $image_name,
	            'phone' => $request->phone,
	            'address' => $request->address,
	            'role_flag' => 3,
	            'prohibition_flag' => 1,
        	]);
            
        } catch (\Exception $e) {
        	
           return $this->sendFailResponse("Something Wrong! Creating User Error","422");
        }       

        $meal_lists = Meal::select('id','name')->get();

        $tokenResult = $user->createToken('Laravel Personal Access Client')->accessToken;

        return response()->json([
			'message' => "Successful",
            'status' => 200,
            'access_token' => $tokenResult,               
            'user' => $user,            
            'meal_lists' => $meal_lists,          
        ]);
    }
    
    
    protected function new_register(Request $request){

    	$validator = Validator::make($request->all(), [
    	    'name' => 'required',
			'password' => 'required|confirmed',
			'phone' => 'required|min:6',
		]);		

		if ($validator->fails()) {			

			return $this->sendFailResponse("Something Wrong! Validation Error","422");
		}

        
        try {

            $user = User::create([
                'name' => $request->name,
	            'password' => \Hash::make($request->password),
	            'phone' => $request->phone,
	            'role_flag' => 3,
	            'prohibition_flag' => 1,
        	]);
            
        } catch (\Exception $e) {
        	
           return $this->sendFailResponse("Something Wrong! Creating User Error","422");
        }       

        $meal_lists = Meal::select('id','name')->get();

        $tokenResult = $user->createToken('Laravel Personal Access Client')->accessToken;

        return response()->json([
			'message' => "Successful",
            'status' => 200,
            'access_token' => $tokenResult,               
            'user' => $user,            
            'meal_lists' => $meal_lists,          
        ]);
    }

    protected function loginProcess(Request $request){

    	$validator = Validator::make($request->all(), [
			'email' => 'required',
			'password' => 'required',
		]);

		if ($validator->fails()) {			

			return $this->sendFailResponse("Something Wrong! Validation Error.", "422");
		}

		$password = $request->password;

		$user = User::where('email', $request->email)->first();

		if (!isset($user)) {

			return $this->sendFailResponse("Something Wrong! User Not Found.", "422");
		}
		elseif (!\Hash::check($password, $user->password)) {
			
			return $this->sendFailResponse("Something Wrong! 123", "422"); 

		}elseif ($user->role_flag == 3){

			$meal_lists = Meal::select('id','name')->get();

            $tokenResult = $user->createToken('Laravel Personal Access Client')->accessToken;

            $user->photo_path = url("/") . '/photo/User/' . $user->photo_path;
           
            return response()->json([
                'message' => "Successful",
                'status' => 200,
                'access_token' => $tokenResult,               
                'user' => $user,            
                'meal_lists' => $meal_lists,          
            ]);

		}else{

            $table_type_lists  = TableType::all();

            $tokenResult = $user->createToken('Laravel Personal Access Client')->accessToken;

            $user->photo_path = url("/") . '/photo/User/' . $user->photo_path;
           
            return response()->json([
                'message' => "Successful",
                'status' => 200,
                'access_token' => $tokenResult,               
                'user' => $user,            
                'table_type_lists' => $table_type_lists,          
            ]);			
		}
    }
    
    protected function new_loginProcess(Request $request){

    	$validator = Validator::make($request->all(), [
			'phone' => 'required',
			'password' => 'required',
		]);

		if ($validator->fails()) {			

			return $this->sendFailResponse("Something Wrong! Validation Error.", "422");
		}

		$password = $request->password;

		$user = User::where('phone', $request->phone)->first();

		if (!isset($user)) {

			return $this->sendFailResponse("Something Wrong! User Not Found.", "422");
		}
		elseif (!\Hash::check($password, $user->password)) {
			
			return $this->sendFailResponse("Something Wrong! 123", "422"); 

		}elseif ($user->role_flag == 3){

			$meal_lists = Meal::select('id','name')->get();

            $tokenResult = $user->createToken('Laravel Personal Access Client')->accessToken;

            $user->photo_path = url("/") . '/photo/User/' . $user->photo_path;
           
            return response()->json([
                'message' => "Successful",
                'status' => 200,
                'access_token' => $tokenResult,               
                'user' => $user,            
                'meal_lists' => $meal_lists,          
            ]);

		}else{

            $table_type_lists  = TableType::all();

            $tokenResult = $user->createToken('Laravel Personal Access Client')->accessToken;

            $user->photo_path = url("/") . '/photo/User/' . $user->photo_path;
           
            return response()->json([
                'message' => "Successful",
                'status' => 200,
                'access_token' => $tokenResult,               
                'user' => $user,            
                'table_type_lists' => $table_type_lists,          
            ]);			
		}
    }


    protected function logoutProcess(Request $request){

    	$request->user()->token()->revoke();

    	$message = "Successfully Logout!";

    	return $this->sendSuccessResponse("logout-message", $message);
    }

    protected function updatePassword(Request $request){

    	$validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$@#%&*]).*$/',
        ]);

        if ($validator->fails()) {

        	return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
        }

        $user = User::find($request->user()->id);
            
        $current_pw = $request->current_password;

        if(!\Hash::check($current_pw, $user->password)){

            return $this->sendFailResponse("Something Wrong! Password doesn't match.", "400");
        }

        $has_new_pw = \Hash::make($request->new_password);

        $user->password = $has_new_pw;

        $user->save();

        return $this->sendSuccessResponse("user", $user);
    }

}
