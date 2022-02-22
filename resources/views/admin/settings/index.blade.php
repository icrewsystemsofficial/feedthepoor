@extends('layouts.admin')

@section('css')
<script src="{{ asset('js/alpine.js') }}" defer></script>
<script>
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
</script>
@endsection
@section('content')


<div class="row">
    <div class="col-12">
        <h3>
            Settings
        </h3>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">
            Add new setting
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

        <div class="card mt-3" x-data="showUnsavedAlert()">
            <form action="">
                <div class="alert alert-danger" role="alert" x-show="showAlert">
                    <strong>Attention</strong>
                    Unsaved settings
                </div>
    
                @foreach ($setting_groups as $group)
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ Str::upper($group->name) }}</h5>
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
                                    <p>
                                        {{ $setting->description }}
                                    </p>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}" placeholder="{{ $setting->name }}" @click="clicked">
                                </div>
                            </div>
                        
                        @empty
                            <p>
                                No setting found in {{ $group->name }}
                            </p>
                        @endforelse
    
    
                    </div>  
                    
                    <hr>
                @endforeach
    
                
                <div class="form-control">
                    <x-loadingbutton type="submit">Save</x-loadingbutton>
                </div>
            </form>                        
        </div>

        
    </div>
</div>
@endsection