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
        <h2>Plantel </h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Plantel</th>
		<th>Ubicacion</th>
		<th>Directivo Iddirectivo</th>
		<th>Estado Idestado</th>
		<th>Del Mun</th>
		<th>Colonia</th>
		<th>Calle Y Numero</th>
		
            </tr><?php
            foreach ($plantel_data as $plantel)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $plantel->Plantel ?></td>
		      <td><?php echo $plantel->Ubicacion ?></td>
		      <td><?php echo $plantel->directivo_iddirectivo ?></td>
		      <td><?php echo $plantel->estado_idestado ?></td>
		      <td><?php echo $plantel->del_mun ?></td>
		      <td><?php echo $plantel->Colonia ?></td>
		      <td><?php echo $plantel->Calle y Numero ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>