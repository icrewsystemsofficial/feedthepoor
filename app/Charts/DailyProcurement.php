<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Operations;

class DailyProcurement extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $operations = Operations::all();
        $values = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($operations as $operation) {
            $values[$operation->created_at->month]++;
        }
        return Chartisan::build()
            ->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])
            ->dataset('Procurement', $values);
    }
}