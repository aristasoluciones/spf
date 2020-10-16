<h1 class="page-title"><b>Mes Actual</b>
<small></small>
</h1>
<div class="table-container">
{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}

{foreach from=$registros.actual item=item key=key} 
	<b>{$item.day}</b><br>
	
<table class="table table-striped table-bordered table-hover" 0>
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre </th>
            <th>Total de Pedidos </th>
            <th>Importe Total de Pedidos </th>
            <th>Colonia </th>
            <th>Email </th>
            <th>Acci&oacute;n </th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$item.clientes item=itemc key=key}        	
			<tr>
				<td>{$key+1}</td>
				<td>{$itemc.nombre} {$itemc.apaterno} {$itemc.amaterno}</td>
				<td>{$itemc.total}</td>
				<td>{$itemc.total}</td>
				<td>{$itemc.total}</td>
				<td>{$itemc.email}</td>
				<td><div align="center">
	  
						<a href="javascript:void(0)"  onClick="ActiveReg({$itemc.clienteId})" title="ENVIAR CORREO">
							<img src="{$WEB_ROOT}/images/email.png" border="0">
						</a>

				</div>
				</td>
			</tr>
			{foreachelse}
			<tr>
				<td colspan="7"><div align="center">Ning&uacute;n registro encontrado.</div></td>
			</tr>
			{/foreach}
		</tbody>
	</table>
{/foreach}
</div>
<h1 class="page-title"><b>Proximo Mes</b>
<small></small>
</h1>

{foreach from=$registros.proximo item=item key=key} 
<b>{$item.day}</b><br>	
<table class="table table-striped table-bordered table-hover" 0>
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre </th>
            <th>Total de Pedidos </th>
            <th>Importe Total de Pedidos </th>
            <th>Colonia </th>
            <th>Email </th>
            <th>Acci&oacute;n </th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$item.clientes item=itemc key=key}        	
			<tr>
				<td>{$key+1}</td>
				<td>{$itemc.nombre} {$itemc.apaterno} {$itemc.amaterno}</td>
				<td>{$itemc.total}</td>
				<td>{$itemc.total}</td>
				<td>{$itemc.total}</td>
				<td>{$itemc.email}</td>
				<td><div align="center">
	  
						<a href="javascript:void(0)" onClick="ActiveReg({$itemc.clienteId})" title="ENVIAR CORREO">
							<img src="{$WEB_ROOT}/images/email.png" border="0">
							
						</a>

				</div>
				</td>
			</tr>
			{foreachelse}
			<tr>
				<td colspan="7"><div align="center">Ning&uacute;n registro encontrado.</div></td>
			</tr>
			{/foreach}
		</tbody>
	</table>
{/foreach}
<!--
{include file="{$DOC_ROOT}/templates/lists/pages.tpl" pages=$registros.pages info=$registros.info}-->