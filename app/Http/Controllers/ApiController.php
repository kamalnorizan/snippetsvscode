<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
class ApiController extends Controller
{
    public function index()
    {
        $posts = Post::limit(10)->get();
        return response()->json($posts, 200);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email'=> $request->email, 'password'=> $request->password])){
            $user = Auth::user();
            $success['token']= $user->createToken('TheBlog')->accessToken;
            $success['name']= $user->name;

            return $this->sendResponse($success, 'User login successfully');
        }else{
            return $this->sendError('Unauthorised', ['error'=>'Unauthorized']);
        }
    }

    public function sendError($error, $errorMessages = [], $code=404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        $response['data'] = $errorMessages;

        return response()->json($response, $code);
    }

    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }
}
