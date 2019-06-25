<?php

namespace BiometriaIIE\Http\Controllers\Auth;

use BiometriaIIE\User;
use BiometriaIIE\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use GuzzleHttp\Client;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     * Envia el facetoken a la api para registrarlo en el faceset
     *
     * @param  array  $data
     * @return \BiometriaIIE\User
     */
    protected function create(array $data)
    {

        $api_key = '_vFHc0ga_XbxiA12BaZq8O8_0GQqAV5F';
        $api_secret = 'g8d6IiLW7GfQyfWKh5oTOSjsMvL5SjZr';
        $url = 'https://api-us.faceplusplus.com/facepp/v3';

        $client = new Client();

        $client->post($url . "/faceset/addface", [
            'form_params' => [
                'api_key'      => $api_key,
                'api_secret'   => $api_secret,
                'outer_id'     => 'iie1',
                'face_tokens'  => $data['image'],
            ],
        ]);

        $arr = array("@" => "A","." => "Dot","&" => "AnD");
        $user_id = strtr($data['email'],$arr);

        $client->post( $url . "/face/setuserid", [
            'form_params' => [
                'api_key'     => $api_key,
                'api_secret'  => $api_secret,
                'face_token'  => $data['image'],
                'user_id'     => $user_id,
            ],
        ]);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'image' => $data['image'],
        ]);
    }
}
