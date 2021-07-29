@extends('layouts.admin')
@section('css')
@endsection
@section('js')
<script>
function copy2clpbd(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}
</script>
@endsection
@section('main-content')
<div class="about-area area-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="row">
 						<div class="col-md-6 col-sm-6 col-xs-12 mt-5 ">
							<div class="card border border-primary">
								<div class="card-body">
									<h4 class="card-title">Donate 500 Meals</h5>
									<h2 class="card-text">₹ 10,000</p>
									<a href="" target="_blank" class="btn btn-primary btn-sm">Donate Now</a>
								</div>
								</div>
							</div>


						<div class="col-md-6 col-sm-6 col-xs-12 mt-5">
						<div class="card border border-primary">
								<div class="card-body">
									<h4 class="card-title">Donate 500 Meals</h5>
									<h2 class="card-text">₹ 10,000</p>
									<a href="" target="_blank" class="btn btn-primary btn-sm">Donate Now</a>
								</div>
								</div>
							</div>

						<div class="col-md-6 col-sm-6 col-xs-12 mt-5">
						<div class="card border border-primary">
								<div class="card-body">
									<h4 class="card-title">Donate 500 Meals</h5>
									<h2 class="card-text">₹ 10,000</p>
									<a href="" target="_blank" class="btn btn-primary btn-sm">Donate Now</a>
								</div>
								</div>
							</div>

						<div class="col-md-6 col-sm-6 col-xs-12 mt-5">
						<div class="card border border-primary">
								<div class="card-body">
									<h4 class="card-title">Donate 500 Meals</h5>
									<h2 class="card-text">₹ 10,000</p>
									<a href="" target="_blank" class="btn btn-primary btn-sm">Donate Now</a>
								</div>
								</div>
							</div>

					</div>




					
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="footer-content">
								
								<div class="footer-head">
									<div class="footer-logo donationbank">
										<h5><b>Donation Through Bank (NEFT/ RTGS)</b></h5>
									</div>
									<p><b>Bank Name - Yes Bank</b><br>
										<b>Account Name - <span id="acname1">International Society For Krishna
												Consciousness</span></b>
										<button class="btn btn-sm btn-light" onclick="copy2clpbd('#acnum1');">Copy</button>
										<br>
										<b> Account Number – <span id="acnum1">093294600000129</span></b>
										<button class="btn btn-sm btn-light" onclick="copy2clpbd('#acnum1');">Copy</button>
										<br>
										<b>IFSC Code - <span id="ifsc1">YESB0000932</span></b>
										<button class="btn btn-sm btn-light" onclick="copy2clpbd('#ifsc1');">Copy</button>
									</p>
									<hr>
									<p class="avail">Avail 80G Benefits on all
										the Donations made<br> to Feed The Poor</p>
									<span class="certi">Exemption Certificate Ref. No.: No.: vk- fu- ¼Nw-½ eq-
										<br>u-/80&amp;th/1667/2007/2008-2009 Validity extended perpetually<br> vide CBDT
										Circular No. 7/2010 dated 27/10/2010</span>
									<div style="margin-top:20px;"><a href="https://razorpay.com/payment-gateway/" target="_blank"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXQA8A5yDdCL7xfJkIlu4l84ru7zyHcVasGaxeB57S0kXcBUNSkZryfgpUVEgGCclYkQ&usqp=CAU" alt=""></a></div>
									<!-- <h5><b>Pay by Paytm</b></h5> --> <br>
									<a href="https://razorpay.com/payment-gateway/" target="_blank" style="padding-top:130px;font-size:20px; color:#1a1512;">
									https://razorpay.com/payment-gateway/</a>
								</div>
									
							</div>
						</div>
					</div>
				</div>
				<HR>
			<div class="row">
				<div class="col">
						<div class="row">
							<div class="col ">
							<table width="105%" class="table d-flex justify-content-center">
							<tbody>
								
								<tr>
									<td >
										<h4 class="sec-head">Donate 1,000 Meals</h4>
									</td>
									<td >
										<h3 class="sec-head"><span>₹ 20,000</span></h3>
									</td>
									<td  style="text-align: center;" class="yellow-border"><a href="" target="_blank" class="btn btn-primary btn-sm">DONATE NOW</a></td>
								</tr>
								<tr>
									<td >
										<h4 class="sec-head">Donate 2,500 Meals</h4>
									</td>
									<td >
										<h3 class="sec-head"><span>₹ 50,000</span></h3>
									</td>
									<td  style="text-align: center;" class="yellow-border"><a href="" target="_blank" class="btn btn-primary btn-sm">DONATE NOW</a></td>
								</tr>
								<tr>
									<td >
										<h4 class="sec-head">Donate 5,000 Meals</h4>
									</td>
									<td >
										<h3 class="sec-head"><span>₹ 1,00,000</span></h3>
									</td>
									<td  style="text-align: center;" class="yellow-border"><a href="" target="_blank" class="btn btn-primary btn-sm">DONATE NOW</a></td>
								</tr>
								<tr>
									<td >
										<h4 class="sec-head">Donate 10,000 Meals</h4>
									</td>
									<td>
										<h3 class="sec-head"><span>₹ 2,00,000</span></h3>
									</td>
									<td  style="text-align: center;" class="yellow-border"><a href="" target="_blank" class="btn btn-primary btn-sm">DONATE NOW</a></td>
								</tr>
								<tr>
									<td >
										<h4 class="sec-head">Donate 25,000 Meals</h4>
									</td>
									<td >
										<h3 class="sec-head"><span>₹ 5,00,000</span></h3>
									</td>
									<td  style="text-align: center;" ><a href="" target="_blank" class="btn btn-primary btn-sm">DONATE NOW</a></td>
								</tr>
							</tbody>
						</table>
				</div>
			</div>
		</div>
</div>
@endsection