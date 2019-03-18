<?php

namespace App\Http\Middleware;

use Closure;
use App\Society;
use App\Http\Services\SetUpService;
use Illuminate\Support\Facades\Auth;

class VerifySociety
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //check for society
        if ($request->session()->has("society"))
        {
            //get society id from section
            $society = $request->session()->get("society");
            //find society
            $society = Society::find($society);
            if ($society !== null)
            {
                //check if user is part of society
                if($society->users()->where('user_id', Auth::user()->id)->exists())
                {
                    //share general data
                    view()->share('generalData', SetUpService::loadGeneralData($society));
                    return $next($request);
                }
            }

        }
        Auth::logout();
        return redirect()->route("front")->with("message", "We couldn't verify that you are a member of this society. Please Login to try again");
        
    }
}
