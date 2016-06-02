
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Submenu </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Descripcion <?php echo form_error('descripcion') ?></label>
            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" value="<?php echo $descripcion; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Menu Idmenu <?php echo form_error('menu_idmenu') ?></label>
            <input type="text" class="form-control" name="menu_idmenu" id="menu_idmenu" placeholder="Menu Idmenu" value="<?php echo $menu_idmenu; ?>" />
        </div>
	    <input type="hidden" name="idsubmenu" value="<?php echo $idsubmenu; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('submenu') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    