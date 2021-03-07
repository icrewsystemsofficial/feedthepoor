<?php

namespace App\Http\Controllers\Admin;

use App\NGO;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NGOController extends Controller
{
    public function index()
    {
        $ngos = NGO::all();
        return view('admin.ngo.index')->with('ngos', $ngos);
    }

    public function view($id = '') {
        if($id == '') {
            notify()->error('NGO ID was not given', 'Whoops!');
            return redirect()->back();
        }

        $ngo = NGO::find($id);
        if($ngo) {
            return view('admin.ngo.view')->with('ngo', $ngo);
        } else {
            notify()->error('NGO with ID # '. $id . ' was not found', 'Whoops!');
            return redirect()->back();
        }
    }
}
