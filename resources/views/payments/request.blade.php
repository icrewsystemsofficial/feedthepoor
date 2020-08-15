@extends('layouts.layouts')
@section('content')

<?php
$mode = "TEST"; //<------------ Change to TEST for test server, PROD for production

extract($_POST);
  $secretKey = "c5895f85cb7d299ba7cc78907744d32a69c5fd4e";
  $postData = array(
  "appId" => "1235099d801e5372b0c853fb605321",
  "orderId" => $orderId,
  "orderAmount" => $orderAmount,
  "orderCurrency" => $orderCurrency,
  "orderNote" => $orderNote,
  "customerName" => $customerName,
  "customerPhone" => $customerPhone,
  "customerEmail" => $customerEmail,
  "returnUrl" => $returnUrl,
  "notifyUrl" => $notifyUrl,
);
ksort($postData);
$signatureData = "";
foreach ($postData as $key => $value){
    $signatureData .= $key.$value;
}
$signature = hash_hmac('sha256', $signatureData, $secretKey,true);
$signature = base64_encode($signature);

if ($mode == "PROD") {
  $url = "https://www.cashfree.com/checkout/post/submit";
} else {
  $url = "https://test.cashfree.com/billpay/checkout/post/submit";
}

?>

<section class="py-xl">
  <!-- <span class="mask bg-primary alpha-6"></span> -->
    <div class="container d-flex align-items-center no-padding">
        <div class="col">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                          <form action="<?php echo $url; ?>" name="frm1" method="post">
                              <p>Please wait.......</p>
                              <input type="hidden" name="signature" value='<?php echo $signature; ?>'/>
                              <input type="hidden" name="orderNote" value='<?php echo $orderNote; ?>'/>
                              <input type="hidden" name="orderCurrency" value='<?php echo $orderCurrency; ?>'/>
                              <input type="hidden" name="customerName" value='<?php echo $customerName; ?>'/>
                              <input type="hidden" name="customerEmail" value='<?php echo $customerEmail; ?>'/>
                              <input type="hidden" name="customerPhone" value='<?php echo $customerPhone; ?>'/>
                              <input type="hidden" name="orderAmount" value='<?php echo $orderAmount; ?>'/>
                              <input type ="hidden" name="notifyUrl" value='<?php echo $notifyUrl; ?>'/>
                              <input type ="hidden" name="returnUrl" value='<?php echo $returnUrl; ?>'/>
                              <input type="hidden" name="appId" value='<?php echo $appId; ?>'/>
                              <input type="hidden" name="orderId" value='<?php echo $orderId; ?>'/>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
  document.frm1.submit();
</script>

@endsection
