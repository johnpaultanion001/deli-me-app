<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use File;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['string', 'required', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_number' => ['required', 'string', 'min:8','max:11','unique:users'],
            'address' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'upload_id' =>  ['required' , 'mimes:png,jpg,jpeg,svg,bmp,ico', 'max:2040'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $id = $data['upload_id'];
        $extension = $id->getClientOriginalExtension(); 
        $file_name_to_save = time().".".$extension;
        $id->move('assets/img/id/', $file_name_to_save);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'contact_number' => $data['contact_number'],
            'address' => $data['address'],
            'id_image' => $file_name_to_save,
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }
}
