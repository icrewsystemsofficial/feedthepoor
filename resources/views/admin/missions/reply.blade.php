@extends('layouts.frontend')

@section('js')

<script>
    $(document).ready(function() {
        $('#volunteers').DataTable();
        $('#procurement_list').DataTable();
    } );
</script>

@endsection

@section('content')


<section class="section-header bg-dark mb-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center">
                <h1 class="display-4 text-white">
                    Your mission should you choose to accept it....
                </h1>
            </div>
        </div>
    </div>
</section>

<section class="">
    <div class="container mt-n6 z-2 mb-5">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-10   ">
                <div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">
                                    Reject Mission
                                </h3>
                            </div>
                            <div class="modal-body m-3">                                    
                                <form id="accept_mission_form" method="POST" action="{{ route('admin.missions.reply.accept') }}">
                                    @csrf
                                    <input type="hidden" name="mission_id" value="{{ $mission->id }}">
                                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                                    <input type="hidden" name="reply" value="1">
                                </form>

                                <form id="reject_mission_form" method="POST" action="{{ route('admin.missions.reply.reject') }}">
                                    @csrf
                                    <input type="hidden" name="mission_id" value="{{ $mission->id }}">
                                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                                    <input type="hidden" name="reply" value="2">
                                    <textarea class="form-control" name="reason" id="reject_reason" rows="3" placeholder="Please explain why you reject this mission"></textarea>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <span onclick="document.getElementById('reject_mission_form').submit()">
                                    <x-loadingbutton type="submit">Submit</x-loadingbutton>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-lg border-gray-300 p-4 p-lg-5">
                    <div class="row">

                        <div class="col-md-12 mx-auto text-center border-top border-gray-300 my-2 ">

                            <div class="mb-3 mt-4">
                                <div class="card alpha-container text-white border-0 overflow-hidden mt-2">

                                    <span class="mask bg-dark alpha-9"></span>

                                    <div class="card-body px-5 py-3">
                                        <div style="min-height: 100px;">

                                            <div class="mt-5 h5">
                                                <span>{{ $mission->description }}</span>
                                            </div>                                                                                        

                                        </div>
                                    </div>
                                </div>                                                            
                            </div>

                            <div class="mb-3 mt-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary badge-success" onclick="document.getElementById('accept_mission_form').submit()">
                                            Accept Mission
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary badge-danger" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">
                                            Reject Mission
                                        </button>
                                    </div>                                    
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="min-height: 100px;">
                                            <div class="mt-5 h5">
                                                <b>Location : </b><span>{{ $location }}</span>
                                            </div>                                                                                        
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="min-height: 100px;">
                                            <div class="mt-5 h5">
                                                <b>Execution Date : </b><span>{{ $mission->execution_date }}</span>
                                            </div>                                                                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="min-height: 100px;">
                                            <div class="mt-5 h5">
                                                <b>Field Manager : </b><span>{{ $field_manager->name }}</span>
                                            </div>                                                                                        
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="min-height: 100px;">
                                            <div class="mt-5 h5">
                                                <b>Volunteers</b>
                                            </div>               
                                            <table id="volunteers" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($volunteers as $volunteer)
                                                        @if ($volunteer[0] != $field_manager->id)
                                                            <tr>
                                                                <td>{{ $volunteer[1] }}</td>
                                                                <td>{{ $volunteer[2] }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="min-height: 100px;">
                                            <div class="mt-5 h5">
                                                <b>Procurement List</b>
                                            </div>               
                                            <table id="procurement_list" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Cause/Campaign</th>
                                                        <th>Quantity</th>
                                                        <th>Location</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($procurement_items as $item)
                                                        <tr>
                                                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                                            <td style="max-width: 180px;white-space:normal;">
                                                                <strong>
                                                                    {{ $item->procurement_item }}
                                                                </strong>
                                                            </td>
                                                            <td>{{ $item->procurement_quantity }}</td>
                                                            <td>{!! App\Helpers\MissionHelper::getLocationName($item->location_id) !!}</td>
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
                </div>
            </div>
        </div>
    </div>
</section>

@endsection