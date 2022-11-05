<?php
// Google reCAPTCHA API keys settings
$siteKey 	= '6LcXb2EgAAAAAEoSJJyUaFG3_xZ9mwSeK4u40dMe';
$secretKey 	= '6LcXb2EgAAAAAEmVJ0TkrJsq2j64ua5xx6QvgkgI';

// Email settings
$recipientEmail = 'contact@themenesia.com';


// If the form is submitted
$postData = $statusMsg = '';
$status = 'error';
if(isset($_POST['submit'])){
	$postData = $_POST;
	
	// Validate form input fields
	if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])){
		
		// Validate reCAPTCHA checkbox
		if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){

			// Verify the reCAPTCHA API response
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']);
			
			// Decode JSON data of API response
			$responseData = json_decode($verifyResponse);
			
			// If the reCAPTCHA API response is valid
			if($responseData->success){
				// Retrieve value from the form input fields
				$name = !empty($_POST['name'])?$_POST['name']:'';
				$email = !empty($_POST['email'])?$_POST['email']:'';
				$message = !empty($_POST['message'])?$_POST['message']:'';
				
				// Send email notification to the site admin
				$to = $recipientEmail;
				$subject = 'New Contact Request Submitted';
				$htmlContent = "
					<h4>Contact request details</h4>
					<p><b>Name: </b>".$name."</p>
					<p><b>Email: </b>".$email."</p>
					<p><b>Message: </b>".$message."</p>
				";
				
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				// More headers
				$headers .= 'From:'.$name.' <'.$email.'>' . "\r\n";
				
				// Send email
				@mail($to, $subject, $htmlContent, $headers);
				
				$status = 'success';
				$statusMsg = 'Thank you! Your contact request has been submitted successfully.';
				$postData = '';
			}else{
				$statusMsg = 'Robot verification failed, please try again.';
			}
		}else{
			$statusMsg = 'Please check the reCAPTCHA checkbox.';
		}
	}else{
		$statusMsg = 'Please fill all the mandatory fields.';
	}
}
?>