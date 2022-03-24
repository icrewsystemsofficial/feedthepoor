@extends('layouts.frontend')



@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  #description {
    color: rgb(128, 128, 128);
  }

  #category {
    opacity: 0.8;
  }

  #faqs {
    background-color: rgb(249 250 251);
  }
</style>
@endsection

@section('content')

<div style="padding-top: 120px;">
  <div class="container m-auto w-100 my-4">

    <p class="text-center p-2 fw-bolder fs-1"> FREQUENTLY ASKED QUESTIONS <i class="fa-solid fa-person-circle-question"></i>

    </p>



    <div class="card shadow p-3" id="faqs">
      @foreach($faq_categories as $category)

      @if( $category->category_name == "Payments")
      <p class="p-2 m-auto mt-2 w-50 shadow-lg border bg-theme fs-3 fw-bolder text-center rounded-pill" id="category">
        {{$category->category_name}} <i class="fa-solid fa-sack-dollar"></i>
      </p>
      @elseif( $category->category_name == "General")
      <p class="p-2 m-auto mt-2 w-50 shadow-lg border bg-theme fs-3 fw-bolder text-center rounded-pill" id="category">
        {{$category->category_name}} <i class="fa-solid fa-brain"></i>
      </p>
      @elseif( $category->category_name == "Donation")
      <p class="p-2 m-auto mt-2 w-50 shadow-lg border bg-theme fs-3 fw-bolder text-center rounded-pill" id="category">
        {{$category->category_name}} <i class="fa-solid fa-hand-holding-dollar"></i>
      </p>
      @endif

      <p class="ps-5  pt-1 fs-5 fw-bold" id="description">{{$category->category_description}}</p>

      <div class="accordion ps-5 m-1" id="accordionExample1">
        @foreach($faq_entries as $entry)

        @if($category->id == $entry->category_id)

        <div class="accordion-item" >
          <h2 class="accordion-header" id="heading{{$entry->id}}">
            <button class="accordion-button collapsed border " type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$entry->id}}" aria-expanded="false" aria-controls="collapse{{$entry->id}}">
            <i class="fa-solid fa-lightbulb pe-2"></i> {{$entry->entry_question}}
            </button>
          </h2>
          <div id="collapse{{$entry->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$entry->id}}" data-bs-parent="#accordionExample1">
            <div class="accordion-body ps-5">
             {{$entry->entry_answer}}
            </div>
          </div>
        </div>

        @endif

        @endforeach
      </div>

      @endforeach

    </div>

    



  </div>
</div>

@endsection