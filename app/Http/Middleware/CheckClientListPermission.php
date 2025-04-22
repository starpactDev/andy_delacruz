<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckClientListPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
         // Check if the client list is set to 'off'
         $isClientListOff = DB::table('manage_permission_for_managers')
         ->where('key', 'client_list')
         ->where('value', 'off')
         ->exists();

     if ($isClientListOff) {
         // Redirect with a message or abort with a 403 status
         return redirect()->route('user.dashboard')->with('error', 'Access to the client list is restricted.');
     }
        return $next($request);
    }
}
