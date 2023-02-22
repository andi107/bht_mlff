<x-default>

    @push('isstyles')
    <link rel="stylesheet" href="{{ asset('global/vendor/datatables.net-bs4/dataTables.bootstrap4.min.css')}}">
    {{-- <link rel="stylesheet" href="{{ asset('global/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{ asset('global/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{ asset('global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css')}}"> --}}
    @endpush

    <div class="page-header page-header-bordered">
        <h1 class="page-title">Device Listed</h1>
        <div class="page-header-actions">
            <a href="{{ route('device_create_index') }}" class="btn btn-sm btn-outline btn-primary btn-round waves-effect waves-classic">
                <span class="text hidden-sm-down">Add New</span>
                <i class="icon md-chevron-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title"></h3>
            </header>
            <div class="panel-body">
                <table class="table table-hover dataTable table-striped w-full" id="tbldevices">
                    <thead>
                        <tr>
                            <th>Device ID</th>
                            <th>Device Name</th>
                            <th>Tracking Category</th>
                            <th>Asset ID</th>
                            <th>Asset Name</th>
                            <th>Asset Type</th>
                            <th>Customer Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Device ID</th>
                            <th>Device Name</th>
                            <th>Tracking Category</th>
                            <th>Asset ID</th>
                            <th>Asset Name</th>
                            <th>Asset Type</th>
                            <th>Customer Name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        {{-- <tr>
                  <td>Damon</td>
                  <td>5516 Adolfo Green</td>
                  <td>Littelhaven</td>
                  <td>85</td>
                  <td>2014/06/13</td>
                  <td>$553,536</td>
                  <td>$553,536</td>
                  <td>$553,536</td>
                </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('isscript')
    <script src="{{ asset('global/vendor/datatables.net/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('global/vendor/datatables.net-bs4/dataTables.bootstrap4.min.js')}}"></script>
    {{-- <script src="{{ asset('global/vendor/datatables.net-fixedheader/dataTables.fixedHeader.js')}}"></script>
    <script src="{{ asset('global/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.js')}}"></script> --}}
    {{-- <script src="{{ asset('global/vendor/datatables.net-rowgroup/dataTables.rowGroup.js')}}"></script> --}}
    {{-- <script src="{{ asset('global/vendor/datatables.net-scroller/dataTables.scroller.js')}}"></script> --}}
    {{-- <script src="{{ asset('global/vendor/datatables.net-responsive/dataTables.responsive.js')}}"></script> --}}
    {{-- <script src="{{ asset('global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.js')}}"></script> --}}
    {{-- <script src="{{ asset('global/vendor/datatables.net-buttons/dataTables.buttons.js')}}"></script>
    <script src="{{ asset('global/vendor/datatables.net-buttons/buttons.html5.js')}}"></script>
    <script src="{{ asset('global/vendor/datatables.net-buttons/buttons.flash.js')}}"></script>
    <script src="{{ asset('global/vendor/datatables.net-buttons/buttons.print.js')}}"></script>
    <script src="{{ asset('global/vendor/datatables.net-buttons/buttons.colVis.js')}}"></script>
    <script src="{{ asset('global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.js')}}"></script> --}}
    {{-- <script src="{{ asset('global/vendor/asrange/jquery-asRange.min.js')}}"></script> --}}
    <script src="{{ asset('global/vendor/bootbox/bootbox.js')}}"></script>
    <script src="{{ asset('global/js/Plugin/datatables.js')}}"></script>
    <script>
        var tbldevices = $('#tbldevices').DataTable({
            "lengthChange": false
            , order: [
                [1, 'desc']
            ],
            "columnDefs": [
              {
                // <button class="btn btn-info waves-effect waves-classic" data-content="And here's some amazing content. It's very engaging. Right?" data-trigger="hover" data-toggle="popover" data-original-title="Hover to trigger" tabindex="0" title="" type="button">Hover to trigger</button>
                targets: -1, 
                "defaultContent": '<button class="btnedit btn btn-pure btn-primary icon md-edit waves-effect waves-classic"></button><button class="btndel btn btn-pure btn-danger icon icon md-delete waves-effect waves-classic"></button>'
              },
            ], fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                // if (aData[0] == "Done") {
                //     $('td', nRow).css('background-color', '#d1e7dd');
                // }
            },

        });
        $('#tbldevices tbody').on( 'click', 'button.btnedit', function () {
            var data = tbldevices.row($(this).parents('tr')).data(), sURL;
            console.log(data)
            sURL = `{{ route('device_detail', ':id') }}`;
            window.location.href = sURL.replace(":id", data[0]);
        });
        $('#tbldevices tbody').on( 'click', 'button.btndel', function () {
            var data = tbldevices.row($(this).parents('tr')).data(), sURL;
            console.log(data)
            sURL = `{{ route('device_detail', ':id') }}`;
            // window.location.href = sURL.replace(":id", data[0]);
        });

        const trck_category = [
          'n/a',
          'Outdoor Tracking',
          'Vehicle Tracking',
          'Indoor Tracking'
        ];
        
        $.get("{{ route('device_list_js') }}", function(res) {
            $.each(res.data, function(k, v) {
                tbldevices.row.add([
                    v.ftdevice_id, v.ftdevice_name ,trck_category[v.fncategory],v.ftasset_id,v.ftasset_name,v.ftasset_type,v.ftcustomer_name
                ]).draw(true);
            });
        });
    </script>
    @endpush
</x-default>
