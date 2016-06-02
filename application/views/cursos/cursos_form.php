
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Cursos </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nombre <?php echo form_error('nombre') ?></label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Duracion <?php echo form_error('duracion') ?></label>
            <input type="text" class="form-control" name="duracion" id="duracion" placeholder="Duracion" value="<?php echo $duracion; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Especialidades Idespecialidades <?php echo form_error('especialidades_idespecialidades') ?></label>
            <input type="text" class="form-control" name="especialidades_idespecialidades" id="especialidades_idespecialidades" placeholder="Especialidades Idespecialidades" value="<?php echo $especialidades_idespecialidades; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Clv Curso <?php echo form_error('clv_curso') ?></label>
            <input type="text" class="form-control" name="clv_curso" id="clv_curso" placeholder="Clv Curso" value="<?php echo $clv_curso; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ficha Tecnica <?php echo form_error('ficha_tecnica') ?></label>
            <input type="text" class="form-control" name="ficha_tecnica" id="ficha_tecnica" placeholder="Ficha Tecnica" value="<?php echo $ficha_tecnica; ?>" />
        </div>
	    <input type="hidden" name="idcursos" value="<?php echo $idcursos; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('cursos') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    