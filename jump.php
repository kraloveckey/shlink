<?php
  	// Initial class
	require_once('inc/require.php');

	// Redirects
  	if(isset($_GET['id'])) {
    	$url_c = new url();
    	// Get target URL
    	$url = $url_c->get_url($_GET['id'],true);
		// Redirect to target URL
		if(!(
			stripos($url,"HTTP://") === 0 ||
			stripos($url,"HTTPS://") === 0 ||
			stripos($url,"//") === 0) && $url)
			$url = "http://".$url;
    	if($url) {
      		header('Location: ' . $url);
      		exit;
    	}
    	echo "Link not found, may be expired，<a href='".get_uri()."'>Click to return to the homepage</a>";
  	}
?>