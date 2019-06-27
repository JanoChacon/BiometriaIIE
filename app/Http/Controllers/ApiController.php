<?php

namespace BiometriaIIE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ApiController extends Controller{

    private $api_key;
    private $api_secret;
    private $url;

    public function __construct() {
        $this->api_key = '_vFHc0ga_XbxiA12BaZq8O8_0GQqAV5F';
        $this->api_secret = 'g8d6IiLW7GfQyfWKh5oTOSjsMvL5SjZr';
        $this->url = 'https://api-us.faceplusplus.com/facepp/v3';
    }

    public function apiDetect(Request $request){

        $client = new Client();

        if ($request->ajax()) {
            $img_base64 = $request->input('image64');
            $response = $client->post( $this->url . "/detect", [
                'form_params' => [
                    'api_key'      => $this->api_key,
                    'api_secret'   => $this->api_secret,
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
        $client = new Client();

        if ($request->ajax()) {
            $img_base64 = $request->input('image64');
            $response = $client->post($this->url . "/compare", [
                'form_params' => [
                    'api_key'     => $this->api_key,
                    'api_secret'  => $this->api_secret,
                    'face_token1' => $user->image,
                    'image_base64_2' => $img_base64,
                ],
                ['connect_timeout' => 3.14],
            ]);
            if ($img_base64 != "") {
                return response($response->getBody()->getContents(), 200);
            }
        }
        return view('cuestionario');
    }

    public function apiFacesetCreate(Request $request){

        $client = new Client();

            $displayname = $request->input('displayname');
            $outerid = $request->input('outerid');
            $response = $client->post( $this->url . "/faceset/create", [
                'form_params' => [
                    'api_key'      => $this->api_key,
                    'api_secret'   => $this->api_secret,
                    'display_name' => $displayname,
                    'outer_id'     => $outerid,
                ],
            ]);
            return response($response->getBody()->getContents(), 200);


    }
    public function apiFacesetAddFace(Request $request){

        $client = new Client();

            $outer_id = $request->input('outer_id');
            $face_tokens = $request->input('facetokens');
            $response = $client->post( $this->url . "/faceset/addface", [
                'form_params' => [
                    'api_key'      => $this->api_key,
                    'api_secret'   => $this->api_secret,
                    'outer_id'     => $outer_id,
                    'face_tokens'  => $face_tokens,
                ],
            ]);
            return response($response->getBody()->getContents(), 200);

    }

    public function apiFacesetDeleteFace(Request $request){

        $client = new Client();

            $outer_id = $request->input('outer_id');
            $face_tokens = $request->input('facetokens');
            $response = $client->post( $this->url . "/faceset/removeface", [
                'form_params' => [
                    'api_key'      => $this->api_key,
                    'api_secret'   => $this->api_secret,
                    'outer_id'     => $outer_id,
                    'face_tokens'  => $face_tokens,
                ],
            ]);
            return response($response->getBody()->getContents(), 200);

    }

    public function apiSearchFace(Request $request){

        $client = new Client();

            $face_token = $request->input('facetoken');
            $outer_id = $request->input('outerid');
            $response = $client->post( $this->url . "/search", [
                'form_params' => [
                    'api_key'   => $this->api_key,
                    'api_secret'=> $this->api_secret,
                    'face_token'=> $face_token,
                    'outer_id'  => $outer_id,
                ],
            ]);
            return response($response->getBody()->getContents(), 200);

    }

    public function apigetFacesets(){

        $client = new Client();

            $response = $client->post( $this->url . "/faceset/getfacesets", [
                'form_params' => [
                    'api_key'      => $this->api_key,
                    'api_secret'   => $this->api_secret,
                ],
            ]);
            return response($response->getBody()->getContents(), 200);

    }

    public function apiFacesetDelete(Request $request){

        $client = new Client();

            $faceset_token = $request->input('facesettoken');
            $response = $client->post( $this->url . "/faceset/delete", [
                'form_params' => [
                    'api_key'      => $this->api_key,
                    'api_secret'   => $this->api_secret,
                    'faceset_token'     => $faceset_token,
                ],
            ]);
            return response($response->getBody()->getContents(), 200);

    }

    public function apiFaceSetId(Request $request){

        $client = new Client();
        $face_token = $request->input('facetoken');
        $user_id = $request->input('userid');

            $response = $client->post( $this->url . "/face/setuserid", [
                'form_params' => [
                    'api_key'      => $this->api_key,
                    'api_secret'   => $this->api_secret,
                    'face_token'     => $face_token,
                    'user_id'     => $user_id,
                ],
            ]);
            return response($response->getBody()->getContents(), 200);

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
