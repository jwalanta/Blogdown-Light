<!DOCTYPE html>
<html>
<head>
    <title>Editor</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="css/editor.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/prettify.css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic' rel='stylesheet' type='text/css'>    

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/Markdown.Converter.js"></script>
    <script type="text/javascript" src="js/Markdown.Sanitizer.js"></script>
    <script type="text/javascript" src="js/Markdown.Editor.js"></script>
    <script type="text/javascript" src="js/Markdown.Extra.js"></script>
    <script type="text/javascript" src="js/jquery.ui.widget.js"></script>

    <script type="text/javascript" src="js/jquery.fileupload.js"></script>
    <script type="text/javascript" src="js/jquery.fileupload-process.js"></script>

<script type="text/javascript">
$.fn.extend({
  insertAtCaret: function(myValue){
  var obj;
  if( typeof this[0].name !='undefined' ) obj = this[0];
  else obj = this;

  if (document.selection) {
          obj.focus();
          sel = document.selection.createRange();
          sel.text = myValue;
          obj.focus();
  }
  else if (obj.selectionStart || obj.selectionStart == '0') {
      var startPos = obj.selectionStart;
      var endPos = obj.selectionEnd;
      var scrollTop = obj.scrollTop;
      obj.value = obj.value.substring(0, startPos)+myValue+obj.value.substring(endPos,obj.value.length);
      obj.focus();
      obj.selectionStart = startPos + myValue.length;
      obj.selectionEnd = startPos + myValue.length;
      obj.scrollTop = scrollTop;
  } else {
      obj.value += myValue;
      obj.focus();
  }
 }
});
</script>

    <style>
        h1,h2,h3,h4,h5,h6{font-weight:normal;color:#111;line-height:1.2em;text-transform: none;}
        h4,h5,h6{ font-weight: bold; }
        h1{ font-size:2.5em; font-weight: bold;}
        h2{ font-size:2em; }
        h3{ font-size:1.5em; }
        h4{ font-size:1.2em; }
        h5{ font-size:1em; }
        h6{ font-size:0.9em; }

        .button {
          font-size: 12px; 
          text-decoration: none!important; 
          font-family: Helvetica, Arial, sans serif;
          padding: 4px 8px; 
          border-radius: 3px; 
          -moz-border-radius: 3px; 
          box-shadow: inset 0px 0px 2px #fff;
          -o-box-shadow: inset 0px 0px 2px #fff;
          -webkit-box-shadow: inset 0px 0px 2px #fff;
          -moz-box-shadow: inset 0px 0px 2px #fff;
        }
        .button:active {
          box-shadow: inset 0px 0px 3px #999;
          -o-box-shadow: inset 0px 0px 3px #999;
          -webkit-box-shadow: inset 0px 0px 3px #999;
          -moz-box-shadow: inset 0px 0px 3px #999;
        }

        /* The styles for the grey button */
        .grey {
          color: #444;
          border: 1px solid #d0d0d0;
          background-image: -moz-linear-gradient(#ededed, #e1e1e1);
          background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#e1e1e1), to(#ededed));
          background-image: -webkit-linear-gradient(#ededed, #e1e1e1);
          background-image: -o-linear-gradient(#ededed, #e1e1e1);
          text-shadow: 1px 1px 1px #fff;
          background-color: #e1e1e1;
        }
        .grey:hover {
          border: 1px solid #b0b0b0;
          background-image: -moz-linear-gradient(#e1e1e1, #ededed);
          background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#ededed), to(#e1e1e1));
          background-image: -webkit-linear-gradient(#e1e1e1, #ededed);
          background-image: -o-linear-gradient(#e1e1e1, #ededed);
          background-color: #ededed;
        }
        .grey:active {border: 1px solid #666;}        
    </style>
</head>
<body>

<div id="editor-bar">
    <div class="editor-bar-content">
        <input type="text" id="filename" name="filename" size="100" />
        <input type="button" id="filename-autogenerate" value="Auto Generate" class="button grey" />
        <input type="button" id="file-save" value="Save" class="button grey" style="float:right;" />
    </div>
</div>

<div id="editor-preview">

<div class="wmd-panel">
  <div id="wmd-image-upload-status" style="float:right; padding-top: 5px;"></div>
	<div id="wmd-button-bar"></div>
	<textarea class="wmd-input" id="wmd-input"></textarea>
</div>

<div id="wmd-preview" class="wmd-panel wmd-preview"></div>

<div style="clear:both"></div>
<div id="files"></div>
</div>


</body>

<script type="text/javascript">

(function () {

    var converter = Markdown.getSanitizingConverter();
    Markdown.Extra.init(converter, {
      extensions: "all"
    });

    var editor = new Markdown.Editor(converter);
    editor.run();

		$('#wmd-input').on('scroll', function(){
			var other = $('#wmd-preview').get(0);
			var percentage = this.scrollTop / (this.scrollHeight - this.offsetHeight);
			other.scrollTop = percentage * (other.scrollHeight - other.offsetHeight);
		});


		var resizeEditor = function(){
			$(".wmd-input,.wmd-preview").height($(window).height()-90);
		};

		resizeEditor();

		$(window).resize(resizeEditor);

    var url = "uploadprocess.php";
    $('#wmd-input').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            $('#wmd-image-upload-status').text("Uploading file..");
        });
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
              var imageUrl = file.url;
              // make the path relative if possible
              imageUrl = imageUrl.replace("http://" + window.location.host, "");
              imageUrl = imageUrl.replace("https://" + window.location.host, "");

              var markdown = "![](" + imageUrl + ")";
              $('#wmd-input').insertAtCaret(markdown);
              $('#wmd-image-upload-status').text("Success").fadeOut(3000).text("").fadeIn();
              editor.refreshPreview();
            } else if (file.error) {
              console.log(file.error)
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index, file) {
          console.log('File upload fail!')
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
    
})();



</script>


</html>