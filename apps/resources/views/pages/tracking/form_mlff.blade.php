<x-default>
    <input type="hidden" name="_deviceid" value="{{ $deviceData->deviceRelay->ftdevice_id }}">
    <input type="hidden" name="_lat" value="{{ $deviceData->deviceRelay->fflat }}">
    <input type="hidden" name="_lon" value="{{ $deviceData->deviceRelay->fflon }}">
    @include('pages.tracking.thead')
    @push('isstyles')
    <link rel="stylesheet" href="{{ asset('global/vendor/datatables.net-bs4/dataTables.bootstrap4.min.css')}}">
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
                            <a href="{{ route('tracking_mlff',$deviceData->deviceRelay->ftdevice_id) }}" class="nav-link small text-uppercase active">
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
                        <div class="tab-pane fade active show">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-hover dataTable table-striped w-full" id="tblmlfflist">
                                        <thead>
                                            <tr>
                                                <th>Detection Time</th>
                                                <th>Gate Detection</th>
                                                <th>Toll Section</th>
                                                <th>Gate Payment</th>
                                                <th>Charging</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
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
    <script src="{{ asset('global/vendor/datatables.net/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('global/vendor/datatables.net-bs4/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('global/vendor/bootbox/bootbox.js')}}"></script>
    <script src="{{ asset('global/js/Plugin/datatables.js')}}"></script>
    @endpush
    @vite([
    'resources/js/pages/tracking_mlff.js',
    ])
</x-default>
