@extends('layouts.admin')
    {{-- if (auth()->user()->name != $entry->author_name){
        abort(403);
    } This checks if current user is the same as author --}}

@section('js')
<script>
    function trigger_delete() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

            Swal.showLoading();

            if (result.isConfirmed) {


                setTimeout(() => {
                    Swal.fire(
                        'Alright!',
                        'FAQ is being deleted..',
                        'success'
                    );

                    document.getElementById('delete_faq_form').submit();
                }, 1500);
            }
        });
    }
</script>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3>
            <strong>FAQs</strong> <b>Questions</b> Manage
        </h3>
        <p class="mt-n2">
            <small>
                Edit/delete existing questions
            </small>
        </p>
    </div>
</div>
<div class="row mb-3">
    <div class="col-6">
        <div class="flex d-flex">
            <div>
                <a href="{{ route('admin.faq.questions.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-angle-left me-2"></i> Back
                </a>
            </div>

            <div class="ml-2">
                &nbsp;
            </div>



            <div class="">
                <button class="btn btn-danger" type="button" onclick="trigger_delete();">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>

                {{-- This form is submitted by JS method --}}
                <form action="{{ route('admin.faq.questions.destroy', $entry->id) }}" id="delete_faq_form" method="POST">@csrf @method('DELETE')</form>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="row">
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
<div class="card mt-3">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-12">
            <form action="{{ route('admin.faq.questions.update', $entry->id) }}" id="update_form" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="form-group mb-2">
                    <label for="author_name">Author Name</label>
                    <input type="text" class="form-control" id="author_name" name="author_name" value="{{ $entry->author_name }}" required>
                </div>
                <div class="form-group mb-2">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach($entry->category_list as $id=>$name)
                            @if ($id == $entry->category_id)
                                <option value="{{ $id }}" selected>{{ $name[0] }}</option>
                            @else
                                @if ($name[1] == 1) {{-- Displaying only active categories --}}
                                    <option value="{{ $id }}">{{ $name[0] }}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="entry_question">Question</label>
                    <input type="text" class="form-control" id="entry_question" name="entry_question" value="{{ $entry->entry_question }}" required>
                </div>
                <div class="form-group mb-2">
                    <label for="entry_answer">Answer</label>
                    <textarea name="entry_answer" id="entry_answer" class="form-control" required>{{ $entry->entry_answer }}</textarea>
                </div>
                <div class="form-group mb-2">
                    <span onclick="document.getElementById('update_form').submit();">
                        <x-loadingbutton>Save</x-loadingbutton>
                    </span>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(()=>{
        $('#category_id').select2();
        CKEDITOR.replace('entry_answer');
    })    
$(document).on('select2:open', (e) => {
    const selectId = e.target.id    
    $(".select2-search__field[aria-controls='select2-" + selectId + "-results']").each(function (
        key,
        value,
    ){
        value.focus();
    })
})
</script>
@endsection
