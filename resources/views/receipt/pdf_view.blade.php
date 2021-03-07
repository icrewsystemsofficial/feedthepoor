<!doctype html>
<html>
<head>
	@foreach ($payment as $payment)
	@endforeach
    <meta charset="utf-8">
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 2px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 25px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
    	<center>
    		<img src="https://cdn.discordapp.com/attachments/530789778912837640/691801343723307068/1585008642050.png" style="width:100%; max-width:100px;">
    		<br>
    		<strong>#feed</strong>ThePoor
    		<br><br>
    	</center>
        <table cellpadding="0" cellspacing="0">
            <tr class="">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h1>Donation Recipt</h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                            	<p>
                            		<strong>Date:</strong> {{ strtoupper(date('d M Y')) }}<br>
                            		<h3>Dear {{ $payment->notes->name }}, </h3>
                            		Thank you for your generous donation. The funds you donated will be used in the Area's of Rajasthan to feed
                            		underprivledged children, physically handicapped and elders. Please take comfort in knowing that soon, your good deed 
                            		would have fed many hungry souls. You have our most sincere grattitude {{ $payment->notes->name }}.
                            		<br><br>
                            		 <strong>Recipt ID #:</strong> LX98765556789<br>
                                <strong>Received By:</strong> Roshni Charitable Trust (REG: 123456789)<br>
                                <strong>Donated By:</strong> {{ $payment->notes->name }}<br>
                            	</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Payment Method
                </td>

                <td>
                    Payment ID
                </td>
            </tr>

            <tr class="details">
                <td>
                    Online (Razorpay)
                </td>

                <td>
                     {{ $payment->id }}
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Item
                </td>

                <td>
                    Amount
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Daily Meals (Rs. 60 x {{ round(($payment->amount / 100) / 60) }} Nos)
                </td>

                <td>
                    <strong>{{ ($payment->amount / 100) }} {{ $payment->currency }}</strong>
                </td>
            </tr>
		
			
		 <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                            	<p>
                            		<center>
                            			* This is a computer generated recipt, no signatures are required. * 
                            		</center>
                            		<br>
                            		Donated using #feedThePoor website (https://feedthepoor.online), who's development was proudly sponsored by icrewsystems Software Engineering LLP, India
                            	</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>