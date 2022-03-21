@extends('layouts.frontend')



@section('css')
<link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
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

<div style="padding-top: 300px;">
    <div class="container m-auto w-100 my-4">

        <p class="text-center p-2 fw-bolder fs-1"> FREQUENTLY ASKED QUESTIONS ???

        </p>


        <div class="card shadow p-3" id="faqs">
            @foreach($faq_categories as $category)

            <div class="card p-2 m-auto w-50 shadow-lg border bg-theme fs-3 fw-bolder text-center" id="category">
                {{$category->category_name}}
            </div>

            <p class="ps-5 pt-1 fs-5 fw-bold" id="description">{{$category->category_description}}</p>

            @foreach($faq_entries as $entry)
            <div class="accordion ps-5 m-1" id="accordionExample1">
                @if($category->id == $entry->category_id)
                <div class="card card-sm card-body border-light mb-0 shadow-lg">
                    <a href="#panel-1" data-target="#panel-1" class="accordion-panel-header" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="panel-1">
                        
                        <span class="h6 mb-0 font-weight-bold"> {{ $entry->entry_question }} </span>
                        <span class="icon  float-end"><i class="fas fa-plus"></i></span>
                    </a>
                    <div class="collapse" id="panel-1">
                        <div class="pt-3">
                            <p class="mb-0">
                                {{ $entry->entry_answer }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            @endforeach







            @endforeach
        </div>



    </div>
</div>

@endsection