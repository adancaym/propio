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
        <h2>Contacto </h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Correo</th>
		<th>Telefono</th>
		<th>Ext</th>
		<th>Cargos Idcargos</th>
		
            </tr><?php
            foreach ($contacto_data as $contacto)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $contacto->correo ?></td>
		      <td><?php echo $contacto->telefono ?></td>
		      <td><?php echo $contacto->ext ?></td>
		      <td><?php echo $contacto->cargos_idcargos ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>