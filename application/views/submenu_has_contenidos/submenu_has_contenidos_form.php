
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Submenu_has_contenidos </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Submenu Idsubmenu <?php echo form_error('submenu_idsubmenu') ?></label>
            <input type="text" class="form-control" name="submenu_idsubmenu" id="submenu_idsubmenu" placeholder="Submenu Idsubmenu" value="<?php echo $submenu_idsubmenu; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Contenidos Idcontenidos <?php echo form_error('contenidos_idcontenidos') ?></label>
            <input type="text" class="form-control" name="contenidos_idcontenidos" id="contenidos_idcontenidos" placeholder="Contenidos Idcontenidos" value="<?php echo $contenidos_idcontenidos; ?>" />
        </div>
	    <input type="hidden" name="submenu_has_contenidos" value="<?php echo $submenu_has_contenidos; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('submenu_has_contenidos') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    