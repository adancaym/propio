
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Auxiliar </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Descripcion <?php echo form_error('descripcion') ?></label>
            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" value="<?php echo $descripcion; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Cargos Idcargos <?php echo form_error('cargos_idcargos') ?></label>
            <input type="text" class="form-control" name="cargos_idcargos" id="cargos_idcargos" placeholder="Cargos Idcargos" value="<?php echo $cargos_idcargos; ?>" />
        </div>
	    <input type="hidden" name="idauxiliar" value="<?php echo $idauxiliar; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('auxiliar') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    