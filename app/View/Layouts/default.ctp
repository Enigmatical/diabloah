<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>DiabloAH</title>
	<?php echo $this->Html->charset(); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="/img/d3_small.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="/img/d3_medium.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="/img/d3_big.png" />
	<link href='http://fonts.googleapis.com/css?family=Alegreya+SC:400,700' rel='stylesheet' type='text/css' />
	<?php
		echo $this->Html->css( array(
			'jquery/jquery.mobile-1.1.0.min.css',
			'jquery/diabloah.min.css',
			'global.css'
		) );
	
		echo $this->Html->script( array(
			'jquery/jquery-1.7.2.min.js',
			'jquery/jquery.mobile-1.1.0.min.js',
			'global.js'
		) );

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
	<script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-32695189-1']);
		_gaq.push(['_setDomainName', 'developingwithdavis.com']);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();

	</script>

	<?php if ($current_user): ?>
		<script type="text/javascript">
			$.current_user = {};
			$.current_user.id = <?php echo $current_user; ?>;
		</script>
	<?php endif; ?>
</head>
<body>
	<div data-role="page">
		<div data-role="header">
			<?php echo $this->fetch('header'); ?>
		</div>
		<div data-role="content">
			<?php /*
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth'); ?>
			*/ ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
</body>
</html>
