const n=window.burl;$("#formCustomer").submit(function(s){s.preventDefault();var o=$("input[name=_backurl]").val(),a=$("input[name=_id]").val(),i=$("input[name=_isEdit]").val(),t=new FormData;t.append("_id",a),t.append("_token",$("input[name=_token]").val()),t.append("selstatus",$("select[name=selstatus]").val()),t.append("txtemail",$("input[name=txtemail]").val()),t.append("txtfirstname",$("input[name=txtfirstname]").val()),t.append("txtlastname",$("input[name=txtlastname]").val()),t.append("txttelephone",$("input[name=txttelephone]").val()),t.append("txtaddress",$("textarea[name=txtaddress]").val()),t.append("txtpassword",$("input[name=txtpassword]").val()),t.append("_isEdit",i),$.ajax({type:"POST",url:n+"/customer/js/addedit",data:t,dataType:"json",contentType:!1,cache:!1,processData:!1,beforeSend:function(){$("#formCustomer").css("opacity",".5")},success:function(e){console.log(e),$("#formCustomer").css("opacity","");var l=e.msg;l.code===200?swal({title:"Success",text:"Continue editing?",type:"success",showCancelButton:!0,confirmButtonClass:"btn-primary",confirmButtonText:"Yes, continue editing!",cancelButtonText:"No, take me back!",closeOnConfirm:!1,closeOnCancel:!1},function(p){p?window.location.href=n+"/customer/d/"+a:window.location.href=o}):toastr.error(e.msg.obj,"Error")}})});