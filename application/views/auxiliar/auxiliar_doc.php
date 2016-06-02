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
        <h2>Auxiliar </h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Descripcion</th>
		<th>Cargos Idcargos</th>
		
            </tr><?php
            foreach ($auxiliar_data as $auxiliar)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $auxiliar->descripcion ?></td>
		      <td><?php echo $auxiliar->cargos_idcargos ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>