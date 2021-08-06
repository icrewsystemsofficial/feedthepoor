@extends('layouts.admin')
@section('css')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="bs-stepper.min.css">
<link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/form-wizard.css">

<style>
    .file {
  visibility: hidden;
  position: absolute;
}
</style>
@endsection
@section('js')
<script src="{{ asset('vuexy_theme/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vuexy_theme/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('vuexy_theme/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vuexy_theme/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ asset('vuexy_theme/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="bs-stepper.min.js"></script>

<script>
     $('input').change(function(){
         $("#submit").prop('disabled', false);
     })
        
        $(document).ready(function () {
            $('.select2').select2();
        });
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        quill.on('text-change', function(delta, oldDelta, source) {
            let textarea = document.querySelector('.answer');
            textarea.value = quill.root.innerHTML;
            console.log(textarea.value);
        });
        function deleteSetting(setting_id) {
            swal.fire({
                title: 'Are you sure?',
                text: 'You wish to delete this setting from database? ',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete!',
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Great!',
                    'Deletion in progress, please wait',
                    'success'
                );
                document.getElementById(setting_id + '_delete_form').submit();
            }
        });
        }
        $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      })
</script>
@endsection

@section('main-content')
<div class="content-header row">
    <div class="content-header col-md-12 col-12 py--1">
        <div class="card">
            <div class="card-body">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0 pb-3">
                            Settings Management
                        </h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                
                                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Settings
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="row card mt-4">
        <div class="p-1">
            <div class="col-md-12 mt-3">
                <div class="alert alert-info">
                    <div class="alert-body">
                        <strong>
                            Information
                        </strong>
                        The core settings are application defaults. You will not be able to delete them. You can add new settings & setting groups
                    </div>
                </div>

                <div class="mt-1 p-3">
                <button type="button" class="btn btn-sm btn-success " data-toggle="modal" data-target="#addSetting" >
                        Add new setting

                    </button>

                    <button id="role_add" type="button" data-toggle="modal" data-target="#createSettingGroup" class="btn btn-sm btn-secondary ml-2">
                        Add new setting group
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="page-account-settings">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0 pt-3">

  <ul class="nav nav-pills flex-column nav-left " id="v-pills-tab"  role="tablist" aria-orientation="vertical">
                    @php
                        $i = 1;
                    @endphp
                    @forelse ($setting_groups as $group)

                    <li class="nav-item">
                        <a class="nav-link @if($i == 1) active @endif" id="pill_{{ Str::snake($group->name) }}"  role="tab" data-toggle="tab"  href="#tab_{{ Str::snake($group->name) }}">
                            <span class="fw-bold">{{ $group->name }}</span>
                        </a>
                    </li>

                    @php
                        $i++;
                    @endphp
                    @empty

                        <div class="alert alert-danger">
                            <div class="alert-body">
                                Looks like there are no setting groups. Please run <code>php artisan db:seed --class SettingsGroupSeeder</code>
                            </div>
                        </div>

                    @endforelse
                </ul>
            </div>
            <!--/ left menu section -->

            <!-- right content section -->
            <div class="col-md-9 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">

                            @php
                                $i = 1;
                            @endphp
                            @forelse ($setting_groups as $group)

                            @php
                                $settings[$group->name] = App\Setting::where('group', $group->id)->get();
                            @endphp

                            <div role="tabpanel" class="tab-pane @if($i == 1) active @endif" id="tab_{{ Str::snake($group->name) }}" aria-labelledby="pill_{{ Str::snake($group->name) }}" aria-expanded="false">
                                <!-- header section -->

                                <div class="">
                                    <h3>
                                        {{ $group->name }}
                                    </h3>
                                    <p>
                                        {{ $group->description }}.
                                        Last edited {{ $group->updated_at->diffForHumans() }}
                                    </p>
                                </div>


                                <!-- form -->

                                    @forelse ($settings[$group->name] as $setting)

                                       <div class="row">
                                           <div class="col-md-12 mb-1">
                                               @if ($setting->core != '1')
                                                <form method="POST" id="{{ $setting->id }}_delete_form" action="{{ route('delete', $setting->id) }}">
                                                    @csrf
                                                    <button type="button" onclick="deleteSetting({{ $setting->id }});" class="btn btn-icon btn-icon rounded-circle btn-flat-danger float-end">
                                                        <i data-feather="trash"></i>
                                                    </button>
                                                </form>
                                               @endif
                                           </div>
                                       </div>

                                       <form class="form form-horizontal" enctype="multipart/form-data" action="{{ route('edit') }}" method="post">
                                        @csrf
                                                @switch($setting->type)

                                                    @case( App\Helpers\SettingsHelper::TEXT)
                                                        <div class="mb-1">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label class="form-label mb-1" for="{{ Str::snake($setting->name) }}">
                                                                        {{ $setting->name }}
                                                                        <br>
                                                                        <code>TEXT</code>
                                                                    </label>
                                                                </div>

                                                                <div class="col-md-9">
                                                                    <input type="text" class="form-control" name="{{ $setting->name }}" placeholder="{{ $setting->description }}" value="{{ $setting->value }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    @break

                                                    @case(App\Helpers\SettingsHelper::TEXTAREA)
                                                        <div class="mb-1">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label class="form-label mb-1" for="{{ Str::snake($setting->name) }}">
                                                                        {{ $setting->name }}
                                                                        <br>
                                                                        <code>
                                                                            TEXTAREA
                                                                        </code>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <textarea class="form-control" name="{{ $setting->name }}" cols="30" rows="5">{{ $setting->value }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr>
                                                    @break

                                                    @case(App\Helpers\SettingsHelper::RICHTEXT)
                                                        <div class="mb-1">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label class="form-label mb-1" for="{{ $setting->name }}">
                                                                        {{ $setting->name }}
                                                                        <br>
                                                                        <code>
                                                                            RICHTEXT
                                                                        </code>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <input class="answer" type="hidden" value="{{ $setting->name }}" name="{{ $setting->name }}">
                                                                    <div id="editor" data-id="{{ $setting->id }}" style="height: 200px;">
                                                                        {!! $setting->value !!}
                                                                    </div>
                                                                    {{-- <textarea id="answer" name="{{ $setting->name }}">{{ $setting->name }}</textarea> --}}
                                                                    {{-- <textarea class="form-control" name="{{ $setting->name }}" cols="30" rows="10">{{ $setting->value }}</textarea> --}}
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <hr>
                                                    @break

                                                    @case(App\Helpers\SettingsHelper::IMAGE)

                                                        <div class="mb-1">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label class="form-label mb-1" for="{{ Str::snake($setting->name) }}">
                                                                        {{ $setting->name }}
                                                                        <br>
                                                                        <code>
                                                                            IMAGE
                                                                        </code>
                                                                    </label>
                                                                </div>


                                                                <div class="col-md-9">

                                                                    <div id="image_preview_{{ Str::snake($setting->name) }}">
                                                                        <img src="{{ asset(''.$setting->value.'') }}" id="image_{{ Str::snake($setting->name) }}" class="rounded me-50" alt="{{ $setting->name }}" height="100" width="auto" />
                                                                        <button type="button" class="btn btn-sm btn-primary mb-75 me-75"
                                                                            onclick="document.getElementById('image_preview_{{ Str::snake($setting->name) }}').style.display = 'none'; document.getElementById('image_upload_{{ Str::snake($setting->name) }}').style.display = 'block';">
                                                                            Change Image
                                                                        </button>
                                                                    </div>

                                                                    <div class="mt-75 ms-1">
                                                                        {{-- <label for="{{ $setting->name }}" class="btn btn-sm btn-primary mb-75 me-75">Change </label> --}}

                                                                        <div style="display: none;" id="image_upload_{{ Str::snake($setting->name) }}">
                                                                            <input type="file" name="{{ $setting->name }}" value="{{ $setting->name }}" id="{{ $setting->name }}" accept="image/*" />
                                                                            <button type="button" class="btn btn-sm btn-outline-secondary mb-75"
                                                                                onclick="
                                                                                    document.getElementById('image_preview_{{ Str::snake($setting->name) }}').style.display = 'block';
                                                                                    document.getElementById('image_upload_{{ Str::snake($setting->name) }}').style.display = 'none';
                                                                                "
                                                                            >Reset</button>
                                                                            <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                                                                        </div>
                                                                    </div>

                                                                <script>
                                                                    function updateImage(file, previewID) {
                                                                        console.log('Updating image...');
                                                                        document.getElementById('image_' + previewID + '').src = file;
                                                                        console.log('Updated the image to ' + file);
                                                                    }
                                                                </script>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr>
                                                    @break

                                                    @case(App\Helpers\SettingsHelper::BOOLEAN)
                                                    <div class="mb-1">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label mb-1" for="{{ Str::snake($setting->name) }}">
                                                                    {{ $setting->name }}
                                                                    <br>
                                                                    <code>
                                                                        BOOLEAN
                                                                    </code>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="d-flex flex-column">
                                                                    <div class="form-check form-switch form-check-primary">
                                                                        <input id="{{ $setting->name }}" onchange="if(this.value == 'on') { this.value = '1'; }" type="checkbox" name="{{ $setting->name }}"  class="form-check-input" @if($setting->value == 1) checked @endif/>
                                                                        <label class="form-check-label" for="{{ $setting->name }}">
                                                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                                        </label>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div>

                                                    <hr>
                                                    @break

                                                @endswitch

                                            @empty

                                                <div class="alert alert-danger">
                                                    <div class="alert-body">
                                                        Looks like there are no settings for this group.
                                                    </div>
                                                </div>

                                            @endforelse

                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-2 me-1">Save</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-2 ml-2">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                                <!--/ form -->
                            </div>
                            @php
                                $i++;
                            @endphp
                            @empty

                                <div class="alert alert-danger">
                                    <div class="alert-body">
                                        Looks like there are no setting groups. Please run <code>php artisan db:seed --class SettingsGroupSeeder</code>
                                    </div>
                                </div>

                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
            <!--/ right content section -->
        </div>
    </section>

    


<div class="modal fade" id="addSetting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSettingGroupTitle">Add a new setting</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="setting-form" action="{{ route('setting.create') }}" method="POST">
                        @csrf
                        <div class="row d-flex  align-items-end">
                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="setting-name">Name</label>
                                    <input type="text" class="form-control"  name="name" id="setting-name" placeholder="Setting name ex: Admin Title" required/>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="setting-key">Key</label>
                                    <input type="text" class="form-control" name="key"  id="setting-key" placeholder="Setting Key: admin_title"  required/>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    @php
                                        $types = (new App\Helpers\SettingsHelper)->types();
                                        //    dd($types);
                                    @endphp
                                    <label class="form-label" for="select2-basic">Type</label>
                                    <select name="type" class="custom-select mt-1" id="select2-basic" required>
                                        <option selected disabled>Choose Type</option>
                                        @foreach ($types as $key => $value)
                                        <option value="{{ $key }}">{{ ucfirst($value) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="setting-group">Setting Group</label>
                                    <select name="group" class="custom-select" id="setting-group" required>
                                        <option selected disabled>Choose Setting Group</option>
                                    @forelse ($setting_groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @empty
                                            <option>No setting group found</option>
                                    @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <label class="form-check-label mb-50" for="coreSettingSwitch">Core Setting ?</label>


                            <input type="hidden" name="core" id="coreSettingHidden" value="0" />
                            <div class="form-check form-switch form-check-success">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="coreSettingSwitch"
                                />
                                <label class="form-check-label" for="coreSettingSwitch" onclick="coreSettingSwitchFunc();">
                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                </label>
                            </div>

                            <script>
                                function coreSettingSwitchFunc() {
                                    var switchValue = document.getElementById('coreSettingSwitch');
                                    var switchHidden = document.getElementById('coreSettingHidden');
                                    if(switchHidden.value == '0') {
                                        switchHidden.value = '1';
                                    } else {
                                        switchHidden.value = '0';
                                    }
                                }
                            </script>
                        </div>
                        <div class="mt-2">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
                        </div>


                </div>
                <div class="modal-footer">
                    <input type="submit" value="Add new setting" onclick="this.disabled=true;this.value='Adding...'; document.getElementById('setting-form').submit();" class="btn btn-success float-end"/>
                    <button class="btn btn-md btn-dark" type="button" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>   
</div>
<div class="modal fade" id="createSettingGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSettingGroupTitle">Create new setting group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                </button>
                            </div>
                <form action="{{ route('group.create') }}" method="POST" >
                @csrf
                <div class="modal-body">
                    <p>
                        You will be creating a new setting group in the system. It is efficient to group settings by
                        their category. Once you create a setting group, <span class="text-danger">YOU WILL NOT BE ABLE TO DELETE IT</span>.
                    </p>

                    <div class="mb-1">
                        <label class="form-label" for="role-name">Setting Group Name</label>
                        <input type="text" id="name" class="form-control " name="name" placeholder="User Settings" required="required"/>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="role-name">Description for Setting Group</label>
                        <textarea class="form-control" name="description" rows="5" required="required"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Create" onclick="this.disabled=true;this.value='Creating setting group, please wait...';this.form.submit();" class="btn btn-primary"/ >
                    <button class="btn btn-md btn-dark" type="button" data-dismiss="modal">Cancel</button>

                </div>
                </form>
            </div>
        </div>
</div>

@endsection
