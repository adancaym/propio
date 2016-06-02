<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<script type="text/javascript" src = "<?php echo base_url('ckeditor/ckeditor.js')?>" >
</script>
</head>
<body>
<div id="container">
	<form method="post" action="<?php echo base_url('index.php/Prueba') ?>" >
		<textarea id="editor1" name="editor1"></textarea>
			<script type="text/javascript">
				CKEDITOR.replace( 'editor1' );
			</script>
			<input type="submit" />
	</form>
</div>



</body>
</html>