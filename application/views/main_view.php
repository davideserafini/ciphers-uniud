<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{page_title}</title>
	
	<link rel="stylesheet" type="text/css" href="<?php css_file('main'); ?>" />
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="<?php echo js_file('jquery-1.7.1.min'); ?>"></script>
	<script src="<?php echo js_file('InputValidation'); ?>"></script>
	<script src="<?php echo js_file('Ciphers'); ?>"></script>
	<script src="<?php echo js_file('Forms'); ?>"></script>
	<script src="<?php echo js_file('expand'); ?>"></script>
</head>
<body>

<div id="wrapper">
	<div id="left_sidebar">
		<div id="header">
			<h1>
				<a href="/">ciphers</a>
				<!--<div class="shine_background"></div>-->
			</h1>
		</div>
		{page_left_menu}
		{page_footer}
	</div>

	<div id="content_wrapper">
		{page_content}
	</div>
</div>

</body>
</html>