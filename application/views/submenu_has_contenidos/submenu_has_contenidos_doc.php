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
        <h2>Submenu_has_contenidos </h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Submenu Idsubmenu</th>
		<th>Contenidos Idcontenidos</th>
		
            </tr><?php
            foreach ($submenu_has_contenidos_data as $submenu_has_contenidos)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $submenu_has_contenidos->submenu_idsubmenu ?></td>
		      <td><?php echo $submenu_has_contenidos->contenidos_idcontenidos ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>