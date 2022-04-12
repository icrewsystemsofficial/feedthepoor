@extends('layouts.admin')

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
                        'Location is being deleted..',
                        'success'
                    );

                    document.getElementById('delete_cause_form').submit();
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
            Causes <span class="text-muted">></span> Manage
        </h3>
        <p class="mt-n2">
            <small>
                Edit/delete existing causes
            </small>
        </p>
    </div>
</div>
<div class="row mb-3">
    <div class="col-6">
        <div class="flex d-flex">
            <div>
                <a href="{{ route('admin.causes.index') }}" class="btn btn-primary">
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
                <form action="{{ route('admin.causes.destroy', $cause->id) }}" id="delete_cause_form" method="POST">@csrf @method('DELETE')</form>
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
            <form action="{{ route('admin.causes.update', $cause->id) }}" id="update_form" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="form-group mb-2">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $cause->name }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Icon &nbsp;&nbsp;</label><i class="" id="iconPreview" style="font-size: 30px;"></i><br>
                    <select class="form-control" id="icon" name="icon" style="width: 100%;">
                        {!! App\Helpers\CausesHelper::getIcons($cause->icon) !!}
                    </select>
                </div>       
                <div class="form-group mb-2">
                    <label for="per_unit_cost">Cost per unit (in INR)</label>
                    <input type="number" class="form-control" id="per_unit_cost" name="per_unit_cost" value="{{ $cause->per_unit_cost }}" required>
                </div>
                <div class="form-group mb-2">
                    <label for="yield_context">Yield context</label>
                    <textarea class="form-control" id="yield_context" name="yield_context" required>{{ $cause->yield_context }}</textarea>
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
    function showIcon(state){
        return $("<span><i class='fas fa-"+state.text+"'></i>&nbsp;"+state.text+"</span>");
    }
    $(document).ready(function() {
        let icon = $('#icon');
        icon.select2({
            templateResult : showIcon
        });
        icon.on('change',function (){
            $('#iconPreview')[0].className = "fas fa-"+$(this)[0].value;
        });
        $('#iconPreview')[0].className = "fas fa-"+icon[0].value;
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
