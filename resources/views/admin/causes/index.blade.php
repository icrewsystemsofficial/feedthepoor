@extends('layouts.admin')

@section('js')

<script>
    function showIcon(state){
        return $("<span><i class='fas fa-"+state.text+"'></i>&nbsp;"+state.text+"</span>");
    }
    $(document).ready(function() {        
        let icon = $('#icon');
        icon.select2({
            dropdownParent: $("#defaultModalPrimary .modal-body"),
            dropdownAutoWidth : false,
            placeholder: "Choose a display icon",
            templateResult : showIcon
        });
        icon.on('change',function (){
            $('#iconPreview')[0].className = "fas fa-"+$(this)[0].value;
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
            Causes
        </h3>

        <p class="mt-n2">
            <small>
                The things people can donate for
            </small>
        </p>

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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">
            <i class="fa-solid fa-plus"></i> &nbsp; Add new Cause
        </button>

        <div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adding new cause</h5>
                    </div>
                    <div class="modal-body m-3">

                        <form action="{{ route('admin.causes.store') }}" id="new_causes_form" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name of the cause">
                            </div>

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Icon &nbsp;&nbsp;</label><i class="" id="iconPreview" style="font-size: 30px;"></i><br>
                                <select class="form-control" id="icon" name="icon" style="width: 100%;">
                                    <option></option>
                                    {!! App\Helpers\CausesHelper::getIcons() !!}
                                </select>
                            </div>                     
                            <div class="form-group mb-2">
                                <label for="name" class="form-label">Cost per unit (in INR)</label>
                                <input type="text" class="form-control" name="per_unit_cost" placeholder="Cost per unit for the cause">
                            </div>
                            <div class="form-group mb-2">
                                <label for="yield_context" class="form-label">Yield context</label>                                
                                <textarea class="form-control mb-2" id="yield_context" name="yield_context" required></textarea>
                                <div class="alert alert-info">
                                    <p class="form-text">This conveys details about the number of benfeciaries to the end user.<br> Your input needs to contain the character %YIELD% which signifies the number of people benefiting from the aid</p>
                                    <button type="button" class="btn btn-primary mb-2" onclick="document.getElementById('yield_context').innerText = 'About %YIELD% underprivledged people will be fed with fresh cooked food'">Example</button><br>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <span onclick="document.getElementById('new_causes_form').submit()">
                                    <x-loadingbutton type="submit">Create</x-loadingbutton>
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
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>COST PER UNIT</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($causes as $cause)
                                <tr>
                                    <td>{{ $cause->id }}</td>
                                    <td><i class="fas fa-{{ $cause->icon }}"></i> {{ $cause->name }}</td>
                                    <td>₹ {{ $cause->per_unit_cost }}</td>
                                    <td>
                                        <a href="{{ route('admin.causes.manage', $cause->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-edit"></i> &nbsp;
                                            Manage
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
