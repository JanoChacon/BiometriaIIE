<?php

namespace BiometriaIIE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use BiometriaIIE\User;
use Illuminate\Hashing\BcryptHasher;

class ApiController extends Controller{

    public function apiDetect(Request $request){

        $api_key = '_vFHc0ga_XbxiA12BaZq8O8_0GQqAV5F';
        $api_secret = 'g8d6IiLW7GfQyfWKh5oTOSjsMvL5SjZr';
        $client = new Client();

        if ($request->ajax()) {
            $img_base64 = $request->input('image64');
            $response = $client->post("https://api-us.faceplusplus.com/facepp/v3/detect", [
                'form_params' => [
                    'api_key'      => $api_key,
                    'api_secret'   => $api_secret,
                    'image_base64' => $img_base64,
                    'return_attributes' => 'facequality',
                ],
            ]);
            if ($img_base64 != "") {
                return response($response->getBody()->getContents(), 200);
            }
        }
        return view('welcome');
    }

    public function apiCompare(Request $request){

        $user = Auth::user();
        $api_key = '_vFHc0ga_XbxiA12BaZq8O8_0GQqAV5F';
        $api_secret = 'g8d6IiLW7GfQyfWKh5oTOSjsMvL5SjZr';
        $client = new Client();

        if ($request->ajax()) {
            $img_base64 = $request->input('image64');
            $response = $client->post("https://api-us.faceplusplus.com/facepp/v3/compare", [
                'form_params' => [
                    'api_key'     => $api_key,
                    'api_secret'  => $api_secret,
                    'face_token1' => $user->image,
                    'image_base64_2' => $img_base64,
                ],
            ]);
            if ($img_base64 != "") {
                return response($response->getBody()->getContents(), 200);
            }
        }
        return view('cuestionario');
    }

    public function apiSession(Request $request){

        $user = Auth::user();
        $hasher = app('hash');

        if ($request->ajax()) {
            if ($request->input('email') == $user->email && $hasher->check($request->input('password'), $user->password)) {
                return response("true", 200);
            }
        }
        return response("false", 200);
    }

    public function index(){
        session_start();

        $_SESSION['loaded']="";

        if ($_SESSION['loaded']==false){

            $_SESSION['loaded'] = true;

            return view("cuestionario", ["loaded"=>true]);
        }
            return view("cuestionario", ["loaded"=>false]);
    }
}
