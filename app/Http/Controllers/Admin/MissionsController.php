<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Mission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operations;

class MissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active_missions = Mission::where('mission_status', '!=', Mission::$status['COMPLETED'])->get();

        $active_volunteers = User::where('volunteer', 1)->where('available_for_mission', 1)->get();

        $procurement_items = Operations::where('status', 'READY FOR MISSION DISPATCH')->get();
        // dd($procurement_items);

        return view('admin.missions.index', [
            'active_missions' => $active_missions,
            'active_volunteers' => $active_volunteers,
            'procurement_items' => $procurement_items,
        ]);
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
            'field_manager_id' => 'required|integer',
        ]);



        dd(request()->input());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
