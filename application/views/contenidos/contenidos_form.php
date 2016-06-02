
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Contenidos </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Titulo <?php echo form_error('titulo') ?></label>
            <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo" value="<?php echo $titulo; ?>" />
        </div>
	    <div class="form-group">
            <label for="longtext">Contenido <?php echo form_error('contenido') ?></label>
            <input type="text" class="form-control" name="contenido" id="contenido" placeholder="Contenido" value="<?php echo $contenido; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Auxiliar Idauxiliar <?php echo form_error('auxiliar_idauxiliar') ?></label>
            <input type="text" class="form-control" name="auxiliar_idauxiliar" id="auxiliar_idauxiliar" placeholder="Auxiliar Idauxiliar" value="<?php echo $auxiliar_idauxiliar; ?>" />
        </div>
	    <input type="hidden" name="idcontenidos" value="<?php echo $idcontenidos; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('contenidos') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    