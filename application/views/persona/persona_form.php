
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Persona </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Correo <?php echo form_error('correo') ?></label>
            <input type="text" class="form-control" name="correo" id="correo" placeholder="Correo" value="<?php echo $correo; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nombre <?php echo form_error('Nombre') ?></label>
            <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Nombre" value="<?php echo $Nombre; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Paterno <?php echo form_error('paterno') ?></label>
            <input type="text" class="form-control" name="paterno" id="paterno" placeholder="Paterno" value="<?php echo $paterno; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Materno <?php echo form_error('materno') ?></label>
            <input type="text" class="form-control" name="materno" id="materno" placeholder="Materno" value="<?php echo $materno; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Grado Escolar <?php echo form_error('grado_escolar') ?></label>
            <input type="text" class="form-control" name="grado_escolar" id="grado_escolar" placeholder="Grado Escolar" value="<?php echo $grado_escolar; ?>" />
        </div>
	    <input type="hidden" name="idpersona" value="<?php echo $idpersona; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('persona') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    