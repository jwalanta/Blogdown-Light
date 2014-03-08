<!DOCTYPE html>
<html>
<head>
	<title><?php echo isset($title) ? _h($title) : config('blog.title') ?></title>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" user-scalable="no" />
	<meta name="description" content="<?php echo config('blog.description')?>" />

	<link rel="alternate" type="application/rss+xml" title="<?php echo config('blog.title')?>  Feed" href="<?php echo site_url()?>rss" />

	<link href="<?php echo site_url() ?>assets/css/style.css" rel="stylesheet" />
	<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?skin=desert"></script>

	<link href='http://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700&subset=latin,cyrillic-ext" rel="stylesheet" />

	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>
<body>

	<aside>

		<h1><a href="<?php echo site_url() ?>"><?php echo config('blog.title') ?></a></h1>

		<p class="description"><?php echo config('blog.description')?></p>
		<!-- the sidebar-->
		<ul>
			<li><a href="<?php echo site_url() ?>">Home</a></li>
			<li><a href="https://github.com/SiteOctopus/Light-Blog/zipball/master">Zip download</a></li>
			<li><a href="https://github.com/SiteOctopus/Light-Blog/tarball/master">tar.gz download</a></li>
			<li><a href="https://github.com/SiteOctopus/Light-Blog">Github Page</a></li>
			<li><a href="http://siteoctopus.github.com/Light-Blog/">Our Site</a></li>
		</ul>
		<!-- End custom sidebar-->
		<p class="author"><?php echo config('blog.authorbio') ?></p>

	</aside>

	<section id="content">

		<?php echo content()?>

	</section>

</body>
</html>