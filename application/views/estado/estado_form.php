
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Estado </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nombre <?php echo form_error('nombre') ?></label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>" />
        </div>
	    <input type="hidden" name="idestado" value="<?php echo $idestado; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('estado') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    