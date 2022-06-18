<?php
#get auto import
namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Support\Str;
use App\Models\SettingGroup;
use Illuminate\Http\Request;
use App\Providers\SettingsProvider;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.index', [
            'setting_groups' => SettingGroup::where('name', '!=', null)->get(),
            'setting_types' => SettingsProvider::types(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request('description') != '') { $description = request('description'); } else { $description = 'No description provided'; }

        $setting = new Setting;
        $setting->group_id = request('setting_group');
        $setting->key = Str::snake(request('name'));
        $setting->name = Str::ucfirst(request('name'));
        $setting->description = $description;
        $setting->value = request('value');
        $setting->core = request('core_setting');
        $setting->type = request('setting_type');
        $setting->save();
        return redirect(route('admin.settings.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        dd($request->input());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }


    public function group_create() {

    }

    public function group_edit() {

    }

    public function group_save(Request $request) {
        $group = new SettingGroup;
        $group->name = request('name');
        $group->description = request('description');
        $group->save();
        return redirect()->route('admin.settings.index');
    }

    public function group_update($id) {
        $group = SettingGroup::where('id', $id)->first();
        $group->name = request('name');
        $group->description = request('description');
        $group->save();
        return redirect()->route('admin.settings.index');
    }

    public function group_delete($id) {
        $group = SettingGroup::where('id', $id)->delete();
        return redirect()->route('admin.settings.index');
    }


    public function activity_logs() {
        $activities = Activity::orderBy('id', 'DESC')->get();
        return view('admin.activitylog.index', ['activities' => $activities]);
    }
}
