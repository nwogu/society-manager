<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Services\SetUpService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Setup Service
     */
    protected $setUpService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SetUpService $setUpService)
    {
        $this->middleware('guest')->except('logout');
        //inject setup service
        $this->setUpService = $setUpService;
        $this->redirectTo = route('home');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        //parse credentials
        $credentials = $this->credentials($request);

        if (Auth::attempt($credentials)) {
            // Resolve Domain
            if ($this->setUpService->resolveDomain($request, Auth::user()))
            {
                //redirect to dash board
                return redirect()->intended('dashboard');
            }

            //log out
            Auth::logout();
        }

    }

    /**
     * parses login credentials to verify authentication method
     */
    protected function credentials(Request $request)
    {
        //construct credentials
        if (is_numeric($request->email))
        {
            return array(
                "phone" => $request->email,
                "password" => $request->password
            );
        }

        return array(
            "email" => $request->email,
            "password" => $request->password
        );
    }
}
