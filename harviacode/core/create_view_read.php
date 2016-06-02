<?php 

$string = "
<div class=\"col-md-8 top-bufer bottom-buffer\">

        <h2 >".ucfirst($table_name)." </h2>
        <table class=\"table\">";
foreach ($non_pk as $row) {
    $string .= "\n\t    <tr><td>".label($row["column_name"])."</td><td><?php echo $".$row["column_name"]."; ?></td></tr>";
}
$string .= "\n\t    <tr><td></td><td><a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-default\">Cancelar</a></td></tr>";
$string .= "\n\t</table> </div>
        ";



$hasil_view_read = createFile($string, $target."views/" . $c_url . "/" . $v_read_file);

?>