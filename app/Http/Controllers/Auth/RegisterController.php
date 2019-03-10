<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Services\SetUpService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * Setup Service
     */
    protected $setupService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SetUpService $setupService)
    {
        $this->middleware('guest');
        //inject setup service
        $this->setupService = $setupService;
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'role' => 'required|string|',
            'email' => 'required_if:phone,""|max:255',
            'phone' => 'max:255',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|string|max:255|unique:societies'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return $this->setupService->setupAccount($data);
    }
}
