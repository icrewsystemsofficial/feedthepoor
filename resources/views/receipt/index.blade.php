<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>

    <link type="text/css" href="{{ asset('theme/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="mx-auto my-5 w-50">
        <div class="card border border-dark  border-4">
            <div class="card-body">

                <div class="row">
                    <img src="{{ asset('images/branding/roshni-foundation.png') }}" alt="foundation_pic" class="ps-5" style="width:150px;">
                    <p class="col pt-3 text-center fs-3 fw-bolder text-secondary">Donation Payment Invoice
                        <i class="fas fa-receipt"></i>
                    </p>
                </div>

                <div class="row">
                    <div class="float-start mt-4 fs-6 fw-bolder ps-5 text-dark">
                        <p> SathishKumar </p>
                        <p> Invoice ID : 12345</p>
                        <p> Invoice Date : 28/Mar/2022</p>
                    </div>
                </div>

                <div class="row mt-2 ps-5 text-secondary fw-bolder">
                    <div class="col">
                         Cause
                    </div>
                    <div class="col">
                        Quantity
                    </div>
                    <div class="col">
                        Price
                    </div>
                    <div class="col">
                        Total Amount
                    </div>
                </div>

                <hr>

                <div class="row ps-5 fs-6">
                    <div class="col">
                        Wheel Chair
                    </div>
                    <div class="col">
                        2
                    </div>
                    <div class="col">
                        10000.00
                    </div>
                    <div class="col">
                        20000.00
                    </div>
                </div>

                <div class="pt-5 d-flex justify-content-between">
                    <p class="fs-3 fw-bolder text-dark ps-5">Total Amount</p>
                    <p class="text-secondary pe-2 fs-2 "> Rs.20000.00</p>
                </div>

                <p class="text-center text-secondary pt-2 fs-4"> Your <strong class="text-success">GREATNESS</strong> is not what you have, it's what you <strong class="text-success">GIVE</strong> </p>

                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>