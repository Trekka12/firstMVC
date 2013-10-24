<!DOCTYPE html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="<?php echo $stylesheet; ?>">
</head>
<body>
	<div id="header">
		<?php echo $header; ?>
	</div>
	<div id="main" role="main">
		<?php echo $main; ?>
		<?php echo get_debug(); ?>
	</div>
	<div id="footer">
		<?php echo $footer; ?>
	</div>
</body>
</html>