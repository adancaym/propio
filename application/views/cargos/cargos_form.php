
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Cargos </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Descripcion <?php echo form_error('descripcion') ?></label>
            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" value="<?php echo $descripcion; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Unidad Idunidad <?php echo form_error('unidad_idunidad') ?></label>
            <input type="text" class="form-control" name="unidad_idunidad" id="unidad_idunidad" placeholder="Unidad Idunidad" value="<?php echo $unidad_idunidad; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Correo <?php echo form_error('correo') ?></label>
            <input type="text" class="form-control" name="correo" id="correo" placeholder="Correo" value="<?php echo $correo; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Unidad <?php echo form_error('unidad') ?></label>
            <input type="text" class="form-control" name="unidad" id="unidad" placeholder="Unidad" value="<?php echo $unidad; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Persona Idpersona <?php echo form_error('persona_idpersona') ?></label>
            <input type="text" class="form-control" name="persona_idpersona" id="persona_idpersona" placeholder="Persona Idpersona" value="<?php echo $persona_idpersona; ?>" />
        </div>
	    <input type="hidden" name="idcargos" value="<?php echo $idcargos; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('cargos') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    