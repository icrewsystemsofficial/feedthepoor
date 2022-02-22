@extends('layouts.admin')

@section('css')
<script src="{{ asset('js/alpine.js') }}" defer></script>
<script>
    function createSettings() {
        return {
            showalert: false,
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

                // this.showValueInputs.showText = true;
                // this.showValueInputs.showTextArea = true;
                // this.showValueInputs.showBoolean = true;

                // alert(value);

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
                        
                        <form action="{{ route('admin.settings.create') }}" autocomplete="off">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name">
                            </div>

                            <div class="form-group mb-2">
                                <label for="description" class="form-label">Description</label>                                
                                <textarea name="description" class="form-control"></textarea>
                            </div>


                            <div class="form-group mb-2">
                                <label for="setting_group" class="form-label">Group<span class="text-danger">*</span> <span class="badge bg-success">{{ count($setting_groups) }}</span></label>
                                <select name="setting_group" class="form-control">

                                    @foreach ($setting_groups as $setting)
                                        <option value="{{ $setting->id }}">{{ $setting->name }}</option>
                                    @endforeach                                    
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <label for="setting_type" class="form-label">Type</label>
                                <select id="setting_type" name="setting_type" class="form-control" @change="updateSettingType">
                                    @foreach ($setting_types as $type => $name)
                                        <option value="{{ $type }}">{{ $name }}</option>
                                    @endforeach                                    
                                </select>
                            </div>
                            

                            <div class="">
                                <div class="form-group mb-2" x-show="showValueInputs.showText">                                
                                    <label for="value" class="form-label">Value<span class="text-danger">*</span></label>                                
                                    <input type="text" class="form-control" name="value" placeholder="Enter value for this setting">                                
                                </div>
    
                                <div class="form-group mb-2" x-show="showValueInputs.showTextArea">
                                    <label for="value" class="form-label">Value<span class="text-danger">*</span></label>                                
                                    <textarea name="value" class="form-control" placeholder="Enter value for this setting"></textarea>                               
                                </div>
    
                                <div class="form-check form-switch mb-2 mt-3" x-show="showValueInputs.showBoolean">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">
                                        <strong>Enabled?</strong>                                        
                                    </label>
                                </div>
                            </div>
                            
                            <div class="form-check form-switch mb-2 mt-3">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">
                                    <strong>Core Setting?</strong>
                                    <span class="text-muted">
                                        this will override default config values with same keys
                                    </span>
                                </label>
                            </div>


                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Input</h5>
            </div>
            <div class="card-body">
                <input type="text" class="form-control" placeholder="Input">
            </div>

            <div class="card-body">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
                    <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDisabled" disabled="">
                    <label class="form-check-label" for="flexSwitchCheckDisabled">Disabled switch checkbox input</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckCheckedDisabled" checked="" disabled="">
                    <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Disabled checked switch checkbox input</label>
                </div>
            </div>

            <div class="card-body">

                


                <div class="tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="btn btn-outline-dark btn-lg btn-square active" href="#tab-1" data-bs-toggle="tab" role="tab">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-dark btn-lg btn-square" href="#tab-2" data-bs-toggle="tab" role="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-dark btn-lg btn-square" href="#tab-3" data-bs-toggle="tab" role="tab">Messages</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3">
                        <div class="tab-pane active" id="tab-1" role="tabpanel">
                            <h4 class="tab-title">Default tabs</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor tellus eget condimentum
                                rhoncus. Aenean massa. Cum sociis natoque penatibus et magnis neque dis parturient montes, nascetur ridiculus mus.
                            </p>
                            <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede
                                justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae,
                                justo.</p>
                        </div>
                        <div class="tab-pane" id="tab-2" role="tabpanel">
                            <h4 class="tab-title">Another one</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor tellus eget condimentum
                                rhoncus. Aenean massa. Cum sociis natoque penatibus et magnis neque dis parturient montes, nascetur ridiculus mus.
                            </p>
                            <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede
                                justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae,
                                justo.</p>
                        </div>
                        <div class="tab-pane" id="tab-3" role="tabpanel">
                            <h4 class="tab-title">One more</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor tellus eget condimentum
                                rhoncus. Aenean massa. Cum sociis natoque penatibus et magnis neque dis parturient montes, nascetur ridiculus mus.
                            </p>
                            <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede
                                justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae,
                                justo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>
@endsection