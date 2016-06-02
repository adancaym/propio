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
        <h2>Persona </h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Correo</th>
		<th>Nombre</th>
		<th>Paterno</th>
		<th>Materno</th>
		<th>Grado Escolar</th>
		
            </tr><?php
            foreach ($persona_data as $persona)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $persona->correo ?></td>
		      <td><?php echo $persona->Nombre ?></td>
		      <td><?php echo $persona->paterno ?></td>
		      <td><?php echo $persona->materno ?></td>
		      <td><?php echo $persona->grado_escolar ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>