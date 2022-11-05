<?php
// Form submission script
include_once 'submit.php';
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Integrate Google reCAPTCHA Checkbox with PHP by CodexWorld</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Stylesheet file -->
<link rel="stylesheet" href="css/style.css" />

<!-- Google recaptcha API library -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<div class="container">
	<h1>Contact Form with Google reCAPTCHA</h1>
	<div class="cw-frm">
		<form action="" method="post">
			<h3>Contact Form</h3>
	   
			<!-- Status message -->
			<?php if(!empty($statusMsg)){ ?>
				<p class="status-msg <?php echo $status; ?>"><?php echo $statusMsg; ?></p>
			<?php } ?>
	  
			<!-- Form fields -->
			<div class="input-group">
				<input type="text" name="name" value="<?php echo !empty($postData['name'])?$postData['name']:''; ?>" placeholder="Your name" required="" />
			</div>
			<div class="input-group">	
				<input type="email" name="email" value="<?php echo !empty($postData['email'])?$postData['email']:''; ?>" placeholder="Your email" required="" />
			</div>
			<div class="input-group">
				<textarea name="message" placeholder="Type message..." required="" ><?php echo !empty($postData['message'])?$postData['message']:''; ?></textarea>
			</div>
				
			<!-- Google reCAPTCHA box -->
			<div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
			
			<!-- Submit button -->
			<input type="submit" name="submit" value="SUBMIT">
		</form>
	</div>

	<div class="footer">
		<p>
			&copy; 2019 CodexWorld.com . All Rights Reserved | Design by
			<a href="https://www.codexworld.com/" target="_blank">CodexWorld</a>
		</p>
	</div>
</div>
</body>
</html>