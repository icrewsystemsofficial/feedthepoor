<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Operations;

class ProcurementStatus extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $operations = Operations::all();
        $status = [
                'UNACKNOWLEDGED',
                'ACKNOWLEDGED',
                'PROCUREMENT ORDER INITIATED',
                'DELAYED',
                'READY FOR MISSION DISPATCH',
                'ASSIGNED TO MISSION',
                'FULFILLED',
        ];
        $values = [0,0,0,0,0,0,0];
        foreach ($operations as $operation) {
            $values[array_search($operation->status, $status)]++;
        }
        return Chartisan::build()
            ->labels([
                'UNACKNOWLEDGED',
                'ACKNOWLEDGED',
                'PROCUREMENT ORDER INITIATED',
                'DELAYED',
                'READY FOR MISSION DISPATCH',
                'ASSIGNED TO MISSION',
                'FULFILLED',
            ])
            ->dataset('Status', $values);
    }
}