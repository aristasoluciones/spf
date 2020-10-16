<!-- BEGIN PAGE HEADER-->
	<div class="page-bar">
		 <ul class="page-breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Inicio</a> 
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="{$WEB_ROOT}/pedido">Pedidos</a>
				<i class="fa fa-circle"></i>
			</li>
			<li><a href="#"></a></li>
		</ul>
		<div class="page-toolbar">
		</div>
	</div>
	 <!-- BEGIN PAGE TITLE-->
		<h1 class="page-title">
		     Detalles del pedido
			<small></small>
		</h1>
	 <!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="invoice">
	 <div class="row invoice-logo">
        <div class="col-xs-4 invoice-logo-space">
            <img src="{$WEB_ROOT}/images/logo.png" class="img-responsive" alt="" /> </div>
        <div class="col-xs-4 invoice-logo-space">
         <h1>{if $detallespedido.cliente.estatus eq 'cancelado'}<font color="red"><strong>CANCELADO</strong></font>{/if}</h1>
        </div>
        <div class="col-xs-4">
            <p> No. Pedido {$detallespedido.cliente.folio} /Fecha: {$detallespedido.cliente.fecha}
                <span class="muted"></span>
            </p>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-xs-6">
            <h3><b>Cliente</b></h3>
            <ul class="list-unstyled">
                <li> {$detallespedido.cliente.cliente}</li>
                <li> Ciudad</li>
                <li> Pais</li>
                <li> Codigo postal </li>
            </ul>
        </div>
         <div class="col-xs-6">
            <h3></h3>
             <h3><b>Empresa</b></h3>
            <ul class="list-unstyled">
                <li> {$detallespedido.datosempresa.nombre}</li>
                <li> {$detallespedido.datosempresa.direccion}</li>
                <li> {$detallespedido.datosempresa.ciudad}, {$detallespedido.datosempresa.estado}, {$detallespedido.datosempresa.pais}</li>
                <li> {$detallespedido.datosempresa.cp} </li>
                <li> {$detallespedido.datosempresa.rfc} </li>
                <li> {$detallespedido.datosempresa.email} </li>
                <li> {$detallespedido.datosempresa.telefonos} </li>
            </ul>
        </div>       
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th >#</th>
                        <th  >producto </th>
                        <th >Unidad</th>
                        <th >Cantidad</th>
                        <th >Precio Unitario</th>
                        <th >Total</th>
                    </tr>
                </thead>
                <tbody>
                {assign var=total  value=0}
                  {foreach from=$detallespedido.productos item=item key=key}
                    <tr>
                        <td >{$key+1}</td>
                        <td >{$item.nombre}</td>
                        <td >PZA</td>
                        <td >{$item.cantidad}</td>
                        <td >$ {$item.precio|number_format:2:".":","}</td>
                        <td >$ {$item.precio*$item.cantidad|number_format:2:".":","}</td>
                    </tr>
                    {assign var="t" value=$item.precio*$item.cantidad}
                    {assign var=total value=$total+$t}
                  {/foreach}
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
    <div class="col-xs-4"></div>
    <div class="col-xs-8 invoice-block">
        <ul class="list-unstyled amounts">
            <li>
                <strong>Subtotal</strong>$ {$total/1.16|number_format:2:".":","}</li>
            <li>
                <strong>Iva (16%)</strong>$ {($total*0.16)|number_format:2:".":","}</li>
            <li>
                <strong>Grand Total:</strong>$ {$total|number_format:2:".":","} </li>
        </ul>
       <!--  <br/>
        <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();"> Print
            <i class="fa fa-print"></i>
        </a>
        <a class="btn btn-lg green hidden-print margin-bottom-5"> Submit Your Invoice
            <i class="fa fa-check"></i>
        </a> -->
        <br/>
        <a class="btn btn-lg blue hidden-print margin-bottom-5" href="{$WEB_ROOT}/pedido"> Atras
            <i class="fa fa-arrow"></i>
        </a>
    </div>
   </div>
</div>