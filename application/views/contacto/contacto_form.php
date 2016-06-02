
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Contacto </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Correo <?php echo form_error('correo') ?></label>
            <input type="text" class="form-control" name="correo" id="correo" placeholder="Correo" value="<?php echo $correo; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Telefono <?php echo form_error('telefono') ?></label>
            <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $telefono; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ext <?php echo form_error('ext') ?></label>
            <input type="text" class="form-control" name="ext" id="ext" placeholder="Ext" value="<?php echo $ext; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Cargos Idcargos <?php echo form_error('cargos_idcargos') ?></label>
            <input type="text" class="form-control" name="cargos_idcargos" id="cargos_idcargos" placeholder="Cargos Idcargos" value="<?php echo $cargos_idcargos; ?>" />
        </div>
	    <input type="hidden" name="idcontacto" value="<?php echo $idcontacto; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('contacto') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    