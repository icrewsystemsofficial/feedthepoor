<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="jquery.viewbox.min.js"></script>
    <style>
        .vl {
            border-left: 6px solid ;
            border-color: rgb(12, 122, 191);
            height: 120px;
            margin-left: 65px;
            position: relative;
        }
    </style>

</head>

<body>
    <div class="w-75 h-100 m-auto mt-3 mb-3 border border-3 rounded">

        <div class="m-auto w-50 border border-2 border-secondary mt-2 mb-2 rounded-pill bg-light bg-gradient">
            <p class="text-center p-1 fs-1" id="title">Donation Tracking</p>
        </div>

        <div class="row">
            <p class="col ps-5 text-dark fs-3"> Donator name : {{$donation_names[0]}}</p>
            <p class="col pe-5 text-secondary fs-4 text-end ">Transaction ID: F2345GHI8900</p>
        </div>

        <div class="text-center m-auto" style="width: 120px;">
            <p class="fs-4 p-2 border rounded bg-danger text-light"> PENDING </p>
        </div>

        <div class="h-100 w-75 m-auto border border-2 border-light mb-2 rounded bg-light bg-gradient">


            <div class="form-check ms-5 mt-3">
                <input class="form-check-input shadow" type="checkbox"  value="" style="width: 40px; height:40px;" checked>
                <label class="form-check-label fs-3 ps-3">
                    Donation Received
                </label>
                <img src="{{asset('tracking-images/donation.png')}}" alt="" width="50px" height="50px" class="image-link ms-3 rounded">
            </div>

            <div class="vl">
            </div>

            <div class="form-check ms-5 ">
                <input class="form-check-input shadow" type="checkbox" value="" style="width: 40px; height:40px;">
                <label class="form-check-label fs-3 ps-3">
                    Receipt Generated
                </label>
                <img src="{{asset('tracking-images/receipt.png')}}" alt="" width="50px" height="50px" class="ms-3 rounded">
            </div>

            <div class="vl">
            </div>

            <div class="form-check ms-5 mt-3">
                <input class="form-check-input shadow" type="checkbox" value="" style="width: 40px; height:40px;">
                <label class="form-check-label fs-3 ps-3">
                    Procurement Order Placed
                </label>
                <img src="{{asset('tracking-images/procurement.png')}}" alt="" width="50px" height="50px" class="ms-3 rounded">
            </div>

            <div class="vl">
            </div>

            <div class="form-check ms-5 mt-3">
                <input class="form-check-input shadow" type="checkbox" value="" style="width: 40px; height:40px;">
                <label class="form-check-label fs-3 ps-3">
                    Mission ID assigned
                </label>
                <img src="{{asset('tracking-images/mission.png')}}" alt="" width="50px" height="50px" class="ms-3 rounded">
            </div>

            <div class="vl">
            </div>

            <div class="form-check ms-5 mt-3 mb-3">
                <input class="form-check-input shadow" type="checkbox" value="" style="width: 40px; height:40px;">
                <label class="form-check-label fs-3 ps-3">
                    Volunteers Generated
                </label>
                <img src="{{asset('tracking-images/volunteers.png')}}" alt="" width="50px" height="50px" class="ms-3 rounded">
            </div>
        </div>
    </div>

    <script>

    </script>



</body>

</html>