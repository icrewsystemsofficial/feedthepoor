<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operations;
use App\Models\Donations;
use App\Helpers\OperationsHelper;
use App\Jobs\Operations\OperationsUpdateMail;
use App\Helpers\NotificationHelper;

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
            if ($operation->status != 6){ //Check if status is FULFILLED i.e. 6
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
            'status' => 'in:0,1,2,3,4,5,6',
            'last_updated_by' => 'required|exists:users,id',
            'location_id' => 'exists:locations,id',
        ]);
        $operation = Operations::find($request->id);     
            
        
        if (isset($request->status)){
            $final = array();
            $final['status_old'] = $operation->status;                                             
            /*if ($request->status > count(json_decode($operation->timestamps))){
                $final['status'] = $request->status;
                $final['timestamps'] = json_encode(json_decode($operation->timestamps) + array_fill(0, $request->status - count(json_decode($operation->timestamps)), date('Y-m-d H:i:s')));
            }*/ 
            //This will help keep a track of timestamps when status is updated so we can display it in the track donation view
            $operation->update($request->all());
            $newBadge = OperationsHelper::getProcurementBadge($request->status);            
            $final['badge'] = $newBadge;
            $final['status_new'] = $request->status;  
            activity()->log('Updated procurement status of operation with id: #' . $operation->id.' by user with id: #'.auth()->user()->id);          
            $donation = Donations::find($operation->donation_id);                
            NotificationHelper::user($donation->donor_id)
            ->title('Operation status changed')
            ->body('Status for the operation for your donation (operation #'.$operation->id.') has been updated to '.OperationsHelper::get_operations_status_badge($operation->status))
            ->type('MAIL')
            ->notify();
            return response()->json($final);
        }
        if ($request->location_id){
            $operation->update($request->all());
            activity()->log('Updated location of operation with id: #' . $operation->id.' by user with id: #'.auth()->user()->id);            
        }
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
