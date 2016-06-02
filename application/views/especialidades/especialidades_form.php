
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Especialidades </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nombre <?php echo form_error('nombre') ?></label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Area Idarea <?php echo form_error('area_idarea') ?></label>
            <input type="text" class="form-control" name="area_idarea" id="area_idarea" placeholder="Area Idarea" value="<?php echo $area_idarea; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Clv Esp <?php echo form_error('clv_esp') ?></label>
            <input type="text" class="form-control" name="clv_esp" id="clv_esp" placeholder="Clv Esp" value="<?php echo $clv_esp; ?>" />
        </div>
	    <input type="hidden" name="idespecialidades" value="<?php echo $idespecialidades; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('especialidades') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    