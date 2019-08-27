<!DOCTYPE html>
<!-- taken from WMF: https://goo.gl/TFaF97 -->
<html lang=en>
<meta charset="utf-8">
<title>DroidWiki Error</title>
<link rel="shortcut icon" href="https://www.droidwiki.org/static/images/favicons/favicon.ico">
<style>
* { margin: 0; padding: 0; }
div.body { background: #fff; margin: 7% auto 0; padding: 2em 1em 1em; font: 14px/21px sans-serif; color: #333; max-width: 560px; }
img { float: left; margin: 0 2em 2em 0; }
a img { border: 0; }
h1 { margin-top: 1em; font-size: 1.2em; }
p { margin: 0.7em 0 1em 0; }
a { color: #0645AD; text-decoration: none; }
a:hover { text-decoration: underline; }
em { font-style: normal; color: #777; }
div.footer { text-align: center; position: absolute; background: rgba(245, 245, 245, 1); width: 100%; bottom: 0; height: 10em; border-top: 1px solid lightgray; color: #777; }
</style>
<div class="body">
	<a href="https//www.droidwiki.org"><img src="https://www.droidwiki.org/static/images/project-logos/androide.png" alt=DroidWiki width=135 height=135></a>
	<h1>DroidWiki Error</h1>
	<p>Our servers are currently experiencing a technical problem. This is probably temporary and should be fixed soon. Please <a href="javascript:" onclick="window.location.reload(false); return false">try again</a> in a few minutes.<br><em>That’s all we know.</em></p>
</div>
<div class="footer">
	PHP fatal error<?php
	// Guard against "Cannot modify header information - headers already sent" warning
	if ( !headers_sent() ) {
		header( 'HTTP/1.1 500 Internal Server Error' );
	}
        $err = error_get_last();
        $message = $err['message'];
        # error_get_last() doesn't return a fully populated array in HHVM,
        # capture file and line manually
        if ( preg_match( '/#0\\s+(\\S+?)\\((\\d+)\\)/', $message, $matches ) ) {
		echo ' ' . htmlspecialchars( $matches[1] ) . ' line ' . $matches[2];
	}
	$parts = explode( "\n", $message );
	$message = $parts[0];
	$message = preg_replace( "/^.*?exception '.*?' with message '(.*?)'.*$/im", '\1', $message );
        ?>: <br/>
        <?php echo htmlspecialchars( $message ); ?>
</div>
</html>
