@extends('layouts.admin')

@section('js')

<script>
    $(document).ready(function() {
        CKEDITOR.replace('entry_answer');        
        $('#category_id').select2({
            dropdownParent: $("#newQuestionModalPrimary .modal-body"),
            dropdownAutoWidth : false,
            placeholder: 'Select a category',
        });
        $('#table').DataTable();
    });
    $(document).on('select2:open', (e) => {
        const selectId = e.target.id    
        $(".select2-search__field[aria-controls='select2-" + selectId + "-results']").each(function (
            key,
            value,
        ){
            value.focus();
        })
    });
</script>

@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3>
            FAQs <span class="text-muted">></span> Questions
        </h3>
        <p class="mt-n2">
            <small>
                Frequently Asked Questions regarding the organization
            </small>
        </p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newQuestionModalPrimary">
            <i class="fa-solid fa-plus"></i> &nbsp; Add new question
        </button>

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

        <div class="modal fade" id="newQuestionModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adding new question</h5>
                    </div>
                    <div class="modal-body m-3">

                        <form action="{{ route('admin.faq.questions.store') }}" id="new_question_form" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="entry_question">Question</label>
                                <input type="text" class="form-control" id="entry_question" name="entry_question" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="entry_answer">Answer</label>
                                <textarea name="entry_answer" id="entry_answer" class="form-control" required></textarea>
                            </div>
                            <div class="form-group mb-2">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option></option>
                                    {!! App\Helpers\FaqHelper::getAllCategories()  !!} 
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="author_name">Author Name</label>
                                <input type="text" class="form-control" id="author_name" name="author_name" required value="{{ auth()->user()->name }}" disabled>
                            </div>                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <span onclick="document.getElementById('new_question_form').submit();">
                                    <x-loadingbutton>Create</x-loadingbutton>
                                </span>
                            </div>

                    </form>
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

        <div class="card mt-3">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <table id="table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
{{--                                    <th>ID</th>--}}
                                    <th>QUESTION</th>
                                    <th>CATEGORY</th>
                                    <th>AUTHOR</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($entries as $entry)
                                <tr>
{{--                                    <td>{{ $entry->id }}</td>--}}
                                    <td>{{ $entry->entry_question }}</td>
                                    <td>{{ $entry->category }}</td>
                                    <td>{{ $entry->author_name }}</td>
                                    <td>
                                        <a href="{{ route('admin.faq.questions.manage', $entry->id) }}">
                                        <button class="btn btn-primary btn-sm" >
                {{-- {{ (auth()->user()->name != $entry->author_name) ? 'disabled':'' }} -> This will only allow the author of the question to interact with the button --}}
                                            <i class="fa-solid fa-edit"></i> &nbsp;
                                            Edit
                                        </button>
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
    </div>
</div>
@endsection
