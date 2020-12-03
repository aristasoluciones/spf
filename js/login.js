$(window).load(function() {
	$('#email').bind("keypress", function(event){
		var key = event.which || event.keyCode;
		if(key == 13) DoLogin();
	})

	$('#password').bind("keypress", function(event){
		var key = event.which || event.keyCode;
		if(key == 13) DoLogin();
	})

});

function DoLogin(){
	$.ajax({
	  	type: "POST",
	  	url: WEB_ROOT+"/ajax/login.php",
	  	data: $("#frmLogin").serialize(true),
		beforeSend: function(){
			$("#loader").html(LOADER);
			$("#txtErrMsg").hide(0);
		},
	  	success: function(response) {
			var splitResp = response.split("[#]");
			$("#loader").html("");
			if(splitResp[0] == "ok") {
				set_cookie('is_logged', true);
				window.location.href = WEB_ROOT;
			}else if(splitResp[0] == "fail"){
				$("#txtErrMsg").show();
				$("#txtErrMsg").show();
				$("#txtErrMsg").html(splitResp[1]);
			}else {
				alert("Ocurrio un error al cargar los datos.");
			}
		},
		error:function(){
			  alert("Something went wrong...")
		}
    });
}
