<?php

namespace BiometriaIEE\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ApiController extends Controller{

    public function index(Request $request){

        if($request->ajax()){
            return response()->json([
                [
                    'mensaje' => strval(random_int(100, 999))
                ],[
                    'mensaje' => strval(random_int(100, 999))
                ]
            ], 200);
        }
        return view('cuestionario');
    }

    public function FaceplusplusPostRequest(){

        $API_KEY = "_vFHc0ga_XbxiA12BaZq8O8_0GQqAV5F";
        $API_SECRET = "g8d6IiLW7GfQyfWKh5oTOSjsMvL5SjZr";
        $API_URL = 'https://api-us.faceplusplus.com/facepp/v3';


        $client = new Client();
        $url = $API_URL + "/detect";

        $myBody['name'] = "Demo";

        $request = $client->post($url,  [
            'body'=>$myBody
            ]);
        $response = $request->send();

        dd($response);

    }

}
