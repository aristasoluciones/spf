<?php

session_start();
include_once(DOC_ROOT.'/properties/errors.es.php');
require(DOC_ROOT.'/libs/Smarty.class.php');
require(DOC_ROOT.'/libs/nusoap.php');
include_once(DOC_ROOT."/libs/qr/qrlib.php");
include_once(DOC_ROOT."/libs/PHPExcel/Classes/PHPExcel.php");

include_once(DOC_ROOT.'/classes/db.class.php');
$db = new DB;
if(USE_COMPOSER)
    require 'vendor/autoload.php';
else
    require_once 'libs/dompdf/autoload.inc.php';
include_once(DOC_ROOT.'/classes/error.class.php');
$error = new CustomError;


include_once(DOC_ROOT.'/classes/util.class.php');
$util = new Util;

include_once(DOC_ROOT.'/classes/main.class.php');
$main = new Main;

include_once(DOC_ROOT.'/classes/user.class.php');
$user = new User;

include_once(DOC_ROOT.'/classes/usuario.class.php');
$usuario = new Usuario;

include_once(DOC_ROOT.'/classes/role.class.php');
$objRole = new Role;

include_once(DOC_ROOT.'/classes/config.class.php');
$config = new Config;

include_once(DOC_ROOT.'/classes/puesto.class.php');
$puesto = new Puesto;


// CLASSES DE SECCION CATALOGOS
include_once(DOC_ROOT.'/classes/producto.class.php');
$producto = new Producto;

include_once(DOC_ROOT.'/classes/sucursal.class.php');
$sucursal = new Sucursal;

include_once(DOC_ROOT.'/classes/imagen.class.php');
$imagen = new Imagen;

include_once(DOC_ROOT.'/classes/cliente.class.php');
$cliente = new Cliente;

include_once(DOC_ROOT.'/classes/municipio.class.php');
$municipio = new Municipio;

include_once(DOC_ROOT.'/classes/colonia.class.php');
$colonia = new Colonia;

include_once(DOC_ROOT.'/classes/localidad.class.php');
$localidad = new Localidad();

include_once(DOC_ROOT.'/classes/pedido.class.php');
$pedido = new Pedido;

include_once(DOC_ROOT.'/classes/encuesta.class.php');
$encuesta = new Encuesta;

include_once(DOC_ROOT.'/classes/victima.class.php');
$victima = new Victima;

include_once(DOC_ROOT.'/classes/questions.class.php');
$question = new Question;

include_once(DOC_ROOT.'/classes/class.phpmailer.php');
include_once(DOC_ROOT.'/classes/class.smtp.php');
include_once(DOC_ROOT.'/classes/sendmail.class.php');


 /* pChart library inclusions */
  include_once(DOC_ROOT."/libs/pChart2.0/class/pData.class.php");
  include_once(DOC_ROOT."/libs/pChart2.0/class/pDraw.class.php");
  include_once(DOC_ROOT."/libs/pChart2.0/class/pPie.class.php");
  include_once(DOC_ROOT."/libs/pChart2.0/class/pImage.class.php");

/*include_once(DOC_ROOT.'/libs/jpgraph/src/jpgraph.php');
include_once(DOC_ROOT.'/libs/jpgraph/src/jpgraph_line.php');
include_once(DOC_ROOT.'/libs/jpgraph/src/jpgraph_pie.php');
include_once(DOC_ROOT.'/libs/jpgraph/src/jpgraph_bar.php');*/


$smarty = new Smarty;
$Usr = $_SESSION['Usr'];
if($Usr["rolId"]==1)
    $objRole->setAdmin(1);

$objRole->setRoleId($Usr['rolId']);
$permissions = $objRole->GetPermisosByRol();
$smarty->assign('privilegios', $permissions);
$smarty->assign('Usr', $Usr);
$_SESSION['local_language'] = $_COOKIE['local_language'];

$name_file = $_SESSION['local_language'] > 0 ? $local_language[$_SESSION['local_language']] : 'default';
$file  = DOC_ROOT . "/properties/".$name_file.".json";
$string = file_get_contents($file);;
$headers = json_decode($string, true);
$smarty->assign('local_language_name', $local_language[$_SESSION['local_language']]);
$smarty->assign('translates', $headers[0]);
$smarty->assign('local_language',$_SESSION['local_language']);
$smarty->assign('DOC_ROOT',DOC_ROOT);
$smarty->assign('WEB_ROOT',WEB_ROOT);
$smarty->assign('property', $property);
?>
