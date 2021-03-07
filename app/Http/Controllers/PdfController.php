<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use PDF;


class PdfController extends Controller
{
    public function index()
    {
        $page = DB::table('donations')->paginate(2);
        return view('admin.operations.pdfGen',['page'=>$page])->with('page',$page);
    }

    function get_donor_data()
    {
        $donor_data = DB::table('donations')->get();
        return $donor_data;
    }

    function pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_to_html());
        return $pdf->stream();
    }
    

    //main html pdf 
    function convert_to_html()
    {
        $donor_data = $this->get_donor_data();
        $output = '
    <table class="table table-bordered" border="2" cellpadding="2" cellspacing="2">
    <tr>
    <th class="px-md-5">Details</th>
    <th>Qrcode</th>
    </tr>
    
        ';
    foreach($donor_data as $donor){
        if($donor->amount > 50 ){
        for ($i = 0; $i < ($donor->amount/50); $i++){
            $output .='
    <tr>
    <td class="px-md-5" >
    <span>Donor : '.$donor->donor_name.'</span><br>
    <span>"Remember that the happiest people are not those getting more, but those giving more"</span><br>
    <span>Donor Id :'.$donor->id.'</span>
    </td>
    <td><img src="https://cdn.discordapp.com/attachments/776414947084075028/781044766577000458/qrcode.png" style="height:100px; width:90px;" alt=""></td>
    </tr>';}
        }else{
    $output .='
    <tr>
    <td class="px-md-5" >
    <span>Donor : '.$donor->donor_name.'</span><br>
    <span>"Remember that the happiest people are not those getting more, but those giving more"</span><br>
    <span>Donor Id :'.$donor->id.'</span>
    </td>
    <td><img src="https://cdn.discordapp.com/attachments/776414947084075028/781044766577000458/qrcode.png" style="height:100px; width:90px;" alt=""></td>
    </tr>';}}
    $output .='</table>';
    
    return $output;
    
    }
}