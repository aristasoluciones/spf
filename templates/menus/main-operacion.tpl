<ul class="page-sidebar-menu">
	{*}
    <li>
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="sidebar-toggler hidden-phone"></div>
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
    </li>
    {*}
    <li>
        <div align="center">
            <a href="{$WEB_ROOT}">
                <img src="{$WEB_ROOT}/images/logo.png" border="0" width="150" height="150" />
            </a>
			<br>
        </div>
    </li>
    <li class="{if $page == "homepage"}start active{/if}">
        <a href="{$WEB_ROOT}"> 
        <i class="icon-home"></i> 
        <span class="title">Inicio</span>
        {if $page == "homepage"}
        <span class="selected"></span>
        {/if}
        </a>
    </li>
    <li class="{if $page == "usuario" || $page == "establo" || $page == "producto" || $page == "tratamiento" || $page == "aislamiento-bacteriologico"}active{/if}">
        <a href="javascript:;">
        <i class="icon-table"></i> 
        <span class="title">Cat&aacute;logos</span>
        <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
		
			<li {if $page == "producto"}class="active"{/if}>
                <a href="{$WEB_ROOT}/producto">Productos</a>
            </li>
			<li {if $page == "tratamiento"}class="active"{/if}>
                <a href="{$WEB_ROOT}/tratamiento">Protocolo</a>
            </li>
			<li {if $page == "aislamiento-bacteriologico"}class="active"{/if}>
                <a href="{$WEB_ROOT}/aislamiento-bacteriologico">Aislamiento bacteriologico</a>
            </li>

        </ul>
	</li> 
	
	<li class="{if $page == "agregar-incidencia" || $page == "incidencia" || $page == "tratamiento-animal"}active{/if}">
        <a href="javascript:;">
        <i class="icon-table"></i> 
        <span class="title">Animales</span>
        <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {if $page == "agregar-incidencia"}class="active"{/if}>
                <a href="{$WEB_ROOT}/agregar-incidencia">Agregar Incidencia</a>
            </li>
			<li {if $page == "incidencia"}class="active"{/if}>
                <a href="{$WEB_ROOT}/incidencia">Incidencias</a>
            </li>
			<li {if $page == "tratamiento-animal"}class="active"{/if}>
                <a href="{$WEB_ROOT}/tratamiento-animal">Protocolos</a>
            </li>
        </ul>
	</li>
	<li class="{if $page == 'estadistica-caso' || $page == 'reporte-costo' || $page == 'reporte-tratamiento' || $page == 'reporte-reincidencia'}active{/if}">
        <a href="javascript:;">
        <i class="icon-table"></i> 
        <span class="title">Reportes</span>
        <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {if $page == "estadistica-caso"}class="active"{/if}>
                <a href="{$WEB_ROOT}/estadistica-caso">Estadistica de casos</a>
            </li>
			<li {if $page == "reporte-costo"}class="active"{/if}>
                <a href="{$WEB_ROOT}/reporte-costo">Reporte de costos</a>
            </li>
			<li {if $page == "reporte-tratamiento"}class="active"{/if}>
                <a href="{$WEB_ROOT}/reporte-tratamiento">Reporte Tratamientos</a>
            </li>
			<li {if $page == "reporte-reincidencia"}class="active"{/if}>
                <a href="{$WEB_ROOT}/reporte-reincidencia">Reporte Reincidencia</a>
            </li>
        </ul>
	</li> 
	
      
</ul>