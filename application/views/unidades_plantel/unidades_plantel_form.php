
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Unidades_plantel </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Id Area <?php echo form_error('id_Area') ?></label>
            <input type="text" class="form-control" name="id_Area" id="id_Area" placeholder="Id Area" value="<?php echo $id_Area; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Plantel Cct <?php echo form_error('plantel_cct') ?></label>
            <input type="text" class="form-control" name="plantel_cct" id="plantel_cct" placeholder="Plantel Cct" value="<?php echo $plantel_cct; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Area <?php echo form_error('Area') ?></label>
            <input type="text" class="form-control" name="Area" id="Area" placeholder="Area" value="<?php echo $Area; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Contacto Correo <?php echo form_error('contacto_correo') ?></label>
            <input type="text" class="form-control" name="contacto_correo" id="contacto_correo" placeholder="Contacto Correo" value="<?php echo $contacto_correo; ?>" />
        </div>
	    <input type="hidden" name="idunidades_plantel" value="<?php echo $idunidades_plantel; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('unidades_plantel') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    