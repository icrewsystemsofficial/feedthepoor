<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
<style>
@media only screen and (max-width: 600px) {
.inner-body {
width: 100% !important;
}

.footer {
width: 100% !important;
}
}

@media only screen and (max-width: 500px) {
.button {
width: 100% !important;
}
}

@page { margin: 100px 25px; }
header {
    position: fixed; top: -80px; left: 0px; right: 0px; height: 50px;
}
footer { position: fixed; bottom: -80px; left: 0px; right: 0px;
    background-color: #fafafa; border-radius: 5px;
    padding: 10px;
    height: 30px;
}
p { page-break-after: always; }
p:last-child { page-break-after: never; }
</style>
</head>
<body>
    <header>
        <center>
            <img src="{{ asset('images/branding/roshni-foundation.png') }}" alt="" style="width: 100px; height: auto;">
            <br>
            <span style="font-size: 8px; position: fixed; top: -50px; height: 20px; font-weight: bold;">
                DEPARTMENT OF HUMAN RESOURCES & OPERATIONS
            </span>
        </center>
    </header>
    <footer>
        <div style="font-size: 12px;">
            <center>
                {{ config('app.ngo_name') }}
            <br>
            <span style="font-size: 10px;">
                "The Artisan House", Second Floor, Plot # 98, 3/11, CSI Church Street, Jayanagar, Porur, Chennai, India. 600044.
            </span>
            </center>
        </div>
    </footer>
    <main>
        {{ Illuminate\Mail\Markdown::parse($slot) }}
    </main>
</body>
</html>
