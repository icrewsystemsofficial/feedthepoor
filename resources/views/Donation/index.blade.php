@extends('layouts.frontend')

@section('title')
@endsection
@section('css')
<style>
body {
    background: rgb(191,191,194);
background: linear-gradient(186deg, rgba(191,191,194,1) 0%, rgba(250,247,250,1) 95%, rgba(205,199,255,0) 100%);
}
.stepwizard-step p {
    margin-top: 10px;
}
.stepwizard-row {
    display: table-row;
   

}
form {
    background-color: white;
    font-family: Raleway;
    border-radius: 10px
    border :2px;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
   
}
.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}
.container {
     display: block;
     position: relative;
    
     cursor: pointer;
     -webkit-user-select: none;
     -moz-user-select: none;
     -ms-user-select: none;
     user-select: none
 }
 .setup-content{
     margin-left:-15px;
 }
</style>
@endsection
@section('js')
<script>
   $(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn'),
  		  allPrevBtn = $('.prevBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });
  
  allPrevBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");
          prevStepWizard.removeAttr('disabled').trigger('click');
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');
});


    $(function () {
        $("#chkPassport").click(function () {
            if ($(this).is(":checked")) {
                $("#dvPassport").show();
            } else {
                $("#dvPassport").hide();
            }
        });
    });
</script>
@endsection

@section('content')
<section class="slice py-6 pt-lg-5 pb-lg-8 bg-gradient-info" >
    <!-- Container -->
    <div class="container d-flex align-items-center text-center text-lg-left">

        <div class="col px-0">
            <div class="row row-grid align-items-center">
                <div class="col-lg-6">
                    <!-- Heading -->
                    <h1 class="display-5 text-white text-left my-4">
                        The "Crew in Command"
                    </h1>
                    <!-- Text -->
                    <p class="lead text-white text-center text-lg-left opacity-8">
                        The leadership here, is inspired. It's about vision & responsibility. Making
                        decisions that pave the path to bold new frontiers.
                    </p>
                    <!-- Buttons -->
                </div>
               
            </div>
        </div>
    </div>
    <!-- SVG separator -->
    <div class="shape-container shape-line shape-position-bottom">
        <svg width="2560px" height="100px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 2560 100" style="enable-background:new 0 0 2560 100;" xml:space="preserve" class="">
            <polygon points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</section>
<section class="container-fluid ">

<div class="container ">
<div class="col-md-12 " style="margin-top:100px;margin-left:300px;" >
 

     
    <strong  class="h1" >Fill Up Your User Details</strong></h2>
                <p class="ml-5">Fill all form field to go to next step</p>
</div>
    <div class="stepwizard col-md-6" style="margin-left:200px;">
 
        <div class="stepwizard-row  setup-panel">
            
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-primary btn-circle"><i class="fas fa-user"></i></a>
            <p>Step 1</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fas fa-money-bill-alt"></i></a>
            <p>Step 2</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fas fa-comment"></i></a>
            <p>Step 3</p>
        </div>
        <h2>
        </div>
        
    </div>
    
    <form method="POST" action="{{ route('donation.save') }}" autocomplete="off" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_method" value="PUT">
        <div class="row setup-content " id="step-1" style="margin-right:-25px;">
        <div class="col-11 text-center p-0 mt-1">
            <div class="col-md-12">
            <div class=" pt-5 pb-5 pr-5 pl-5 ml-5 ">
            <h3 class="align-center"> Personal Details</h3>
            <div class="row">
                    <div class="col-lg-6 text-left">
                        <div class="form-group focused">
                            <label class="form-control-label"  for="validationCustom01">Name<span class="small text-danger">*</span></label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="col-lg-6 text-left">
                        <div class="form-group focused">
                            <label class="form-control-label" for="last_name">Last name</label>
                            <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Last name" >
                        </div>
                    </div>
             </div>
             <div class="row">
                    <div class="col-lg-6 text-left">
                        <div class="form-group focused">
                            <label class="form-control-label" for="name">Email Id<span class="small text-danger">*</span></label>
                            <input type="text" id="email" class="form-control" name="email" placeholder="email">
                        </div>
                    </div>
                    <div class="col-lg-6 text-left">
                        <div class="form-group focused">
                            <label class="form-control-label" for="last_name">Date Of Birth</label>
                            <input type="date" id="dob" class="form-control" name="dob" >
                        </div>
                    </div>
             </div>
            
            <div class="form-group focused text-left">
            <label class="form-control-label " for="name">Address<span class="small text-danger">*</span></label>
                <textarea required="required" name="address" class="form-control" placeholder="Enter your address"></textarea>
            </div>
            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group text-left">
                                        <label class="form-control-label" for="address">Landmark<span class="small text-danger">*</span></label>
                                        <input type="text" id="address" class="form-control" name="landmark"  >
                                    </div>
                                </div>
                            </div>
            <div class="row">
                    <div class="col-lg-6 text-left">
                        <div class="form-group focused">
                            <label class="form-control-label" for="name">Pincode</label>
                            <input type="text" id="pincode" class="form-control" name="pincode" placeholder="600 001">
                        </div>
                    </div>
                    <div class="col-lg-6 text-left">
                        <div class="form-group focused">
                            <label class="form-control-label" for="last_name">City<span class="small text-danger">*</span></label>
                            <input type="text" id="city" class="form-control" name="city" placeholder="city" >
                        </div>
                    </div>
             </div>
             <div class="row">
                    <div class="col-lg-6 text-left">
                        <div class="form-group focused">
                            <label class="form-control-label" for="name">State<span class="small text-danger">*</span></label>
                            <input type="text" id="state" class="form-control" name="state" placeholder="state">
                        </div>
                    </div>
                    <div class="col-lg-6 text-left">
                        <div class="form-group focused">
                            <label class="form-control-label" for="last_name">Country<span class="small text-danger">*</span></label>
                            <input type="text" id="Country" class="form-control" name="country" placeholder="country" >
                        </div>
                    </div>
             </div>
            <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
            </div>
        </div>
        </div>
        </div>
        <div class="row setup-content" id="step-2">
        <div class="col-12  p-0 mt-3 mb-2">
            <div class="col-md-12">
            <div class=" pt-5 pb-5 pr-5 pl-5 ml-5">

                <h3 class="text-center">Amount</h3>
            
                <div class="col-lg-11 text-left">
                    <label class="form-control-label text-left">Donation Amount</label>
                    <input maxlength="200" name="amount" type="text" required="required" class="form-control" placeholder="1000">
                </div>
                <br>
            
                <label for="chkPassport" class="form-control-label text-left" >
                    <input type="checkbox" id="chkPassport" />
                    80g reduvtion
                </label>
                
                <div class="col-lg-11 text-left" id="dvPassport" name="panid" style="display: none">
                    <label class="form-control-label  text-left">Pan Card Number</label>
                    <input type="text" id="txtPassportNumber" name="panid" class="form-control" placeholder="1000">
                </div> <br>
                <div class="col-md-12">

                    <button class="btn btn-primary prevBtn btn-outline-primary pull-left" type="button">Previous</button>
                    <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>

                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="row setup-content" id="step-3">
        <div class="col-11  p-0 mt-3 mb-2">
            <div class="col-md-12">
            <div class=" pt-5 pb-5 pr-5 pl-5 ml-5">
            <h3 class="text-center">Comments</h3>

                <div class="form-group">
                    <label class="form-control-label text-left">Comments to the volunteer</label>
                    <textarea maxlength="200" type="text" required="required" name="comments" class="form-control" placeholder="1000"></textarea>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary prevBtn btn-outline-primary pull-left" type="button">Previous</button>
                    <button class="btn btn-primary nextBtn pull-right" type="submit">Submit</button>
                </div>
</div>    
            </div>
        </div>
        </div>
    </form>
</div>
</div>
<BR><BR>
<BR>
<BR>

</section>

@endsection



