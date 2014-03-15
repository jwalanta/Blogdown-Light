<?php
/*
 * jQuery File Upload Plugin PHP Example 5.14
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');

// read config file for app url
require('../app/includes/dispatch.php');
config('source', '../app/config.ini');

$options = array(
	'upload_dir' => '../public/images/',
	'upload_url' => config('site.url') . 'public/images/',
	'image_versions' => array()
	);
$upload_handler = new UploadHandler($options);
