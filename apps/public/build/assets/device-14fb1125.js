const s=location.protocol+"//"+window.location.host;$("#formDevice").submit(function(t){t.preventDefault(),c()});var c=function(){var t=$("input[name=_backurl]").val(),a=$("input[name=txtdevice_id]").val(),e=new FormData;e.append("_id",$("input[name=_id]").val()),e.append("_token",$("input[name=_token]").val()),e.append("seltrackcategory",$("select[name=seltrackcategory]").val()),e.append("txtdevice_id",a),e.append("txtdevicename",$("input[name=txtdevicename]").val()),e.append("txtassetid",$("input[name=txtassetid]").val()),e.append("txtassetname",$("input[name=txtassetname]").val()),e.append("txtassettype",$("input[name=txtassettype]").val()),e.append("txtcustomername",$("input[name=txtcustomername]").val()),e.append("txtassetdescription",$("textarea[name=txtassetdescription]").val()),$.ajax({type:"POST",url:s+"/device/js/add",data:e,dataType:"json",contentType:!1,cache:!1,processData:!1,beforeSend:function(){$("#formDevice").css("opacity",".5")},success:function(n){$("#formDevice").css("opacity","");var o=n.msg;console.log(o),o.code===200?swal({title:"Success",text:"Continue editing?",type:"success",showCancelButton:!0,confirmButtonClass:"btn-primary",confirmButtonText:"Yes, continue editing!",cancelButtonText:"No, take me back!",closeOnConfirm:!1,closeOnCancel:!1},function(i){i?window.location.href=s+"/device/detail/"+a:window.location.href=t}):toastr.error(n.msg.obj,"Error")}})};
