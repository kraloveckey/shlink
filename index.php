<?php
	// Configuration Files
	require_once('config.php');
	require_once('inc/functions.php');
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<!--Title-->
		<title><?php echo get_title(); ?></title>
		
		<!--Keyword placement (SEO optimization)-->
		<meta name="description" content="Short link Service">
		<meta name="keyword" content="short link,ShortLink,Link,Link shortening,short URL">
		<link rel="icon" href="asset/images/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="asset/images/favicon.ico" type="image/x-icon">
		
		<!--CSS files-->
		<link type="text/css" rel="stylesheet" href="asset/css/main.css">
        </head>
		<body>
			<div class="wrap">
				<!--Page Display Title-->
				<div class="meta">
					<a href="/" class="main-title-button">
						<img src="asset/images/logo.png" alt="logo" class="title-logo">
						<h2 class="title-text"><?php echo get_title(); ?></h2>
					</a>
					<h3 class="description"><br><?php echo get_description(); ?></h3>
				</div>
				<br><br>

			    <!--Link Display Area-->
				<div class="link-area">
					<input id="url" type="text" placeholder="Source URL" />
					<input id="submit" type="button" value="➡️ Submit" onclick="APP.fn.setUrl(this)" />
					<br><br>
					<input id="shorturl" type="text" placeholder="Short URL" readonly/>
					<input id="shorturlcopy" type="button" value="💾 Copy" onclick="copyText()" />
				</div>

				<div class="footer">
						🔗⏳ Short link after <?php echo get_expiry();?> days unvisited, could be recycled 🌞<br>
						<?php echo get_hoster();?> | <a href="https://github.com/kraloveckey/shlink/issues" target="_blank">Feedback Suggestions</a>
				</div>
			</div>

			<!--Embedded JS code-->
			<script>
				document.body.oncopy = function(event) {
					const shortUrlInput = document.getElementById('shorturl');
					const selectedText = window.getSelection().toString(); // Get the selected text
					// Check if the shorturl field exists and is active (focus or selection)
					// Or if the selected text matches the content of the shorturl field
					const isCopyingFromShortUrlField = (
						document.activeElement === shortUrlInput || // If the shorturl field is in focus
						(shortUrlInput && shortUrlInput.contains(window.getSelection().anchorNode)) || // If the selection starts in the field
						(shortUrlInput && selectedText.trim() === shortUrlInput.value.trim() && selectedText.length > 0) // If it is the content of the field that is copied
			    	);
			    	if (isCopyingFromShortUrlField) {
						// If copying from the shorturl field
						if (shortUrlInput.value.trim() === "") {
							// If the shorturl field is empty, show a warning
							Swal.fire({
								icon: 'warning',
								title: 'Short URL is empty ⚠️',
								text: 'Please create a link first!',
								showConfirmButton: false,
								timer: 3000,
								toast: true,
								position: 'top-end',
								showCloseButton: false
							});
							event.preventDefault(); // Prevent standard copying of an empty field
							return; // Stop execution
						} else {
							// If the shorturl field is not empty and copying from it, show success
							Swal.fire({
								icon: 'success',
								title: 'Copy success ☠️',
								showConfirmButton: false,
								timer: 3000,
								toast: true,
								position: 'top-end',
								showCloseButton: false,
								didOpen: (toast) => {
									toast.addEventListener('mouseenter', Swal.stopTimer);
									toast.addEventListener('mouseleave', Swal.resumeTimer);
								}
							});
							// Allow standard copying
						}
					}
					// If other text on the page is copied (not from the shorturl field),
					// the function is simply terminated and no notification is shown.
				};
			</script>

			<script>
				// This function will be called by APP.fn.setUrl() or similar logic
				// to display notifications.
				function showNotification(type, message, text_message) {
					Swal.fire({
						icon: type, // 'success', 'error', 'warning', 'info', 'question'
						title: message,
						text: text_message,
						showConfirmButton: false,
						timer: 3000,
						toast: true,
						position: 'top-end',
						showCloseButton: false,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer);
							toast.addEventListener('mouseleave', Swal.resumeTimer);
						}
					});
				}
			</script>

			<!--JS files-->
			<script type="text/javascript" src="asset/js/app.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@latest"></script>
		</body>
</html>