<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operations;
use App\Helpers\OperationsHelper;

class OperationsController extends Controller
{
    
    /**
     * procurement_index
     *
     * Return the procurement index page
     * 
     * @return void
     */
    public function procurement_index(){
        
        $operations = Operations::all();
        $total = 0;
        $allOperations = array();
        $toProcure = 0;
        $procured = 0;
        
        foreach ($operations as $operation) {
            array_push($allOperations, $operation->id);
            $total++;
            if ($operation->status != 'FULFILLED'){
                $toProcure++;
            }
            else{
                $procured++;
            }
        }
        $procuredPercent = round($procured / $total * 100,2);
        $toProcurePercent = round($toProcure/$total*100,2);



        return view('admin.operations.procurement.index', compact('operations','total','toProcure','procured','procuredPercent','toProcurePercent','allOperations'));
    }
    
    /**
     * procurement_update
     *
     * Update procurement status
     * 
     * @param  Request $request
     * @return void
     */
    public function procurement_update(Request $request){

        $request->validate([
            'status' => 'required|in:0,1,2,3,4,5,6',
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
    
    /**
     * procurement_destroy
     *
     * Delete Operation
     * 
     * @param  Request $request
     * @return void
     */
    public function destroy(Request $request){

        $operations = Operations::find($request->id);
        $operations->delete();
        alert()->success('Yay','Procurement was successfully deleted');
        return redirect(route('admin.operations.procurement.index'));
    }
}
