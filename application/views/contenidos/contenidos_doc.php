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
        <h2>Contenidos </h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Titulo</th>
		<th>Contenido</th>
		<th>Auxiliar Idauxiliar</th>
		
            </tr><?php
            foreach ($contenidos_data as $contenidos)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $contenidos->titulo ?></td>
		      <td><?php echo $contenidos->contenido ?></td>
		      <td><?php echo $contenidos->auxiliar_idauxiliar ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>