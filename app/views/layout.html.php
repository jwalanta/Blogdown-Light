<!DOCTYPE html>
<html>
<head>
	<title><?php echo isset($title) ? _h($title) : config('blog.title') ?></title>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" user-scalable="no" />
	<meta name="description" content="<?php echo config('blog.description')?>" />

	<link rel="shortcut icon" type="image/png" href="<?php echo site_url() ?>assets/enso.jpg"/>
	<link rel="alternate" type="application/rss+xml" title="<?php echo config('blog.title')?>  Feed" href="<?php echo site_url()?>rss" />

	<link href="<?php echo site_url() ?>assets/css/style.css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?skin=desert"></script>


	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>
<body>

	<aside>

		<p><img src="<?php echo site_url() ?>assets/enso.jpg" /><br /><br /></p>

		<h1><a href="<?php echo site_url() ?>"><?php echo config('blog.title') ?></a></h1>

		<p class="description"><?php echo config('blog.description')?></p>
		<!-- the sidebar-->
		<ul>
			<li><a href="<?php echo site_url() ?>">Home</a></li>
			<li><a href="<?php echo site_url() ?>">About Me</a></li>
			<li><a href="<?php echo site_url() ?>">Projects</a></li>
			<li><a href="https://twitter.com/jwalanta">@jwalanta</a></li>
		</ul>
		<!-- End custom sidebar-->

	</aside>

	<section id="content">

		<?php echo content()?>

		<p class="footer">
			<?php echo config('blog.footer') ?></p>

	</section>

</body>
</html>