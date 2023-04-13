<x-default>
    <input type="hidden" name="_deviceid" value="{{ $deviceData->deviceRelay->ftdevice_id }}">
    <input type="hidden" name="_lat" value="{{ $deviceData->deviceRelay->fflat }}">
    <input type="hidden" name="_lon" value="{{ $deviceData->deviceRelay->fflon }}">
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
                            <a href="{{ route('tracking_status',$deviceData->deviceRelay->ftdevice_id) }}" class="nav-link small text-uppercase active">
                                Status
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tracking_map',$deviceData->deviceRelay->ftdevice_id) }}" class="nav-link small text-uppercase">
                                Tracking Map
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tracking_geo',$deviceData->deviceRelay->ftdevice_id) }}" class="nav-link small text-uppercase">
                                Geofence
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tracking_mlff',$deviceData->deviceRelay->ftdevice_id) }}" class="nav-link small text-uppercase">
                                Toll Declaration
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tracking_live',$deviceData->deviceRelay->ftdevice_id) }}" class="nav-link small text-uppercase">
                                🔴Live Tracking
                            </a>
                        </li>
                    </ul>
                    @include('pages.tracking.detail')
                    <div id="tabsContent" class="tab-content">
                        <div id="status" class="tab-pane fade active show">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h3>
                                                        Last Activity
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <span class="badge badge-default text-uppercase text-left">Date Time</span>
                                                </div>
                                                <div class="col">
                                                    <span class="badge badge-default text-uppercase text-left">GNSS Point</span>
                                                </div>
                                                <div class="col">
                                                    <span class="badge badge-default text-uppercase text-left">Location</span>
                                                </div>
                                            </div>
                                            <div class="border-top my-3"></div>
                                            <div class="row">
                                                <div class="col">
                                                    <span id="datetime" class="badge badge-default text-wrap text-left">{{$deviceData->deviceRelay->created_at}}</span>
                                                </div>
                                                <div class="col">
                                                    <span id="entrypoint" class="badge badge-default text-wrap text-left">{{ $deviceData->deviceRelay->fflat . ', '. $deviceData->deviceRelay->fflon}}</span>
                                                </div>
                                                <div class="col">
                                                    <span id="exitpoint" class="badge badge-default text-wrap text-left">n/a</span>
                                                </div>
                                            </div>
                                            
                                            <div class="row py-4">
                                                <div class="col">
                                                    <div id="statusmap"></div>
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
        </div>
    </div>
    @include('pages.tracking.tfoot')
    @vite([
    'resources/js/pages/tracking_status.js',
    ])
</x-default>
