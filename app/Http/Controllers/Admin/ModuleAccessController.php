<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class ModuleAccessController extends Controller
{

    public function create_access()
    {
        $permissions = Permission::all();
        $routes =  Route::getRoutes()->getRoutesByName();
//        dd($routes);


        return view('admin.moduleaccess.index',compact('permissions','routes'));
    }
}
