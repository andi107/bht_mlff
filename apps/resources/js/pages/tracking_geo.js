const url = window.burl;
const device_id = $("input[name=_id]").val();
var tblgeolist = $('#tblgeolist').DataTable({
    "lengthChange": false
});
{/* <th>Date</th>
<th>Geofence Name</th>
<th>Geofence Address</th>
<th>Declaration</th> */}
// created_at
// fngeo_declare
// fngeo_id
// fnstatus
// fntype
// ftaddress
// ftdevice_id
// ftgeo_name

$.get(url + `/tracking/detail/js/geo/${device_id}`, function(res) {
    $.each(res.geoData.data, function(k, v) {
        tblgeolist.row.add([
            v.created_at, v.ftgeo_name ,v.ftaddress,v.fngeo_declare ? 'Entry':'Out'
        ]).draw(true);
    });
});