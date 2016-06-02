<!doctype html>
<html>
    <head>
        <title>/title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Personas </h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nombre</th>
		<th>Apellido Paterno</th>
		<th>Apellido Materno</th>
		<th>Contacto Correo</th>
		<th>Titulo Academico Idtitulo Academico</th>
		
            </tr><?php
            foreach ($personas_data as $personas)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $personas->nombre ?></td>
		      <td><?php echo $personas->apellido_paterno ?></td>
		      <td><?php echo $personas->apellido_materno ?></td>
		      <td><?php echo $personas->contacto_correo ?></td>
		      <td><?php echo $personas->titulo_academico_idtitulo_academico ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>