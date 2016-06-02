
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Area </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Plantel Idplantel <?php echo form_error('plantel_idplantel') ?></label>
            <input type="text" class="form-control" name="plantel_idplantel" id="plantel_idplantel" placeholder="Plantel Idplantel" value="<?php echo $plantel_idplantel; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nombre <?php echo form_error('nombre') ?></label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>" />
        </div>
	    <input type="hidden" name="idarea" value="<?php echo $idarea; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('area') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    