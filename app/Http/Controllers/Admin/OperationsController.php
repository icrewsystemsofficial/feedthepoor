<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operations;

class OperationsController extends Controller
{
    public function status_index()
    {
        $operations = Operations::all();
        return view('admin.operations.status.index', compact('operations'));        
    }

    public function procurement_index(){
        $operations = Operations::all();
        return view('admin.operations.procurement.index', compact('operations'));
    }

    public function missions_index(){
        $operations = Operations::all();
        return view('admin.operations.missions.index', compact('operations'));
    }

    public function volunteers_index(){
        $operations = Operations::all();
        return view('admin.operations.volunteers.index', compact('operations'));
    }
}
