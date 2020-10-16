var AJAX_PATH = WEB_ROOT+"/ajax/homepage.php";

function AddReg(){
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=add",		
	  	success: function(response) {			
			var splitResp = response.split("[#]");
									
			if(splitResp[0] == "ok")
				$("#frmModal").html(splitResp[1]);
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });
	
	$("#frmModal").modal("show");
	
}//AddReg

function EditReg(id){
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=edit&id="+id,
	  	success: function(response) {			
			var splitResp = response.split("[#]");
									
			if(splitResp[0] == "ok")	
				$("#frmModal").html(splitResp[1]);
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });
	
	$("#frmModal").modal("show");
	
}//EditReg

function SaveReg(){
	
	var p = $("#page").val();
	var id = $("#id").val();
	var isSearch = 1;//$("#isSearch").val();
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: $("#frmGral").serialize(true),
		beforeSend: function(){			
			$("#loader").html(LOADER);
			$("#txtErrMsg").hide(0);
		},
	  	success: function(response) {			
			var splitResp = response.split("[#]");

			$("#loader").html("");
			
			if(splitResp[0] == "ok"){
				$("#frmModal").modal("hide");

				if(id == "" && isSearch == "") 
					p = 0;
					
				if(isSearch)
					Search(p);				
				else
					LoadPage(p);
			}else if(splitResp[0] == "fail"){
				$("#txtErrMsg").show();
				$("#txtErrMsg").show();
				$("#txtErrMsg").html(splitResp[1]);				
			}else{
				alert(msgFail);
			}
			
		},
		error:function(){
			alert(msgError);
		}
    });
		
}//SaveReg

function DeleteReg(id){
	
	var p = $("#page").val();
	var resp = confirm("Esta seguro de eliminar este registro?");
	
	if(!resp)
		return;
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=delete&id="+id,
		beforeSend: function(){			
			$("#tblContent").html(LOADER3);
		},
	  	success: function(response) {			
			var splitResp = response.split("[#]");

			$("#tblContent").html("");
			
			if(splitResp[0] == "ok")
				LoadPage(p);
			else if(splitResp[0] == "fail")
				alert(msgFail);				
		},
		error:function(){
			alert(msgError);
		}
    });
		
}//DeleteReg

function ViewReg(id){
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=view&id="+id,
	  	success: function(response) {			
			var splitResp = response.split("[#]");
									
			if(splitResp[0] == "ok"){				
				$("#frmModal").html(splitResp[1]);
			}else{
				alert(msgFail);
			}
		},
		error:function(){
			alert(msgError);
		}
    });
	
	$("#frmModal").modal("show");
	
}//ViewReg

function Search(p){
	
	$("#isSearch").val(1);
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: $("#frmSearch").serialize(true) + "&p="+p,
		beforeSend: function(){			
			$("#tblContent").html(LOADER3);
		},
	  	success: function(response) {	
			var splitResp = response.split("[#]");
			
			$("#tblContent").html("");
			
			if(splitResp[0] == "ok")
				$("#tblContent").html(splitResp[1]);
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });
	
}//Search

function LoadPage(p){
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=loadPage&p="+p,
		beforeSend: function(){			
			$("#tblContent").html(LOADER3);
		},
	  	success: function(response) {	
			var splitResp = response.split("[#]");
	
			if(splitResp[0] == "ok")
				$("#tblContent").html(splitResp[1]);
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });
	
}//LoadPage

function ShowCalendar(){
	$("#fecha").datepicker("show");
}

function ShowCalendarIni(){
	$("#fechaIni").datepicker("show");
}

function ShowCalendarFin(){
	$("#fechaFin").datepicker("show");
}



