
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Contenidos_has_archivos </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Contenidos Idcontenidos <?php echo form_error('contenidos_idcontenidos') ?></label>
            <input type="text" class="form-control" name="contenidos_idcontenidos" id="contenidos_idcontenidos" placeholder="Contenidos Idcontenidos" value="<?php echo $contenidos_idcontenidos; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Archivos Idarchivos <?php echo form_error('archivos_idarchivos') ?></label>
            <input type="text" class="form-control" name="archivos_idarchivos" id="archivos_idarchivos" placeholder="Archivos Idarchivos" value="<?php echo $archivos_idarchivos; ?>" />
        </div>
	    <input type="hidden" name="contenidos_has_archivos" value="<?php echo $contenidos_has_archivos; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('contenidos_has_archivos') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    