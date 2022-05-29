<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModuleAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class ModuleAccessController extends Controller
{

    public function index()
    {
        $module_accesses = ModuleAccess::all();

        return view('admin.moduleaccess.index', compact('module_accesses'));
    }

    public function create_access()
    {
        $permissions = Permission::all();
        $routes = Route::getRoutes()->getRoutesByName();
//        dd($routes);
        $controllers = [];

        foreach ($routes as $route) {
            $action = $route->getAction();

            if (array_key_exists('controller', $action)) {
                // You can also use explode('@', $action['controller']); here
                // to separate the class name from the method
                $controllers[] = explode('@', $action['controller']);
            }
        }

//        dd($controllers);

        return view('admin.moduleaccess.create', compact('permissions', 'routes', 'controllers'));
    }

    public function store_access(Request $request)
    {
//        dd($request->all());

        $module_access = new ModuleAccess;
        $module_access->module_name = strtolower($request->module_name);
        $module_access->module_controller_class = $request->module_controller_class;
        $module_access->module_route_path = json_encode($request->module_route_path);
        $module_access->permissions_that_can_access = json_encode($request->permissions_that_can_access);
        $module_access->save();

        return redirect(route('admin.access.index'));

//now i need to write a middleware that checks if the auth user has a permission to access a module
//        so first get all the permissions that an auth user has and
//    compare with the permissions in the module access table if true redirect else 403

    }

    public function edit_access($id)
    {
        $module_access = ModuleAccess::find($id);
        $permissions = Permission::all();
        $routes = Route::getRoutes()->getRoutesByName();
//        dd($routes);
        $controllers = [];

        foreach ($routes as $route) {
            $action = $route->getAction();

            if (array_key_exists('controller', $action)) {
                // You can also use explode('@', $action['controller']); here
                // to separate the class name from the method
                $controllers[] = explode('@', $action['controller']);
            }
        }
        return view('admin.moduleaccess.edit', compact('module_access','controllers','routes','permissions'));
    }

    public function update_access(Request $request,$id)
    {
        $module_access = ModuleAccess::find($id);
        $module_access->module_name = strtolower($request->module_name);
        $module_access->module_controller_class = $request->module_controller_class;
        $module_access->module_route_path = json_encode($request->module_route_path);
        $module_access->permissions_that_can_access = json_encode($request->permissions_that_can_access);
        $module_access->update();

        return redirect(route('admin.access.index'));
    }

    public function delete_access($id)
    {
        $module_access = ModuleAccess::find($id);

        $module_access->delete();

        return  redirect(route('admin.access.index'));
    }
}
