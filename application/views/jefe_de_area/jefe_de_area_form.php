
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Jefe_de_area </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nombramiento <?php echo form_error('Nombramiento') ?></label>
            <input type="text" class="form-control" name="Nombramiento" id="Nombramiento" placeholder="Nombramiento" value="<?php echo $Nombramiento; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Correo <?php echo form_error('correo') ?></label>
            <input type="text" class="form-control" name="correo" id="correo" placeholder="Correo" value="<?php echo $correo; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Cargos Idcargos <?php echo form_error('cargos_idcargos') ?></label>
            <input type="text" class="form-control" name="cargos_idcargos" id="cargos_idcargos" placeholder="Cargos Idcargos" value="<?php echo $cargos_idcargos; ?>" />
        </div>
	    <input type="hidden" name="idjefe_de_area" value="<?php echo $idjefe_de_area; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jefe_de_area') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    