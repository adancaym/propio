
<div  class="col-md-8 top-bufer bottom-buffer">

        <h2>Personas </h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nombre <?php echo form_error('nombre') ?></label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Apellido Paterno <?php echo form_error('apellido_paterno') ?></label>
            <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido Paterno" value="<?php echo $apellido_paterno; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Apellido Materno <?php echo form_error('apellido_materno') ?></label>
            <input type="text" class="form-control" name="apellido_materno" id="apellido_materno" placeholder="Apellido Materno" value="<?php echo $apellido_materno; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Contacto Correo <?php echo form_error('contacto_correo') ?></label>
            <input type="text" class="form-control" name="contacto_correo" id="contacto_correo" placeholder="Contacto Correo" value="<?php echo $contacto_correo; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Titulo Academico Idtitulo Academico <?php echo form_error('titulo_academico_idtitulo_academico') ?></label>
            <input type="text" class="form-control" name="titulo_academico_idtitulo_academico" id="titulo_academico_idtitulo_academico" placeholder="Titulo Academico Idtitulo Academico" value="<?php echo $titulo_academico_idtitulo_academico; ?>" />
        </div>
	    <input type="hidden" name="idpersonas" value="<?php echo $idpersonas; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('personas') ?>" class="btn btn-default">Cancel</a>
	</form></div>
    