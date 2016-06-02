<!-- Login -->
<form action="<?php echo base_url('login/login') ?>" method="post">
	<div class="form-group">
		<label for="" class="control-label">
			Usuario
		</label>
		<input type="text" class="form-control" name="usuario" />
	</div>
	<div class="form-group">
		<label for="" class="control-label">
			Contraseña
		</label>
		<input type="password" class="form-control" name="contra" />
	</div>
	<div class="form-grup">
		<input type="submit" class="form-control btn btn-primary" value="Login" />
	</div>
</form>
