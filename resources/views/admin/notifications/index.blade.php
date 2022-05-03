@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <h3>
            Notifications
        </h3>

        {{-- <p class="mt-n2">
            <small>
                The places where our donation activities take place
            </small>
        </p> --}}

        
        <div class="card mt-3">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-12">
                   @forelse (App\Helpers\NotificationHelper::getNotifications('all') as $notification)
                   <a href="{{ url($notification->data['action']) }}" class="list-group-item m-3"
                     @if (!$notification->read_at)
                        style="background-color: rgb(229 229 229)"                         
                     @endif

                      >
                      <div class="row g-0 align-items-center m-1">
                         <div class="col-1">
                            <i class="text-{{ $notification->data['color'] }}" data-feather="{{ $notification->data['icon'] }}"></i>
                         </div>
                         <div class="col-10">
                            <div class="fw-bold">{{$notification->data['title']}}</div>
                            <div class="fw-normal mt-1">{{ $notification->data['body'] }}.</div>
                            <div class="text-muted small mt-1">{{ $notification->created_at->diffForHumans() }} &bull; {{ $notification->created_at->format('H:i A, d/m/Y') }}</div>
                         </div>
                      </div>
                   </a>
                  @empty
                  <div class="container mt-3">
                    <p>
                        There are no new notifications 😀
                    </p>
                  </div>

                  @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection