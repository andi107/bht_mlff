<x-default>
    @push('isstyles')
        {{-- <link rel="stylesheet" href="{{ asset('global/vendor/chartist/chartist.css')}}">
        <link rel="stylesheet" href="{{ asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')}}"> --}}
        <link rel="stylesheet" href="{{ asset('global/vendor/mapbox-js/mapbox.css')}}">
        <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}"/>
    @endpush
    <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <div class="col-xl-3 col-md-6">
                <!-- Widget Linearea One-->
                <div class="card card-shadow" id="widgetLineareaOne">
                    <div class="card-block p-20 pt-10">
                        <div class="clearfix">
                            <div class="grey-800 float-left py-10 font-size-30">
                                Outdoor Device
                            </div>
                        </div>
                        <i class="float-right icon md-collection-text green-700 font-size-50 vertical-align-bottom mr-5"></i>
                        <div class="mb-20 grey-500 green-500 font-size-30">
                            1,253
                        </div>
                        
                    </div>
                </div>
                <!-- End Widget Linearea One -->
            </div>
            <div class="col-xl-3 col-md-6">
                <!-- Widget Linearea One-->
                <div class="card card-shadow" id="widgetLineareaOne">
                    <div class="card-block p-20 pt-10">
                        <div class="clearfix">
                            <div class="grey-800 float-left py-10 font-size-30">
                                Indoor Device
                            </div>
                        </div>
                        <i class="float-right icon md-collection-text grey-700 font-size-50 vertical-align-bottom mr-5"></i>
                        <div class="mb-20 grey-500 grey-500 font-size-30">
                            1,253
                        </div>
                        
                    </div>
                </div>
                <!-- End Widget Linearea One -->
            </div>
            <div class="col-xl-3 col-md-6">
                <!-- Widget Linearea One-->
                <div class="card card-shadow" id="widgetLineareaOne">
                    <div class="card-block p-20 pt-10">
                        <div class="clearfix">
                            <div class="grey-800 float-left py-10 font-size-30">
                                Vehicle Device
                            </div>
                        </div>
                        <i class="float-right icon md-collection-text blue-700 font-size-50 vertical-align-bottom mr-5"></i>
                        <div class="mb-20 grey-500 blue-500 font-size-30">
                            1,253
                        </div>
                        
                    </div>
                </div>
                <!-- End Widget Linearea One -->
            </div>
            <div class="col-xl-3 col-md-6">
                <!-- Widget Linearea One-->
                <div class="card card-shadow" id="widgetLineareaOne">
                    <div class="card-block p-20 pt-10">
                        <div class="clearfix">
                            <div class="grey-800 float-left py-10 font-size-30">
                                Sensor Device
                            </div>
                        </div>
                        <i class="float-right icon md-collection-text yellow-700 font-size-50 vertical-align-bottom mr-5"></i>
                        <div class="mb-20 grey-500 yellow-500 font-size-30">
                            1,253
                        </div>
                        
                    </div>
                </div>
                <!-- End Widget Linearea One -->
            </div>

            <div class="col-xxl-12 col-lg-12">
                <!-- Widget Jvmap -->
                <div class="card card-shadow">
                    <div class="card-block p-0">
                        <div id="dashboardmap"></div>
                    </div>
                </div>
                <!-- End Widget Jvmap -->
            </div>
        </div>
    </div>
    @push('isscript')
        <script src="{{ asset('global/vendor/mapbox-js/mapbox.js')}}"></script>
        {{-- <script src="{{ asset('global/vendor/mapbox-js/leaflet.markercluster.js')}}"></script> --}}
        <script src="{{ asset('leaflet/leaflet.js')}}"></script>
    @endpush
    @vite([
        'resources/js/ts/dashboardmaps.js',
    ])
</x-default>
