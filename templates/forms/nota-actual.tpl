 <div class="col-md-12">
     <div class="blog-single-content bordered blog-container">
        <div class="blog-single-head">
            <h1 class="blog-single-head-title">{$info.titulo}</h1>
            <div class="blog-single-head-date">
                <i class="icon-calendar font-blue"></i>
                <a href="javascript:;">Fecha publicacion {$info.fechaPublicacion}</a>
            </div>
        </div>
        <div class="blog-single-img">
            <img src="{$info.rutaImagen}" /> 
        </div>
        <div class="blog-single-desc">
            {$info.texto}
        </div>
     </div>
 </div>