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
        <h2>Cursos </h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nombre</th>
		<th>Duracion</th>
		<th>Especialidades Idespecialidades</th>
		<th>Clv Curso</th>
		<th>Ficha Tecnica</th>
		
            </tr><?php
            foreach ($cursos_data as $cursos)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $cursos->nombre ?></td>
		      <td><?php echo $cursos->duracion ?></td>
		      <td><?php echo $cursos->especialidades_idespecialidades ?></td>
		      <td><?php echo $cursos->clv_curso ?></td>
		      <td><?php echo $cursos->ficha_tecnica ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>