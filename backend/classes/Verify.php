<?php

class Verify
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = Database::instance();
    }

    public static function generateLink()
    {
        return str_shuffle(substr(md5(time().mt_rand().time()), 0, 25));
    }

    public static function sendToMail($email, $message, $subject)
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPDebug = 0;
        $mail->Host = M_HOST;
        $mail->Username = M_USER;
        $mail->Password = M_PASSWORD;
        $mail->SMTPSecure = M_SMTPSECURE;
        $mail->Port = M_PORT;

        if (!empty($email)) {
            $mail->From="pancratwitter@gmail.com";
            $mail->FromName="PancraTwitter";
            $mail->addReplyTo('No-reply@gmail.com');
            $mail->addAddress($email);

            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = $message;

            if (!$mail->send()) {
                return false;
            } else {
                return true;
            }

        }
    }
}

?>