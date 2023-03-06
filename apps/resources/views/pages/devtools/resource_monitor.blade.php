<x-default>
    @push('isstyles')

    @endpush
    <div class="page-header page-header-bordered">
        <h1 class="page-title">Resource Monitor</h1>
    </div>

    <div class="container-fluid">
        <div class="page-content container-fluid">
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-shadow card-completed-options">
                        <div class="card-block p-30">
                            <div class="row">
                                <div class="col-12">
                                    <label>SERVER 26-54322</label>
                                    <h5>
                                        CPU
                                        <span class="float-right">0%</span>
                                    </h5>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width:0%;" role="progressbar"></div>
                                    </div>
                                    <h5>
                                        RAM
                                        <span class="float-right">0%</span>
                                    </h5>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-warning" style="width: 0%;" role="progressbar"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-shadow card-completed-options">
                        <div class="card-block p-30">
                            <div class="row">
                                <div class="col-12">
                                    <label>Server Not Registered</label>
                                    <h5>
                                        CPU
                                        <span class="float-right">0%</span>
                                    </h5>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: 0%;" role="progressbar"></div>
                                    </div>
                                    <h5>
                                        RAM
                                        <span class="float-right">0%</span>
                                    </h5>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-warning" style="width: 0%;" role="progressbar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-shadow card-completed-options">
                        <div class="card-block p-30">
                            <div class="row">
                                <div class="col-12">
                                    <label>Server Not Registered</label>
                                    <h5>
                                        CPU
                                        <span class="float-right">0%</span>
                                    </h5>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: 0%;" role="progressbar"></div>
                                    </div>
                                    <h5>
                                        RAM
                                        <span class="float-right">0%</span>
                                    </h5>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-warning" style="width: 0%;" role="progressbar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-shadow card-completed-options">
                        <div class="card-block p-30">
                            <div class="row">
                                <div class="col-12">
                                    <label>Server Not Registered</label>
                                    <h5>
                                        CPU
                                        <span class="float-right">0%</span>
                                    </h5>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: 0%;" role="progressbar"></div>
                                    </div>
                                    <h5>
                                        RAM
                                        <span class="float-right">0%</span>
                                    </h5>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-warning" style="width: 0%;" role="progressbar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-md-12">
                <div class="card card-shadow ">
                    <div class="panel-heading">
                        <h3 class="panel-title">SERVICES</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                GSM Services
                                <span class="badge badge-success badge-pill">ON</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                SIGFOX Services
                                <span class="badge badge-default badge-pill">OFF</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                ALPS Services
                                <span class="badge badge-warning badge-pill">Not Registered</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                TELTONIKA Services
                                <span class="badge badge-warning badge-pill">Not Registered</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    @push('isscript')
    <script src="{{ asset('global/vendor/asprogress/jquery-asProgress.js')}}"></script>
    <script src="{{ asset('global/js/Plugin/asprogress.js')}}"></script>
    @endpush
    @vite([
    'resources/js/pages/resource_monitor.js'
    ])
</x-default>
