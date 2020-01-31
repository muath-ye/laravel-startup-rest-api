<?php
/**
 * Base Controller
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
use Illuminate\Http\Request;

/**
 * Base Controller
 * PHP version 7.1
 * 
 * @category Controller
 * @package  RestAPI
 * @author   By Swadi <muath.ye@gmail.com>
 * @license  Swadi 
 * @link     specify.link.here
 */
class BaseController extends Controller
{
    /**
     * Success response method.
     * 
     * @param string $result 
     * @param string $message 
     * @param int    $code 
     * 
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    /**
     * Error response method.
     * 
     * @param string $error 
     * @param string $errorMessage 
     * @param int    $code 
     * 
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessage = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessage)) {
            $response['data'] = $errorMessage;
        }

        return response()->json($response, $code);
    }
}
