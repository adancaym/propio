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
        <h2>Especialidades </h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nombre</th>
		<th>Area Idarea</th>
		<th>Clv Esp</th>
		
            </tr><?php
            foreach ($especialidades_data as $especialidades)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $especialidades->nombre ?></td>
		      <td><?php echo $especialidades->area_idarea ?></td>
		      <td><?php echo $especialidades->clv_esp ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>