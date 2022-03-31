<!DOCTYPE html>

<head>

    <title>Payment Receipt</title>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="overall" style="margin: auto; width:570px; margin-top:60px; padding:20px">
        <div class="cards" style="border:solid 6px black;">
            <div class="cardbody">

                <div class="rows">
                
                    <p class="cols" style="text-align: center; padding-top:27px; font-size:30px; color:rgb(128,128,128);font-weight:bold;">Donation Payment Invoice
                    </p>
                </div>
                

                <div class="rows2">
                    <div style="margin-top:24px;font-size:18px;font-weight:bold;padding-left:24px;color:black;">
                        <p> Name : {{$data['donor_name']}} </p>
                        <p> Invoice ID : 12345</p>
                        <p> Invoice Date : 28/Mar/2022</p>
                        <p> PAN ID : {{$data['donor_PAN']}}</p>
                    </div>
                </div>

                <div class="rows3" style="font-weight: bold;color:rgb(176,176,176);margin-top:9px;text-align: center;padding:10px 5px;">
                Cause  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Quantity  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; Price  &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; Amount
                   
                </div>

                <div style="margin-left:10px;margin-right:90px; background-color:black; width:540px; height:1px;"></div>

                <div class="rows4" style="color:black;margin-top:9px;text-align:center;padding:10px 5px;">
                Wheel Chair  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2 &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; {{$data['donation_amount']}}.00  &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; 20000.00
                  
                </div>

                <div style="padding-top: 48px; display:flex; justify-content: space-between;">
                    <p style="font-size: 27px;text-align: center;  font-weight:bold; color:black; padding-left:10px;">Total Amount  ----------------  Rs.20000.00</p>
                   
                </div>

                <p style="text-align: center; color:rgb(128,128,128); padding-top:10px; font-size:27px"> Your <strong style="color:green;font-weight:bold;">GREATNESS</strong> is not what you have, <br> it's what you <strong style="color:green;font-weight:bold;">GIVE</strong> </p>


            </div>
        </div>
    </div>

</body>

</html>