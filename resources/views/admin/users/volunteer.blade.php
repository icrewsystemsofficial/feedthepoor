@extends('layouts.admin')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script defer>
    $(document).ready(function() {
        $('#table').DataTable();
        $("input[type='search']").attr('id','search');
    } );

    function trigger_delete(id) {
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
                        'User is being deleted..',
                        'success'
                    );

                    document.getElementById(`delete_user_form_${id}`).submit();
                }, 1500);
            }
        });
    }

</script>
<style>
    .badge-warning {
        background-color: #f0ad4e;
        color: #fff;
    }
    .badge-success {
        background-color: #5cb85c;
        color: #fff;
    }
    .badge-danger {
        background-color: #d9534f;
        color: #fff;
    }
    .badge-info {
        background-color: #5bc0de;
        color: #fff;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3>
            Volunteer Applications
            <br>
            {{-- <small class="text-muted text-sm">
                All users present in the application. You can click on a role to filter, or search for a specific user.
            </small> --}}
        </h3>


        <div class="card mt-3">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-12">

                        <table id="table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>E Mail</th>
                                    <th>Phone number</th>
                                    <th>Organization</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        {!! $user->phone_number ? $user->phone_number : '<span class="badge bg-secondary">Not Updated</span>' !!}
                                    </td>
                                    <td>
                                        {{ $user->organization }}
                                    </td>
                                    <td class="d-flex justify-content-around">
                                        <a href="{{ route('admin.users.manage_applications', $user->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-edit"></i> &nbsp;
                                            Manage
                                        </a>
                                        <button onclick="trigger_delete({{$user->id}})" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash-can"></i> &nbsp;
                                            Delete
                                        </button>
                                        <form action="{{ route('admin.users.destroy_volunteer', $user->id) }}" id="delete_user_form_{{$user->id}}" method="POST">@csrf @method('DELETE')</form>
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
