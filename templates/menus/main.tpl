<!--BEGIN SIDEBAR -->
<div class="page-sidebar navbar-collapse collapse">
	<ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
		<li class="sidebar-toggler-wrapper hide">
			<div class="sidebar-toggler">
				<span></span>
			</div>
		</li>
    <li class="nav-item start {if $page == 'homepage'}active{/if}">
        <a href="{$WEB_ROOT}" class="nav-link nav-toggle">
        <i class="fa fa-home"></i>
        <span class="title">Inicio</span>
        {if $page == "homepage"}
		 <span class="selected"></span>
        <span class="arrow open"></span>
        {/if}
        </a>
    </li>
	<li class="heading">
       <h3 class="uppercase">Menu de opciones</h3>
    </li>
    {if in_array(1,$privilegios) or $Usr.rolId eq 1}
    <li class="nav-item {if $page=='config' || $page=='usuario' || $page=='rol' || $page=='empresa'}active open{/if}">
        <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-settings"></i>
        <span class="title">Configuraciones</span>
        {if $page =='rol' ||$page=='config_role'|| $page=='perm_accion'|| $page=='usuario' || $page=='empresa' || $page=='colonia'}
			 <span class="selected"></span>
			 <span class="arrow open"></span>
        {else}
		     <span class="arrow"></span>
        {/if}
        </a>
        <ul class="sub-menu">
        	{if in_array(4,$privilegios) or $Usr.rolId eq 1}
	        	<li class="nav-item {if $page=='empresa'}active open{/if}">
					<a class="nav-link " href="{$WEB_ROOT}/empresa">
						<i class="icon-settings"></i>
						<span class="title">Datos de la dependencia</span>
					</a>
				</li>
			{/if}
			{if in_array(6,$privilegios) or $Usr.rolId eq 1}
	        	<li class="nav-item {if $page=='rol' || $page=='config_role'}active open{/if}">
					<a class="nav-link " href="{$WEB_ROOT}/rol">
						<i class="icon-settings"></i>
						<span class="title">Roles</span>
					</a>
				</li>
			{/if}

			{if in_array(7,$privilegios) or $Usr.rolId eq 1}
				<li class="nav-item {if $page=='usuario'}active open{/if}">
					<a class="nav-link " href="{$WEB_ROOT}/usuario">
						<i class="icon-settings"></i>
						<span class="title">Usuarios</span>
					</a>
				</li>
			{/if}
        </ul>
	</li>
	{/if}

	{if in_array(2,$privilegios) or $Usr.rolId eq 1}
    <li class="nav-item {if $page =='imagenes'}active open{/if}">
        <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-briefcase"></i>
        <span class="title">Pagina Web</span>
		{if $page=='imagenes'}
		 <span class="selected"></span>
         <span class="arrow open"></span>
        {else}
		   <span class="arrow"></span>
		{/if}
        </a>
        <ul class="sub-menu">
			{if in_array(14,$privilegios) or $Usr.rolId eq 1}
				<li class="nav-item {if $page=='imagenes'}active open{/if}">
					<a class="nav-link " href="{$WEB_ROOT}/imagenes">
						<i class="ui-icon-image"></i>
						<span class="title">Imagenes</span>
					</a>
				</li>
			{/if}
        </ul>
	</li>
	{/if}
    {if in_array(15,$privilegios) || $Usr.rolId eq 1}
	 <li class="nav-item {if $page =='poll' || $page =='question' || $page =='colonia'}active open{/if}">
        <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-list"></i>
        <span class="title">Catalogos</span>
		{if $page=='poll' || $page =='question'}
		 <span class="selected"></span>
         <span class="arrow open"></span>
        {else}
		   <span class="arrow"></span>
		{/if}
        </a>
        <ul class="sub-menu">
       		{if in_array(17,$privilegios) or $Usr.rolId eq 1}
        	<li class="nav-item {if $page=='poll' || $page=='question' || $page=='poll-analytics'}active open{/if}">
				<a class="nav-link " href="{$WEB_ROOT}/poll">
					<i class="icon-list"></i>
					<span class="title">Encuestas</span>
				</a>
			</li>
			{/if}
			{*if in_array(16,$privilegios) or $usr.rolId eq 1}
				<li class="nav-item {if $page=='colonia'}active open{/if}">
					<a class="nav-link " href="{$WEB_ROOT}/colonia">
						<i class="icon-settings"></i>
						<span class="title">Colonias</span>
					</a>
				</li>
			{/if*}
		</ul>
      </li>
    {/if}
	{if in_array(19,$privilegios) || $Usr.rolId eq 1}
	<li class="nav-item {if $page =='report' || $page =='geolocation' || $page =='do-poll' || $page =='done-polls' || $page == 'statistics'}active open{/if}">
		<a href="javascript:;" class="nav-link nav-toggle">
			<i class="icon-list"></i>
			<span class="title">Encuestas Aplicadas</span>
			{if $page=='report'}
				<span class="selected"></span>
				<span class="arrow open"></span>
			{else}
				<span class="arrow"></span>
			{/if}
		</a>
		<ul class="sub-menu">
			{if in_array(20,$privilegios) or $Usr.rolId eq 1}
				<li class="nav-item {if $page=='do-poll'}active open{/if}">
					<a class="nav-link " href="{$WEB_ROOT}/do-poll">
						<i class="icon-list"></i>
						<span class="title">Nueva encuesta</span>
					</a>
				</li>
			{/if}
			{if in_array(24,$privilegios) or $Usr.rolId eq 1}
				<li class="nav-item {if $page=='done-polls'}active open{/if}">
					<a class="nav-link " href="{$WEB_ROOT}/done-polls">
						<i class="icon-list"></i>
						<span class="title">Encuestas realizadas</span>
					</a>
				</li>
			{/if}
			<!-- class="nav-item {if $page=='poll' || $page=='poll-analytics'}active open{/if}">
				<a class="nav-link " href="{$WEB_ROOT}/poll">
					<i class="icon-list"></i>
					<span class="title">Estadistica</span>
				</a>
			</li-->
			{if in_array(25,$privilegios) or $Usr.rolId eq 1}
				<li class="nav-item {if $page =='geolocation'}active open{/if}" >
					<a class="nav-link " href="{$WEB_ROOT}/geolocation">
						<i class="icon-map"></i>
						<span class="title">Geolocalizacion</span>
					</a>
				</li>
			{/if}
			{if in_array(26,$privilegios) or $Usr.rolId eq 1}
				<li class="nav-item {if $page=='statistics'}active open{/if}" >
					<a class="nav-link " href="{$WEB_ROOT}/statistics">
						<i class="icon-bar-chart"></i>
						<span class="title">Estadistica</span>
					</a>
				</li>
			{/if}
		</ul>
	</li>
	{/if}
</ul>
</div>
<!-- END SIDEBAR MENU
