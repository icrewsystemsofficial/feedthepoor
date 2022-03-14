<?php

namespace App\Http\Controllers\Admin;

use App\Models\Causes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class CausesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $causes = Causes::all();
        return view('admin.causes.index', compact('causes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'icon' => 'required|string',
            'per_unit_cost' => 'required|numeric',
            'yield_context' => 'required|string',
        ]);      
        if (!str_contains($request->yield_context,"%YIELD%")){
            throw ValidationException::withMessages(['yield_context' => 'Yield context must have a value %YIELD% denoting the number of people benifiting from the donation']);
        }
        Causes::create($request->all());
        alert()->success('Yay','Cause "'.$request->name.'" was successfully created');
        return redirect(route('admin.causes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\causes  $causes
     * @return \Illuminate\Http\Response
     */
    public function manage(Request $request, Causes $cause)
    {
        $cause = Causes::find($request->id);
        return view('admin.causes.manage', compact('cause'));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Causes  $causes
     * @return \Illuminate\Http\Response
     */
    public function edit(Causes $cause)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Causes  $causes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'icon' => 'required|string',
            'per_unit_cost' => 'required|numeric',
            'yield_context' => 'required|string',
        ]);
        if (!str_contains($request->yield_context,"%YIELD%")){
            throw ValidationException::withMessages(['yield_context' => 'Yield context must have a value %YIELD% denoting the number of people benifiting from the donation']);
        }
        Causes::find($request->id)->update($request->all());
        alert()->success('Yay','Cause "'.$request->name.'" was successfully updated');
        return redirect(route('admin.causes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Causes  $causes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        $cause = Causes::find($request->id);     
        $cause->delete();
        alert()->success('Yay','Cause "'.$cause->name.'" was successfully deleted');
        return redirect(route('admin.causes.index'));
    }
}
