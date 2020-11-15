var urlLoc = document.location.hostname;
if(urlLoc == "localhost")
	var WEB_ROOT = "http://" + urlLoc + "/spf";
else if(urlLoc == "192.168.1.3")
	var WEB_ROOT = "http://" + urlLoc + "/spf";
else
	var WEB_ROOT = "http://" + urlLoc + "";

var LOADER = "<img src='"+WEB_ROOT+"/images/loading.gif'><br>Cargando...";
var LOADER2 = "<img src='"+WEB_ROOT+"/images/loader.gif'>";
var LOADER3 = "<div align='center'><img src='"+WEB_ROOT+"/images/loading.gif'><br>Cargando...</div>";

var msgFail = "Ocurrio un error al cargar los datos.";
var msgError = "Something went wrong...";
var AJAX_AUTOCOMPLETE = WEB_ROOT+"/ajax/autocomplete.php";

function verSubMenu(id){
	$("#mnuPrincipal_"+id).toggle();
}


jQuery(function($){
    $.fn.datepicker.dates['es'] = {
        days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
        daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        today: "Hoy",
        monthsTitle: "Meses",
        clear: "Borrar",
        weekStart: 1,
        format: "yyyy-mm-dd",
        autoclose:true
    };

    $.fn.datepicker.defaults.language="es";
    $.fn.datepicker.defaults.autoclose=true;

})

function dateFormat(date,format){
	var fecha="";
	if(date){
		fecha= date.split("-");
		if (format)
			var monthNames = new Array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		else
			var monthNames = new Array('Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic');
		fecha = fecha[2]+'-'+monthNames[fecha[1]-1]+'-'+fecha[0];
	}
	return fecha;
}

function Calendario(input){

    jQuery("#"+input.id).datepicker({
        todayBtn: true,
        todayBtn: "linked",
        onSelect: function (date){
            $( "#"+input).val(dateFormat(date,false));
        }
    }).focus();
}

function soloNumeros(e){
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   letras = "1234567890";
   especiales = [8,37,39,46,160];

   tecla_especial = false
   for(var i in especiales){
    if(key == especiales[i]){
      tecla_especial = true;
      break;
    }
   }

   if(letras.indexOf(tecla)==-1 && !tecla_especial){
    return false;
   }
}

function soloDigito(e){
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   letras = "1234567890";
   especiales = [8,37,39,160];

   tecla_especial = false
   for(var i in especiales){
    if(key == especiales[i]){
      tecla_especial = true;
      break;
    }
   }

   if(letras.indexOf(tecla)==-1 && !tecla_especial){
    return false;
   }
}
function downloadFormat(id){
    $.redirect(WEB_ROOT+"/ajax/download-formato.php", {'identity': id},'POST','_blank');
}
function openImportarCsv(string1){
    $.ajax({
        type: "POST",
        url: WEB_ROOT+"/ajax/producto.php",
        data: "type=openImportarCsv&table="+string1,
        success: function(response) {
            console.log(response)
            var splitResp = response.split("[#]");

            if(splitResp[0] == "ok")
            {
                $("#draggable").html(splitResp[1]);
            }
            else if(splitResp[0] == "fail")
            {
                bootbox.confirm(splitResp[1],function(res){ return;});
            }
        },
        error:function(){
            alert(msgError);
        }
    });
    $("#draggable").modal("show");
}
function saveImportarCsv()
{
    var ele  =document.getElementById('frmImportarArchivo');
    var frm = new FormData(ele);

    $.ajax({
        type: "POST",
        url: WEB_ROOT+"/ajax/producto.php",
        data: frm,
        processData: false,  // tell jQuery not to process the data
        contentType: false,
        beforeSend: function(){
            $("#loader").html(LOADER);
            $("#txtErrMsg").hide(0);
        },
        success: function(response) {
            console.log(response)
            var splitResp = response.split("[#]");
            $("#loader").html("");
            if(splitResp[0] == "ok"){
                $("#draggable").modal("hide");
                bootbox.confirm(splitResp[1],function(res){
                    location.reload();
                });

            }else if(splitResp[0] == "fail"){
                console.log(splitResp[0]);
                $("#txtErrMsg").show();
                $("#txtErrMsg").html(splitResp[1]);
            }else{
                bootbox.confirm(msgFail,function(res){ return;});
            }
        },
        error:function(){
            alert(msgError);
        }
    });

}
function camelize(str) {
    return str.replace(/(?:^\w|[A-Z]|\b\w)/g, function(word, index) {
        return index === 0 ? word.toLowerCase() : word.toUpperCase();
    }).replace(/\s+/g, '');
}
