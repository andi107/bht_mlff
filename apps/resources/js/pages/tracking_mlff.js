const url = window.burl;
const device_id = $("input[name=_deviceid]").val();
var tblmlfflist = $('#tblmlfflist').DataTable({
    "lengthChange": false,
    order: [
        [0, 'desc']
    ],
    scrollX: true,
    "columnDefs": [
        { 'visible': false, 'targets': [0] },
        {
            // <button class="btn btn-info waves-effect waves-classic" data-content="And here's some amazing content. It's very engaging. Right?" data-trigger="hover" data-toggle="popover" data-original-title="Hover to trigger" tabindex="0" title="" type="button">Hover to trigger</button>
            targets: -1, 
            "defaultContent": '<button class="btnedit btn btn-pure btn-primary icon md-edit waves-effect waves-classic"></button>'
        },
    ]
});
{/* <th>Entry Time</th> */}
{/* <th>Entry Gate</th> */}
{/* <th>Toll Sec. Entry</th> */}
{/* <th>Exit Time</th> */}
{/* <th>Exit Gate</th> */}
{/* <th>Toll Sec. Exit</th> */}
{/* <th>Action</th> */}

$('#tblmlfflist tbody').on( 'click', 'button.btnedit', function () {
    var data = tblmlfflist.row($(this).parents('tr')).data(), sURL;
    console.log(data)
    // sURL = `{{ route('geomlff_detail', ':id') }}`;
    // window.location.href = sURL.replace(":id", data[0]);
});

$.get(url + `/tracking/detail/js/mlff/${device_id}`, function(res) {
    console.log(res)
    $.each(res.mlffHistoryData.data, function(k, v) {
        var _declareExit = '-', _nameExit = '-',_secExit = '-'
        if (v.fddeclaration_exit) {
            _declareExit = v.fddeclaration_exit;
            _nameExit = v.gate_exit_name;
            _secExit = v.gate_exit_ftsection;
        }
        tblmlfflist.row.add([
            window.dtHumanParse(v.fddeclaration), v.gate_name ,v.ftsection,_declareExit,_nameExit,_secExit
        ]).draw(true);
    });
});