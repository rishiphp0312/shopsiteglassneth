<?
// Calling SendHtmlMail function to send mail.
ini_set('SMTP','mail.seologistics.com');
ini_set('smtp_port',25);
        
class SendEmailClass {
	var $emailId;
	var $subject;
	var $mailBody;
	var $from;
	var $headers;
	var $message;
/*
 * simple Text mail format
 *  
 */
	function SendEmail($emailId, $subject, $mailBody, $from) {
		if (@mail($emailId, $subject, $mailBody, "From: $from\n")) {
			return true;
		} else {
			return false;
		}

	}
/*to send the email
 *  
 * 	in HTML format	
*/	
	function SendHtmlMail($emailId, $subject, $message, $from) {
		$headers="MIME-Version: 1.0\n" .
		"Content-Transfer-Encoding: 8bit\n" .
		"Content-type: text/html; charset='iso-8859-1'\n" .
	 	"Return-Path: <mail.seologistics.com>\n" .
		"From: ".$from."\n";
			if (@mail($emailId, $subject, $message, $headers)){
				return true;
			} 	else {
					return false;
				}
	}
}
?>
