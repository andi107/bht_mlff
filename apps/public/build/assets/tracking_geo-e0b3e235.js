const t=window.burl,d=$("input[name=_id]").val();var n=$("#tblgeolist").DataTable({lengthChange:!1,order:[[0,"desc"]]});$.get(t+`/tracking/detail/js/geo/${d}`,function(a){$.each(a.geoData.data,function(o,e){n.row.add([window.dtHumanParse(e.created_at),e.ftgeo_name,e.ftaddress,e.fngeo_declare?"Entry":"Out"]).draw(!0)})});
