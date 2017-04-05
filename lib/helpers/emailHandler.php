<?php 

defined("BASEURL") or die("Direct access denied");
/**
* Multi-purpose email sender
* $to -> email of the receiver.
* $subject -> message header.
* $message -> message body.
* $mailPurpose -> reason for the email
* $output -> message displayed to user on success default is NULL
* 	@example eMailer::auralzMailer("email@site.com", "subject", "message", "do-not-reply", "sent!", "error if not sent");
*
* $url -> link to the image 
*	@example eMailer::auralzMailerImg(public/graphic/images/imageName.php);
**/
class eMailer 
{
	private function __construct() {}
	private function __clone() {}

	public static function auralzMailer($to, $subject, $messages, $mailPurpose, $output = FALSE, $error = FALSE) {
		
		// To send HTML mail, the Content-type header must be set
		$header  = 'MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header .= 'From: '.APP_NAME.' <'. $mailPurpose .'@'.APP_NAME.'.com>';

		if(!mail($to, $subject, $messages, $header)) {
			die($error);
		}
		else echo $output;
	}

	public static function auralzMailerImg($url) {
		return URL . "/" . $url;
	}
}
?>