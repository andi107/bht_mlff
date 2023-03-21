const url = window.burl;
const device_id = $("input[name=_deviceid]").val();
var tblgeolist = $('#tblmlfflist').DataTable({
    "lengthChange": false,
    order: [
        [0, 'desc']
    ],
});
$.get(url + `/tracking/detail/js/mlff/${device_id}`, function(res) {
    $.each(res.mlffHistoryData.data, function(k, v) {
        tblgeolist.row.add([
            window.dtHumanParse(v.fddeclaration), v.gate_name ,v.ftsection,v.ftpayment_type, '-'
        ]).draw(true);
    });
});