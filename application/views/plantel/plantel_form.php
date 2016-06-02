
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Plantel </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Plantel <?php echo form_error('Plantel') ?></label>
            <input type="text" class="form-control" name="Plantel" id="Plantel" placeholder="Plantel" value="<?php echo $Plantel; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ubicacion <?php echo form_error('Ubicacion') ?></label>
            <input type="text" class="form-control" name="Ubicacion" id="Ubicacion" placeholder="Ubicacion" value="<?php echo $Ubicacion; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Directivo Iddirectivo <?php echo form_error('directivo_iddirectivo') ?></label>
            <input type="text" class="form-control" name="directivo_iddirectivo" id="directivo_iddirectivo" placeholder="Directivo Iddirectivo" value="<?php echo $directivo_iddirectivo; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Estado Idestado <?php echo form_error('estado_idestado') ?></label>
            <input type="text" class="form-control" name="estado_idestado" id="estado_idestado" placeholder="Estado Idestado" value="<?php echo $estado_idestado; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Del Mun <?php echo form_error('del_mun') ?></label>
            <input type="text" class="form-control" name="del_mun" id="del_mun" placeholder="Del Mun" value="<?php echo $del_mun; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Colonia <?php echo form_error('Colonia') ?></label>
            <input type="text" class="form-control" name="Colonia" id="Colonia" placeholder="Colonia" value="<?php echo $Colonia; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Calle Y Numero <?php echo form_error('Calle y Numero') ?></label>
            <input type="text" class="form-control" name="Calle y Numero" id="Calle y Numero" placeholder="Calle Y Numero" value="<?php echo $Calle y Numero; ?>" />
        </div>
	    <input type="hidden" name="idplantel" value="<?php echo $idplantel; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('plantel') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    