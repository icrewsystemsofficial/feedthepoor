@extends('layouts.admin')

@section('js')

<script>
    $(document).ready(function() {        
        $('#category_status').bootstrapSwitch({
            onText: 'Active',
            offText: 'Inactive',
            onColor: 'primary',
            offColor: 'danger',
        });
        $('#table2').DataTable();
        $("input[type='search']").attr('id','search');
    });
</script>

@endsection

@section('content')
<div class="row">
    <div class="col-12">

        @if ($errors->any())
            <div class="row p-3">
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

        <div class="modal fade" id="newCategoryModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adding new category</h5>
                    </div>
                    <div class="modal-body m-3">

                        <form action="{{ route('admin.faq.categories.store') }}" id="new_category_form" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="category_name">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" required placeholder="Enter name of the category">
                            </div>
                            <div class="form-group mb-2">
                                <label for="category_description">Category Description</label>
                                <textarea name="category_description" id="category_description" class="form-control" required placeholder="Category's description"></textarea>
                            </div>
                            <div class="form-group mb-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="category_status" name="category_status" checked>
                                </div>
                            </div>                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <span onclick="document.getElementById('new_category_form').submit();">
                                    <x-loadingbutton>Create</x-loadingbutton>
                                </span>
                            </div>

                    </form>
                </div>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>
                    FAQs <span class="text-muted">></span> Categories
                </h3>
                <p class="mt-n2">
                    <small>
                        Categories that are used to group FAQs
                    </small>
                </p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newCategoryModalPrimary">
                    <i class="fa-solid fa-plus"></i> &nbsp; Add new category
                </button>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <table id="table2" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
{{--                                    <th>ID</th>--}}
                                    <th>NAME</th>
                                    <th>DESCRIPTION</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
{{--                                    <td>{{ $category->id }}</td>--}}
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->category_description }}</td>
                                    <td>
                                        @if($category->category_status == 1)
                                            <span class="badge badge-success" onclick='$("#search").val($(this).text());$("#search").keyup();$("#search").focus();'>Active</span>
                                        @else
                                            <span class="badge badge-danger" onclick='$("#search").val($(this).text());$("#search").keyup();$("#search").focus();'>Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.faq.categories.manage', $category->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-edit"></i> &nbsp;
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))

            <div class="row p-3">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>

        @endif        
    </div>
</div>
@endsection
