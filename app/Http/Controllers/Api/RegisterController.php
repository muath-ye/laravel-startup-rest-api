<?php
/**
 * Register Controller
 * PHP version 7.1
 * 
 * @category Controller
 * @package  RestAPI
 * @author   By Swadi <muath.ye@gmail.com>
 * @license  Swadi 
 * @link     specify.link.here
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;


/**
 * Register Controller
 * PHP version 7.1
 * 
 * @category Controller
 * @package  RestAPI
 * @author   By Swadi <muath.ye@gmail.com>
 * @license  Swadi 
 * @link     specify.link.here
 */
class RegisterController extends Base
{
    /**
     * Register or signup api method
     * 
     * @param \Illuminate\Http\Request $request 
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validateUser($request);

        if ($validator->fails()) {
            return $this->sendError(
                'Validation Error.', $validator->errors()
            );
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        return $this->sendResponse(
            $this->generateToken($user), 
            'User registered successfully!'
        );
    }

    /**
     * Login api method
     * 
     * @param \Illuminate\Http\Request $request 
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $attempt = $this->attemptUser($request);

        if ($attempt) {
            
            $user = Auth::user();
            $success = $this->generateToken($user);
            return $this->sendResponse($success, 'User logged in successfully!');

        } else {
            
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized']);
        
        }
    }

    ///////////////////////////////////////////////////////////////////////////////
    
    /**
     * Generate Api token for a user
     * 
     * @param App\User $user model
     * 
     * @return array
     */
    public function generateToken($user)
    {
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;

        return $success;
    }

    /**
     * Validate user input
     * 
     * @param \Illuminate\Http\Request $request 
     * 
     * @return boolean 
     */
    public function validateUser(Request $request)
    {
        return Validator::make(
            $request->all(),
            [
                'name'       => 'required',
                'email'      => 'required|email',
                'password'   => 'required',
                'c_password' => 'required|same:password',
            ]
        );
    }

    /**
     * Authintcate user
     * 
     * @param \Illuminate\Http\Request $request 
     * 
     * @return boolean 
     */
    public function attemptUser(Request $request)
    {
        return Auth::attempt(
            [
                'email'    => $request->email,
                'password' => $request->password
            ]
        );
    }
}
