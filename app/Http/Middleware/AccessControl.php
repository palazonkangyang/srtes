<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Exceptions\AccessControlException;

class AccessControl
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
        switch ($this->checkRight($request)) {

            case 'super_admin':
                
                return $next($request);
            
            case 'admin':
                
                return $next($request);

            case 'super_user':
                
                return $next($request);

            default:
                
                 return redirect('dashboard')->with('not_allowed', 'You are not allowed to view the page');
        }

        
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    protected function getUrlName($request)
    {
        return str_replace('/', '.', ltrim($request->getRequestUri(), '/'));
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    protected function getUserRights($request)
    {
        if(Auth::check()){
            
            return $request->user()->roleid;

        } else {

            return redirect('dashboard');
        }
       
    }

    /**
     * @param $request
     *
     * @return bool
     */
    protected function checkRight($request)
    {
        switch ($this->getUserRights($request)) {
            case '-1':

                return 'super_admin';

            case '1':

                return 'admin';

            case '2':

                return 'super_user';

            default:
                
                return 'gen_users';

                break;
        }
        
    }

}
