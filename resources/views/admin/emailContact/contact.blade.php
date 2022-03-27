@extends('layouts.admin')

@section('css')

<link type="text/css" href="{{ asset('theme/css/additional.css') }}" rel="stylesheet">

@endsection

@section('content')

<div class="m-auto w-100 ">
    <div class="text-secondary text-center fw-bolder pb-2 fs-2 ">
        <i class="fa-solid fa-envelope-open-text"></i> Contact Details
    </div>

    <div class="row mx-auto mt-3 w-50">
        
            <div class="card text-center border-secondary rounded  mx-auto shadow-lg">
                <div class="card-header">
                    <span class="card-text small"><i class="far fa-calendar-alt mr-2"></i> {{ Carbon\Carbon::parse($contact->created_at)->diffForHumans()}}</span>
                </div>
                <div class="card-body">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-circle pb-3" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    <h5 class="card-title fs-2 text-uppercase">{{$contact->name}}</h5>
                    <h4 class="text-secondary fs-4">{{$contact->email}}</h4>

                    <p class="card-text fs-3 text-secondary fw-bolder">{{$contact->message}}</p>
                    
                </div>
               
            </div>
        
    </div>

    @if( $contact->status == 0)

    <div class="d-flex">

        <form action="{{ route('admin.contact.spam', $contact->id) }}" method="POST" class="me-2">@csrf
            <button class="btn btn-danger btn-lg">
                <i class="fa-solid fa-circle-exclamation"></i> &nbsp;
                Mark as Spam
            </button>
        </form>

        <form action="{{ route('admin.contact.contacted', $contact->id)  }}" method="POST">@csrf
            <button class="btn btn-theme btn-lg">
                <i class="fa-solid fa-user-check"></i> &nbsp;
                Mark as Contacted
            </button>
        </form>
    </div>


    @endif

    <div class="d-flex justify-content-end">
        <form action="{{ route('admin.contact.delete', $contact->id) }}" method="POST">@csrf @method('DELETE')
            <button class="btn btn-danger btn-lg">
                &nbsp;
                <i class="fa-solid fa-trash-can"></i> Delete Mail
            </button>
        </form>
    </div>






</div>

@endsection