<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Pdf | #feedThePoor</title>
</head>

<style>
<style>.page-break {
    page-break-after: always;
}

.center {
    margin: auto;
    width: 50%;
    padding: 10px;
}
</style>
</style>

<body>

    <div class="container pl-5 pr-5">
        <h1 class="d-flex justify-content-center pr-5 pt-3">Donor Details </h1>
        <a href="{{url('pdfGen/pdf')}}" class="btn btn-warning mb-3" style="float:right;"><b>Download Pdf</b></a>
        <a href="{{url('admin')}}" class="btn btn-danger mb-3" style="float:left;"><b>Back</b></a>
        <table border="4" cellpadding="4" cellspacing="5" class="table table-bordered">
            <thead>
                <th class="px-md-5">Details</th>
                <th>Qrcode</th>
            </thead>
            <tbody>
                @foreach($page as $donor)

                @if($donor->amount > 50 )
                @for ($i = 0; $i < ($donor->amount/50); $i++)

                    <tr>
                        <td class="px-md-5">
                            Donor : {{$donor->donor_name}}<br>
                            "Remember that the happiest people are not those getting more, but those giving more"<br>
                            Donor Id : {{$donor->id}}
                        </td>
                        <td><img src="https://cdn.discordapp.com/attachments/776414947084075028/781044766577000458/qrcode.png"
                                style="height:100px; width:100px;" alt=""></td>
                    </tr>

                    @endfor

                    @else
                    <tr>
                        <td class="px-md-5">
                            Donor : {{$donor->donor_name}}<br>
                            "Remember that the happiest people are not those getting more, but those giving more"<br>
                            Donor Id : {{$donor->id}}
                        </td>
                        <td><img src="https://cdn.discordapp.com/attachments/776414947084075028/781044766577000458/qrcode.png"
                                style="height:100px; width:100px;" alt=""></td>
                    </tr>


                    @endif

                    @endforeach
            </tbody>
        </table>
        {{ $page->links() }}
       <!-- <nav aria-label="Page navigation example-5">
  <ul class="pagination justify-content-end">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" tabindex="-1">Next</a>
    </li>
  </ul>
</nav>-->
    </div>
</body>

</html>