<x-default>
    @include('pages.tracking.thead')
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
                        <form method="POST" id="formMapTrack" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <input type="hidden" name="device_id" value="{{ $deviceData->deviceRelay->ftdevice_id }}">
                            <div id="log" class="tab-pane fade active show">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Datetime Filter</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input value="2023-02-10 16:50:04" type="text" name="txtdtfrom" class="form-control datepicker" placeholder="From" required/>
                                    </div>
                                    <div class="col-md-4">
                                        <input value="2023-02-22 05:52:21" type="text" name="txtdtto" class="form-control datepicker" placeholder="To" required/>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-info ladda-button">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                                <div class="row py-4">
                                    <div class="col-lg-12">
                                        <div id="trackingmap"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.tracking.tfoot')
    
    @vite([
        'resources/js/pages/tracking_map.js'
    ])
</x-default>