<!DOCTYPE HTML>
<!--
/*
 * Remote File Copy Demo 1.0
 *
 * Copyright 2012, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
-->
<html lang="en">
<head>
<meta charset="utf-8">
<title>Remote File Copy Demo</title>
<meta name="viewport" content="width=device-width">
<!-- Bootstrap CSS Toolkit styles -->
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<!-- Bootstrap styles for responsive website layout, supporting different screen sizes -->
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-responsive.min.css">
<!-- Bootstrap CSS fixes for IE6 -->
<!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
<!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1>Remote File Copy Demo</h1>
    </div>
    <form class="form-inline" id="remote-file-copy">
        <div>
            <input type="text" class="input-xlarge" placeholder="URL">
            <button type="submit" class="btn btn-primary">
                <i class="icon-upload icon-white"></i>
                <span>Start</span>
            </button>
        </div>
        <br>
        <div class="progress progress-success progress-striped">
            <div class="bar" style="width:0%;"></div>
        </div>
        <ul class="files"></ul>
    </form>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
var progressbar = $('#remote-file-copy .progress .bar'),
    list = $('#remote-file-copy .files'),
    callback = function (message) {
    $.each(message, function (key, value) {
        switch (key) {
            case 'send':
                progressbar.addClass('active');
                break;
            case 'progress':
                progressbar.css('width', parseInt(value.loaded / value.total * 100, 10) + '%');
                break;
            case 'done':
                progressbar.removeClass('active');
                $('<li>').text(value.name).appendTo(list);
                break;
        }
    });
};
$('#remote-file-copy').on('submit', function (e) {
    e.preventDefault();
    var url = $(this).find('input').val(),
        iframe = $('<iframe src="javascript:false;" style="display:none;"></iframe>');
    if (url) {
        iframe
            .prop('src', 'remote-file-copy.php?url=' + encodeURIComponent(url))
            .appendTo(document.body);
    }
});
</script>
</body> 
</html>
