<?php

namespace BiometriaIEE\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;

class ApiController extends Controller{

    public function FPPdetectFace(string $image_base64){

        $api_key = '_vFHc0ga_XbxiA12BaZq8O8_0GQqAV5F';
        $api_secret = 'g8d6IiLW7GfQyfWKh5oTOSjsMvL5SjZr';

        $client = new Client();

        $response = $client->post("https://api-us.faceplusplus.com/facepp/v3/detect", [
            'form_params' => [
                'api_key'      => $api_key,
                'api_secret'   => $api_secret,
                'image_base64' => $image_base64,
                'return_attributes' => 'facequality',
            ],
        ]);

        return $response->getBody()->getContents();
    }

    public function FPPcompareFace(string $image64_1, string $image64_2){

        $api_key = '_vFHc0ga_XbxiA12BaZq8O8_0GQqAV5F';
        $api_secret = 'g8d6IiLW7GfQyfWKh5oTOSjsMvL5SjZr';

        $client = new Client();

        $response = $client->post("https://api-us.faceplusplus.com/facepp/v3/compare", [
            'form_params' => [
                'api_key'      => $api_key,
                'api_secret'   => $api_secret,
                'image_base64' => $image64_1,
                'image_base64_2' => $image64_2,
            ],
        ]);

        return $response->getBody()->getContents();
    }

    public function index(Request $request){

        if ($request->ajax()) {
            $img_base64 = $request->input('image64');
            $faceplusdetect = $this->FPPdetectFace($img_base64);

            if ($img_base64 != "") {
                return response($faceplusdetect, 200);
            }
        }

        return view('cuestionario');
    }
}
