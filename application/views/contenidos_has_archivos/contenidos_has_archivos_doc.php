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
        <h2>Contenidos_has_archivos </h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Contenidos Idcontenidos</th>
		<th>Archivos Idarchivos</th>
		
            </tr><?php
            foreach ($contenidos_has_archivos_data as $contenidos_has_archivos)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $contenidos_has_archivos->contenidos_idcontenidos ?></td>
		      <td><?php echo $contenidos_has_archivos->archivos_idarchivos ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>