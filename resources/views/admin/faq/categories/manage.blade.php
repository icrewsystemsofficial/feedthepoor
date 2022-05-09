@extends('layouts.admin')

@section('js')
<script>
    function trigger_delete() {
        Swal.fire({
            title: 'Are you sure?',
            text: "This will delete the category and its corresponding questions. You won't be able to revert this!",
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
                        'Category and corresponding questions are being deleted..',
                        'success'
                    );

                    document.getElementById('delete_category_form').submit();
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
            FAQs <span class="text-muted">></span> Categories <span class="text-muted">></span> Manage
        </h3>
        <p class="mt-n2">
            <small>
                Edit/delete existing categories
            </small>
        </p>
    </div>
</div>
<div class="row mb-3">
    <div class="col-6">
        <div class="flex d-flex">
            <div>
                <a href="{{ route('admin.faq.categories.index') }}" class="btn btn-primary">
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
                <form action="{{ route('admin.faq.categories.destroy', $category->id) }}" id="delete_category_form" method="POST">@csrf @method('DELETE')</form>
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
            <form action="{{ route('admin.faq.categories.update', $category->id) }}" id="update_form" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="form-group mb-2">
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name }}" required>
                </div>
                <div class="form-group mb-2">
                    <label for="category_description">Category Description</label>
                    <textarea class="form-control" id="category_description" name="category_description" rows="3" required>{{ $category->category_description }}</textarea>
                </div>
                <div class="form-group mb-2">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="category_status" name="category_status" {{ ($category->category_status == 1) ? 'checked' : '' }}>
                    </div>
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
    $(document).ready(function() {
        $('#category_status').bootstrapSwitch({
            onText: 'Active',
            offText: 'Inactive',
            onColor: 'primary',
            offColor: 'danger',
        });
    });
</script>
@endsection