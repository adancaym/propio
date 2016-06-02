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
        <h2>Submenu </h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Descripcion</th>
		<th>Menu Idmenu</th>
		
            </tr><?php
            foreach ($submenu_data as $submenu)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $submenu->descripcion ?></td>
		      <td><?php echo $submenu->menu_idmenu ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>