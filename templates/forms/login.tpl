<div style="background-color: rgba(255,255,255, 0.3)">
    	<a href="{$WEB_ROOT}" >
            <img src="{$WEB_ROOT}/images/SIV-LOGO2.png" border="0" width="100%"   />
        </a>
	</div>	

<form class="login-form" id="frmLogin" method="post">
<input type="hidden" name="type" value="doLogin">
    <h3 class="form-title">Iniciar Sesi&oacute;n</h3>
    <div class="alert alert-danger display-hide" id="txtErrMsg">
		<button class="close" data-close="alert"></button>
		<span id="txtErrMsg"></span>
    </div>	
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Correo Electr&oacute;nico:</label>
        <div class="controls">
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Usuario" name="username" id="username" autocomplete="off"/>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Contrase&ntilde;a:</label>
        <div class="controls">
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" placeholder="Contrase&ntilde;a" name="password" id="password" autocomplete="off"/>
            </div>
        </div>
    </div>
    <div align="center" id="loader"></div>
       
    <div class="form-actions" class="content" style="background-color: rgba(255,255,255, 0.0)">
        <label class="checkbox">				
        </label>
        <button type="button" style="background-color:#0f6971" class="btn green pull-right" onClick="DoLogin()">
        Ingresar <i class="m-icon-swapright m-icon-white"></i>
        </button>            
    </div>
	<div class="forget-password">
		<!--<h4>¿ Olvidaste tu contraseña ?</h4>
		<p> Recuperar
		<a href="javascript:;" id="forget-password"> Aqui </a> </p>-->
    </div>
   <!--  <div class="create-account">
		<p> ¿ No tienes una cuenta ?
			<a href="javascript:;" id="register-btn"> Registrate </a>
		</p>
    </div> -->	
</form>