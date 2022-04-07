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
        $request->validate([
            'status' => 'required|in:UNACKNOWLEDGED,ACKNOWLEDGED,PROCUREMENT ORDER INITIATED,DELAYED,READY FOR MISSION DISPATCH,ASSIGNED TO MISSION,FULFILLED',
            'last_updated_by' => 'required|exists:users,id',
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

    public function procurement_destroy(Request $request){
        $operations = Operations::find($request->id);
        $operations->delete();
        alert()->success('Yay','Procurement was successfully deleted');        
        return redirect(route('admin.operations.procurement.index'));
    }
}
