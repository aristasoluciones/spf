<?php

//require_once(DOC_ROOT."/phpmailer/class.phpmailer.php");
class SendMail extends Main
{
		
	public function Prepare($subject, $body, $to, $toName, $attachment = "", $fileName = "", $attachment2 = "", $fileName2 = "", $from = "admin@avantikdads.com", $fromName = "Administrador del Sistema") 
	{
			$mail = new PHPMailer(); // defaults to using php "mail()"
			
			$mail->AddReplyTo($from, $fromName);
			$mail->SetFrom($from, $fromName);
			
			$mail->AddAddress($to, $toName);
			$mail->Subject    = $subject;
			$mail->MsgHTML($body);

			if($attachment != "")
			{
				$mail->AddAttachment($attachment, $fileName);
			}

			if($attachment2 != "")
			{
				$mail->AddAttachment($attachment2, $fileName2);
			}
			$mail->Send();
	}

}


?>