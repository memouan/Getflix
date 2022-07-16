<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './config.php';

if (isset($_POST['email'])) {

        $emailTo = $_POST['email'];

        $code = uniqid(true);

        $sql = 'INSERT INTO resetpasswords (code, email) VALUES ( :code, :email)';

        $stmtinsert = $db->prepare($sql);

        $result = $stmtinsert->execute([

        ':code' => $code,

        ':email' => $emailTo

        ]);

        if ($result) {

        echo "Code inserted successfully.";
        } else {

        echo "Error creating user.";
}

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'omarmaad90@gmail.com';                     //SMTP username
        $mail->Password   = 'rkiyrndjxtehkfgk';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('omarmaad90@gmail.com', 'Brosios');
        $mail->addAddress($emailTo);     //Add a recipient
        $mail->addReplyTo('no-reply@gmail.com', 'No Reply');


        //Content
        $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/resetPassword.php?code=$code . &email=$emailTo'";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Your password reset link';
        $mail->Body    = "<h1>You've requested a password reset!</h1>
                                        Click <a href=' $url '>This Link</a> to reset your password.";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Reset Password Link has been sent to your email';
        } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
exit();
}

?>

<form method="POST">
    <input type="text" name="email" placeholder="Enter your Email" autocomplete="off">
    <br>
    <input type="submit" name="submit" value="reset email">
</form>