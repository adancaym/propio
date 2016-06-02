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
        <h2>Area </h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Plantel Idplantel</th>
		<th>Nombre</th>
		
            </tr><?php
            foreach ($area_data as $area)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $area->plantel_idplantel ?></td>
		      <td><?php echo $area->nombre ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>