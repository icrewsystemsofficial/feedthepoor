<?php

namespace App\Http\Middleware;

use App\Models\ModuleAccess;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AccessCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $route_name = Route::current()->getName();
        $module_access = ModuleAccess::whereJsonContains('module_route_path', $route_name)->first();
        if ($module_access) {

            $allowed_perms = json_decode($module_access->permissions_that_can_access);

            foreach ($allowed_perms as $permission) {
                if (!auth()->user()->can($permission)) {
                    activity()->log(Auth::user()->name.' is trying to access an unauthorized page.' . $route_name);
                    abort(403, 'Whoops! Unauthorized access');
                }
            }
        }

        return $next($request);

    }
}
