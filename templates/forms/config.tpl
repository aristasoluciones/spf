<div class="row-fluid">
																				
    <div class="tab-pane" id="tab_5">
        <div class="portlet box "  style="margin-bottom:5px">
            
                <!-- BEGIN FORM-->
                <form id="frmGral" action="#" class="form-horizontal form-bordered">
                <input type="hidden" name="type" value="save" />
                <input type="hidden" name="id" id="id" value="{$info.idReg}" />
                    
					<b>Tema</b>
					<div class="control-group">
                       <div class="color-panel hidden-phone">
							<div class="color-mode-icons icon-color"></div>
							<div class="color-mode-icons icon-color-close"></div>
							<div class="color-mode">
								
								<ul class="inline">
									<li class="color-black current color-default" data-style="default" onClick="CambiarTema(1)"></li>
									<li class="color-blue" data-style="blue" onClick="CambiarTema(2)"></li>
									<li class="color-brown" data-style="brown" onClick="CambiarTema(3)"></li>
									<li class="color-purple" data-style="purple" onClick="CambiarTema(4)"></li>
									<li class="color-grey" data-style="grey" onClick="CambiarTema(5)"></li>
									<li class="color-white color-light" data-style="light" onClick="CambiarTema(6)"></li>
								</ul>
								<!--<label>
									<span>Layout</span>
									<select class="layout-option m-wrap small">
										<option value="fluid" selected>Fluid</option>
										<option value="boxed">Boxed</option>
									</select>
								</label>
								<label>
									<span>Header</span>
									<select class="header-option m-wrap small">
										<option value="fixed" selected>Fixed</option>
										<option value="default">Default</option>
									</select>
								</label>
								<label>
									<span>Sidebar</span>
									<select class="sidebar-option m-wrap small">
										<option value="fixed">Fixed</option>
										<option value="default" selected>Default</option>
									</select>
								</label>
								<label>
									<span>Footer</span>
									<select class="footer-option m-wrap small">
										<option value="fixed">Fixed</option>
										<option value="default" selected>Default</option>
									</select>
								</label>-->
							</div>
						</div>
                       
                    </div>
					
					<b>Logos</b>
					<div class="control-group">
                        <label class="control-label"><span class="reqIcon">*</span>Logo 1:</label>
                        <div class="controls">
                        	
                            <input type="file" class="m-wrap span12" name="logo1"  onChange="changeLogo(1)"/>
                             <img src="{$WEB_ROOT}/images/img_se.png" alt="" width="30%"/>
                        </div>
						<label class="control-label"><span class="reqIcon">*</span>Logo 2:</label>
                        <div class="controls">
                        	
                            <input type="file" class="m-wrap span12" name="logo2" onChange="changeLogo(2)" />
                             <img src="{$WEB_ROOT}/images/img_se2.png" alt="" width="30%"/>
                        </div>
						<label class="control-label"><span class="reqIcon">*</span>Logo 3:</label>
                        <div class="controls">
                        	
                            <input type="file" class="m-wrap span12" name="logo3" onChange="changeLogo(3)"  />
                            <img src="{$WEB_ROOT}/images/logo.png" alt="" width="30%"/>
                        </div>
	
                    </div>
                      
                </form>
                <!-- END FORM-->                  
         
       
    </div>
    
    
</div>
    
</div>