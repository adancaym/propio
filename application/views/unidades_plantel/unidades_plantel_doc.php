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
        <h2>Unidades_plantel </h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Area</th>
		<th>Plantel Cct</th>
		<th>Area</th>
		<th>Contacto Correo</th>
		
            </tr><?php
            foreach ($unidades_plantel_data as $unidades_plantel)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $unidades_plantel->id_Area ?></td>
		      <td><?php echo $unidades_plantel->plantel_cct ?></td>
		      <td><?php echo $unidades_plantel->Area ?></td>
		      <td><?php echo $unidades_plantel->contacto_correo ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>