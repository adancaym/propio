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
        <h2>Cargos </h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Descripcion</th>
		<th>Unidad Idunidad</th>
		<th>Correo</th>
		<th>Unidad</th>
		<th>Persona Idpersona</th>
		
            </tr><?php
            foreach ($cargos_data as $cargos)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $cargos->descripcion ?></td>
		      <td><?php echo $cargos->unidad_idunidad ?></td>
		      <td><?php echo $cargos->correo ?></td>
		      <td><?php echo $cargos->unidad ?></td>
		      <td><?php echo $cargos->persona_idpersona ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>