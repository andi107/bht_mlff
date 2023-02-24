<x-default>
    @include('pages.tracking.thead')
    @push('isstyles')
    <link href="{{ asset('global/js/dtpicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
    @endpush
    <div class="page-header page-header-bordered">
        <h1 class="page-title">{{ $cfg['title'] }}</h1>
        <div class="page-header-actions">
            <a href="{{ route('tracking_list') }}" type="button" class="btn btn-sm btn-outline btn-primary btn-round waves-effect waves-classic">
                <span class="text hidden-sm-down">Vehicle Tracking</span>
                <i class="icon md-chevron-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="page-content">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"></h3>
                </div>
                <div class="panel-body container-fluid">
                    <ul id="tabs" class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="{{ route('tracking_status',$deviceData->deviceRelay->ftdevice_id) }}" class="nav-link small text-uppercase">
                                Status
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tracking_map',$deviceData->deviceRelay->ftdevice_id) }}" class="nav-link small text-uppercase active">
                                Tracking Map
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#geofence" data-toggle="tab" class="nav-link small text-uppercase">
                                Geofence
                            </a>
                        </li>
                    </ul>
                    <div class="py-4"></div>
                    <div id="tabsContent" class="tab-content">
                        <div class="row">
                            <div class="col-xl-12">
                                
                                    <input type="hidden" name="device_id" value="{{ $deviceData->deviceRelay->ftdevice_id }}">
                                    <div id="log" class="tab-pane fade active show">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Datetime Filter</label>
                                            </div>
                                        </div>
                                        <form method="POST" id="formMapTrack" enctype="multipart/form-data" autocomplete="off">
                                            @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="text" id="txtdtfrom" name="txtdtfrom" class="form-control datepicker" required/>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" id="txtdtto" name="txtdtto" class="form-control datepicker" required/>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-info ladda-button">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                        <div class="row py-4">
                                            <div class="col-lg-12">
                                                <div id="trackingmap"></div>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="col-xl-12">
                                <div class="lt-body text-center p-20">
                                    <button class="btn btn-md btn-primary">Data Log</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('pages.tracking.tfoot')
    
    @push('isscript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="{{ asset('global/js/dtpicker/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = mm + '-' + dd + '-' + yyyy;
        var _dtfrom = today + ' 00:00:00', _dtto = today + ' 23:59:59';
        $("#txtdtfrom").val(today + ' 00:00:00');
        $("#txtdtto").val(today + ' 00:00:00');
        
        
    </script>
    @endpush
    @vite([
        'resources/js/pages/tracking_map.js'
    ])
</x-default>