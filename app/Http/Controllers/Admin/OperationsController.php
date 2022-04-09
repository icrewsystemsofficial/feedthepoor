<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operations;
use App\Helpers\OperationsHelper;

class OperationsController extends Controller
{

    public function procurement_index(){
        $operations = Operations::all();
        return view('admin.operations.procurement.index', compact('operations'));
    }

    public function procurement_update(Request $request){
        if ($request->update == 1){
            $request->validate([
                'status' => 'in:UNACKNOWLEDGED,ACKNOWLEDGED,PROCUREMENT ORDER INITIATED,DELAYED,READY FOR MISSION DISPATCH,ASSIGNED TO MISSION,FULFILLED',
                'last_updated_by' => 'required|exists:users,id',
                'location' => 'exists:locations,id',
            ]);
            $operation = Operations::find($request->id);        
            $newBadge = OperationsHelper::getProcurementBadge($request->status);
            $final = array();
            $final['badge'] = $newBadge;
            $final['status_new'] = $request->status;
            $final['status_old'] = $operation->status;
            $operation->update($request->all());
            return response()->json($final);
        }
        else if ($request->update == 2){
            $request->validate([
                'last_updated_by' => 'required|exists:users,id',
                'location' => 'exists:locations,id',
            ]);
            $operation = Operations::find($request->id);
            $location = $request->location;
            $updated = $request->last_updated_by;
            $operation->update([
                'location' => $location,
                'last_updated_by' => $updated,
            ]);
            return $operation->status;
        }
                
    }

    public function procurement_destroy(Request $request){
        $operations = Operations::find($request->id);
        $operations->delete();
        alert()->success('Yay','Procurement was successfully deleted');        
        return redirect(route('admin.operations.procurement.index'));
    }
}
