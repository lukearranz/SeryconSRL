<?php
    use PHPMailer\PHPMailer\PHPMailer;


    if (isset($_POST['name']) && isset($_POST['email'])) {

        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];
        
        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;

        // Desde este mail salen los correos
        $mail->Username = "seryconwebpage@gmail.com"; //enter you email address
        $mail->Password = '####'; //enter you email password


        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email,$name);

        // A este mail llegan los correos
        $mail->addAddress("gestion@serycon.com.ar"); //enter you email address
        $mail->addAddress("seryconwebpage@gmail.com"); //enter you email address

        $mail->Subject = ("$email - ($subject)");
        $mail->Body = $body;

        if($mail->send()){
            exit('OK');
        }
        else
        {
            $status = "failed";
            $response = "Something is wrong: <br>" . $mail->ErrorInfo;
            exit(json_encode(array("status" => $status, "response" => $response)));
        }
    }
?>
