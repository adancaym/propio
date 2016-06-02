
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Titulo_academico </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Abreviatura <?php echo form_error('abreviatura') ?></label>
            <input type="text" class="form-control" name="abreviatura" id="abreviatura" placeholder="Abreviatura" value="<?php echo $abreviatura; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Titulo <?php echo form_error('titulo') ?></label>
            <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo" value="<?php echo $titulo; ?>" />
        </div>
	    <input type="hidden" name="idtitulo_academico" value="<?php echo $idtitulo_academico; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('titulo_academico') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    