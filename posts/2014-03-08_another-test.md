# (GitHub-Flavored) Markdown Editor

Basic useful feature list:

 * Ctrl/Cmd + S to save the file
 * Drag and drop a file into here to load it
 * File contents are saved in the URL so you can share files


I'm no good at writing sample / filler text, so go write something yourself.

Look, a list!

 * foo
 * bar
 * baz

And here's some code!

```javascript
$(function(){
  $('div').html('I am a div.');
});
```

Now some php code:

```php
function get_posts($page = 1, $perpage = 0){

	if($perpage == 0){
		$perpage = config('posts.perpage');
	}

	$posts = get_post_names();

	// Extract a specific page with results
	$posts = array_slice($posts, ($page-1) * $perpage, $perpage);

	$tmp = array();

	foreach($posts as $k=>$v){

		$post = new stdClass;

		// Extract the date
		$arr = explode('_', $v);
		$post->date = @strtotime(str_replace('posts/','',$arr[0]));

		// The post URL
		$post->url = site_url().@date('Y/m', $post->date).'/'.str_replace('.md','',$arr[1]);

		// Get the contents and convert it to HTML
		$content = Parsedown::instance()->parse(file_get_contents($v));
		$content = str_replace("<pre>", "<pre class='prettyprint'>", $content);

		// Extract the title and body
		$arr = explode('</h1>', $content);
		$post->title = str_replace('<h1>','',$arr[0]);
		$post->body = $arr[1];

		$tmp[] = $post;
	}

	return $tmp;
}
```

This is [on GitHub](https://github.com/jbt/markdown-editor) so let me know if I've b0rked it somewhere.


Props to Mr. Doob and his [code editor](http://mrdoob.com/projects/code-editor/), from which
the inspiration to this, and some handy implementation hints, came.

### Stuff used to make this:

 * [marked](https://github.com/chjj) for Markdown parsing
 * [CodeMirror](http://codemirror.net/) for the awesome syntax-highlighted editor
 * [highlight.js](http://softwaremaniacs.org/soft/highlight/en/) for syntax highlighting in output code blocks
 * [js-deflate](https://github.com/dankogai/js-deflate) for gzipping of data to make it fit in URLs
