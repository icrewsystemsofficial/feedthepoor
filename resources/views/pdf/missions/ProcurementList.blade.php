
@extends('pdf.receipts.layout')

@section('content')
    @foreach ($data['donations'] as $donation)                    
        @for ($i = 0; $i < $donation[3]; $i++)
            <div class="container" style="margin-bottom: 50px;">            
                <p style="line-height: 18px; margin-top: -25px;">
                    Donated with love by <strong>{{ $donation[0] }}</strong> on <strong>{{ date('D M Y', strtotime($donation[1])) }}</strong>                
                    <br>
                    Thank you so much for your donation. We love you.
                    <br>
                    <i> <span style="font-size: 14px;">                        
                            {{ config('app.ngo_name') }}
                        </span><br>
                        <span style="font-size: 10px">
                            Item #{{ $donation[2] }}
                        </span>
                    </i>
                </p>    
            </div>
        @endfor
    @endforeach
@endsection
