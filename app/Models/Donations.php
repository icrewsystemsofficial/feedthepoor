<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
use App\Models\Causes;

class Donations extends Model
{
    use HasFactory;

    protected $table = 'donations';

    protected $fillable = [
        'donor_id',
        'donor_name',
        'donation_amount',
        'donation_in_words',
        'cause_id',
        'campaign_id',
        'cause_name',
        'donation_status',
        'payment_method',
        'razorpay_payment_id',
    ];

    public static $status = [
        'PENDING' => 0,
        'VERIFIED' => 1,
        'FAILED' => 2,
        'REFUNDED' => 3,
    ];

    public static $payment_methods = [
        'UNKNOWN' => 0,
        'CASH' => 1,
        'CHEQUE' => 2,
        'DEMAND DRAFT' => 3,
        'RAZORPAY' => 4,
    ];

    public function donor_id()
    {
        return $this->belongsTo(Users::class, 'donor_id', 'id');
    }

    public function cause_id()
    {
        return $this->belongsTo(Causes::class, 'cause_id', 'id');
    }

    // TODO This is to be moved to a helper. To make sure changes don't brake, the fn can still call the model, but the code is
    // to be referenced to the helper.
    public static function Show_Amount_In_Words($num) {
        $ones =array('',' One',' Two',' Three',' Four',' Five',' Six',' Seven',' Eight',' Nine',' Ten',' Eleven',' Twelve',' Thirteen',' Fourteen',' Fifteen',' Sixteen',' Seventeen',' Eighteen',' Nineteen');
        $tens = array('','',' Twenty',' Thirty',' Fourty',' Fifty',' Sixty',' Seventy',' Eighty',' Ninety',);
        $triplets = array('',' Thousand',' Lakh',' Crore',' Arab',' Kharab');

        $str ="";
        $th= (int)($num/1000);
        $x = (int)($num/100) %10;
        $fo= explode('.',$num);

        if($fo[0] !=null){
            $y=(int) substr($fo[0],-2);

        }else{
            $y=0;
        }

        if($x > 0){
            $str =$ones[$x].' Hundred';
        }
        if($y>0){
            if($y<20){
                $str .=$ones[$y];
            }
        else {
            $str .=$tens[($y/10)].$ones[($y%10)];
        }
        }
        $tri=1;
        while($th!=0){

            $lk = $th%100;
            $th = (int)($th/100);
            $count =$tri;

            if($lk<20){
                if($lk == 0){
                $tri =0;}
                $str = $ones[$lk].$triplets[$tri].$str;
                $tri=$count;
                $tri++;
            }else{
                $str = $tens[$lk/10].$ones[$lk%10].$triplets[$tri].$str;
                $tri++;
            }
        }
        $num =(float)$num;
        if(is_float($num)){
            $fo= (String) $num;
            $fo= explode('.',$fo);
            $fo1= @$fo[1];

        }else{
            $fo1 =0;
        }
        $check = (int) $num;
        if($check !=0){
            return $str.' Rupees'.self::forDecimal($fo1);
        }
        else{
            return self::forDecimal($fo1);
        }
    }

    private static function forDecimal($num){
        $ones =array('',' One',' Two',' Three',' Four',' Five',' Six',' Seven',' Eight',' Nine',' Ten',' Eleven',' Twelve',' Thirteen',' Fourteen',' Fifteen',' Sixteen',' Seventeen',' Eighteen',' Nineteen');
        $tens = array('','',' Twenty',' Thirty',' Fourty',' Fifty',' Sixty',' Seventy',' Eighty',' Ninety',);
        $str="";
        $len = strlen($num);
        if($len==1){
            $num=$num*10;
        }
        $x= $num%100;
        if($x>0){
        if($x<20){
            $str = $ones[$x].' Paise';
        }else{
            $str = $tens[$x/10].$ones[$x%10].' Paise';
        }
        }
        return $str;
    }

}
