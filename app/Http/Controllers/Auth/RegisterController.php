<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\JobSeeker;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'role' => ['required','numeric','in:1,2'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile_number' => ['required', 'numeric', 'digits:11','unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'company_name' => ['required_if:role_id,1','max:255'],
            'services' => ['required_if:role_id,1','max:255'],
            'company_description' => ['required_if:role_id,1','max:255']
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
        if(in_array($data['role'],['1'])){
            $role = Role::create([
                'role' => '2'
            ]); 

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'mobile_number' => $data['mobile_number'],
                'password' => Hash::make($data['password']),
                'role_id' => $role->id
            ]);

            Employer::create([
                'user_id' => $user->id,
                'company_name' => $data['company_name'],
                'company_description' => $data['company_description'],
                'services' => $data['services']
               ]);
        }
        else{
            $role = Role::create([
                'role' => '3'
            ]); 

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'mobile_number' => $data['mobile_number'],
                'password' => Hash::make($data['password']),
                'role_id' => $role->id
            ]);

            JobSeeker::create([
                'user_id' => $user->id
            ]);
        }

        return $user;
    }
}
