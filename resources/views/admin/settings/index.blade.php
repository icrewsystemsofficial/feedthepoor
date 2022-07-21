@extends('layouts.admin')

@section('css')
<script>
    /*
        Alpine Function to handle the UI functions of the "create settings" modal.
        - Leonard, February 2022.
    */
    function createSettings() {
        return {
            showalert: false,
            settingName: '',
            showSettingNameSuggestion: false,
            settingGroupName: '',
            settingValue: '',
            coreSettingValue: 0,


            showValueInputs: {
                showText: true,
                showTextArea: false,
                showBoolean: false,
            },

            updateSettingType() {

                value = document.getElementById('setting_type').value;

                this.showValueInputs.showText = false;
                this.showValueInputs.showTextArea = false;
                this.showValueInputs.showBoolean = false;

                console.log(value);

                switch(value) {
                    case "1":
                        this.showValueInputs.showText = true;
                    break;

                    case "2":
                        this.showValueInputs.showTextArea = true;
                    break;

                    case "5":
                        this.showValueInputs.showBoolean = true;
                    break;

                    default:
                        alert('not working');

                }
            },

            submitForm() {
                setTimeout(() => {
                    document.getElementById('new_settings_form').submit();
                }, 2000);
            },

            updateCoreSettingValue() {
                var core_setting = document.getElementById('core_setting').value;
                if(core_setting == 'on') {
                    this.coreSettingValue = 1;
                } else {
                    this.coreSettingValue = 0;
                }
            }


        }
    }


    /*
        This toggles visibility of the alert box whenever a setting textbox is clicked on.
        - Leonard, Feb 2022.
    */

    function showUnsavedAlert() {
        return {
            showAlert: false,

            clicked() {
                if(this.showAlert == false) {
                    this.showAlert = true;
                }
            }


        }
    }

    function createSettingGroup() {
        return {
            he: '',

            submitForm() {
                setTimeout(() => {
                    document.getElementById('new_settings_group_form').submit();
                }, 2000);
            },
        }
    }

    const deleteSetting = (name, url) => {
        Swal.fire({
            title: `Delete ${name}`,
            text: 'Are you sure?',
            icon: 'question',
            iconHtml: '?',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            showCancelButton: true,
            showCloseButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        });
    }
</script>
@endsection
@section('content')


<div class="row">
    <div class="col-12">
        <h3>
            <strong>Settings</strong>
        </h3>

        {{-- START CREATE SETTING MODAL --}}

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">
            <i class="fa-solid fa-plus"></i> &nbsp; Add new setting
        </button>

        <div x-data="createSettings()" class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adding new setting</h5>
                    </div>
                    <div class="modal-body m-3">

                        <form action="{{ route('admin.settings.create') }}" id="new_settings_form" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required="required">
                            </div>

                            <div class="form-group mb-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>


                            <div class="form-group mb-2">
                                <label for="setting_group" class="form-label">Group<span class="text-danger">*</span> <span class="badge bg-success">{{ count($setting_groups) }}</span></label>
                                <select name="setting_group" class="form-control" required="required">
                                    @foreach ($setting_groups as $setting)
                                        <option value="{{ $setting->id }}">{{ $setting->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <label for="setting_type" class="form-label">Type</label>
                                <select id="setting_type" name="setting_type" class="form-control" @change="updateSettingType" required="required">
                                    @foreach ($setting_types as $type => $name)
                                        <option value="{{ $type }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="">
                                <div class="form-group mb-2" x-show="showValueInputs.showText">
                                    <label class="form-label">Value<span class="text-danger">*</span></label>

                                    <input
                                        x-model="settingValue"
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter value for this setting"
                                        required="required"
                                    />
                                </div>

                                <div class="form-group mb-2" x-show="showValueInputs.showTextArea">
                                    <label class="form-label">Value<span class="text-danger">*</span></label>
                                    <textarea
                                        x-model="settingValue"
                                        class="form-control"
                                        placeholder="Enter value for this setting"
                                        required="required"
                                    ></textarea>
                                </div>

                                <div class="form-check form-switch mb-2 mt-3" x-show="showValueInputs.showBoolean">
                                    <input
                                        x-model="settingValue"
                                        class="form-check-input"
                                        type="checkbox"
                                        id="value" />


                                    <label class="form-check-label" for="value">
                                        <strong>Enabled?</strong>
                                    </label>
                                </div>


                                {{-- Masking the inputs into this element --}}
                                <input type="hidden" x-model="settingValue" name="value"></span>
                            </div>

                            <div class="form-check form-switch mb-2 mt-3">
                                <input class="form-check-input" type="checkbox" id="core_setting" @click="updateCoreSettingValue">
                                <label class="form-check-label">
                                    <strong>Core Setting?</strong>
                                    <span class="text-muted">
                                        this will override default config values with same keys
                                    </span>
                                </label>

                                <input type="hidden" name="core_setting" x-bind:value="coreSettingValue" />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <span @click="submitForm">
                            <x-loadingbutton type="submit">Create</x-loadingbutton>
                        </span>
                    </div>

                    </form>
                </div>
            </div>
        </div>

        {{-- END OF CREATE SETTING MODAL --}}

        {{-- START OF CREATE NEW SETTING MODAL --}}

        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createNewSettingGroup">
            <i class="fa-solid fa-gear"></i> &nbsp; Setting Groups
        </button>

        <div x-data="createSettingGroup()" class="modal fade" id="createNewSettingGroup" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adding a new setting group</h5>
                    </div>

                    <form action="{{ route('admin.settings.group.create') }}" id="new_settings_group_form" method="POST" autocomplete="off">
                    <div class="modal-body m-3">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required="required">
                        </div>

                        <div class="form-group mb-2">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <span @click="submitForm">
                            <x-loadingbutton type="submit">Create</x-loadingbutton>
                        </span>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- END OF CREATE NEW SETTING MODAL --}}



        <div class="card mt-3" x-data="showUnsavedAlert()">
            <form action="{{ route('admin.settings.update') }}" method="POST" id="setting_update_form">
                @csrf
                <div class="card-body">
                    <div class="alert alert-danger" role="alert" x-show="showAlert"
                        x-transition:enter.duration.500ms
                        x-transition:leave.duration.400ms
                    >
                        <strong>Attention</strong>
                        Unsaved settings, click "Save" to save the settings
                    </div>
                </div>

                @forelse ($setting_groups as $group)
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ Str::upper($group->name) }}</h5>

                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#setting_group_edit_{{ Str::snake($group->name) }}">
                            <i class="fa-solid fa-gear"></i> &nbsp; Edit
                        </button>
                    </div>




                    <div class="card-body">
                        @php
                            $settings = App\Models\Setting::where('group_id', $group->id)->get();
                        @endphp

                        @forelse ($settings as $setting)
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label class="h4" for="{{ $setting->key }}">
                                        <strong>{{ $setting->name }}</strong>
                                    </label>
                                    <p class="text-muted">
                                        <small>
                                            {{ $setting->description }}
                                        </small>
                                    </p>

                                    @if($setting->core == true)
                                        <div x-data="{
                                            code: false,
                                        }">

                                            <button type="button" class="btn btn-sm btn-outline-primary" @click="code = !code;">
                                                <i class="fa-solid fa-eye"></i> &nbsp; Core
                                            </button>
                                            <span class="" x-show="code"
                                                x-transition:enter.duration.500ms
                                                x-transition:leave.duration.400ms
                                            >
                                            <br><br>
                                                <small>
                                                  You can call this setting using  <strong>
                                                        @config('setting.{{ Str::snake($setting->key) }}')
                                                    </strong>
                                                </small>
                                            </span>
                                            <br><br>
                                        </div>
                                    @else
                                            <div class="form-group">
                                                <span @click="deleteSetting('{{$setting->name}}','{{route('admin.settings.delete', $setting->id)}}')">
                                                    <a type="button" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i> &nbsp; Delete</a>
                                                </span>
                                            </div>
                                    @endif
                                </div>
                                <div class="col-md-9">

                                    @switch($setting->type)
                                        @case(1)
                                            <input type="text" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}" placeholder="{{ $setting->name }}" @change="clicked">
                                        @break

                                        @case(2)
                                        <textarea
                                             name="{{ $setting->key }}"
                                            class="form-control"
                                            placeholder="Enter value for {{ $setting->name }}"
                                            required="required"
                                            @change="clicked"
                                        >{{ $setting->value }}</textarea>
                                        @break

                                        @case(5)

                                        <div class="form-check form-switch mb-2 mt-3" x-data="{
                                            VALUE_{{ $setting->key }}: '{{ $setting->value }}',
                                        }">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                @change="clicked"
                                                x-model="VALUE_{{ $setting->key }}"
                                                @if($setting->value == true) checked @endif
                                            />


                                            <label class="form-check-label" for="value">
                                                <strong>Enabled?</strong>
                                            </label>

                                            <input type="hidden" name="{{ $setting->key }}" x-model="VALUE_{{ $setting->key }}" >
                                        </div>
                                        @break

                                        @default

                                        <input type="text" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}" placeholder="{{ $setting->name }}" @click="clicked">

                                    @endswitch
                                </div>
                            </div>
                        @empty
                            <p>
                                No setting found in {{ $group->name }}
                            </p>
                        @endforelse
                    </div>
                    <hr>

                    @empty

                    <div class="card-body">
                        <div class="alert alert-danger">
                            No settings found. The basic application settings are
                            provided as seeders, please run <br><br><strong>php artisan db:seed --force</strong>
                        </div>
                    </div>

                @endforelse


                @if(count($setting_groups) > 0)

                <div class="card-body">
                    <div class="form-group">
                        <span @click="document.getElementById('setting_update_form').submit();">
                            <x-loadingbutton>Save</x-loadingbutton>
                        </span>
                    </div>
                </div>

                @endif
            </form>
                    <div class="modal fade" id="setting_group_edit_{{ Str::snake($group->name) }}" tabindex="-1" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editing Setting Group: <strong>{{ $group->name }}</strong></h5>
                                </div>
                                <div class="modal-body m-3">
                                    <form id="setting_group_edit_{{ $group->id }}" action="{{ route('admin.settings.group.update', $group->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-2">
                                            <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" required="required" value="{{ $group->name }}">
                                        </div>

                                        <div class="form-group mb-2">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea name="description" class="form-control">{{ $group->description }}</textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                    <button class="btn btn-primary" type="button" onclick="document.getElementById('setting_group_edit_{{ $group->id }}').submit();">
                                        Edit
                                    </button>

                                    {{-- <span @click="submit">
                                        {{-- <x-loadingbutton type="submit">Edit</x-loadingbutton>
                                    </span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
        </div>


    </div>
</div>
@endsection
