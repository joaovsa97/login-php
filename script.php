<?php

session_start();
require("dbcon.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendemail_verify($username,$email,$verify_token){

    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth   = true; 
                                      //Enable SMTP authentication
    $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
    $mail->Username   = 'myemail@outlook.com';                     //SMTP username
    $mail->Password   = 'password';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('joaovsatestes@outlook.com', $username);
    $mail->addAddress($email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'E-mail verification from FbTech_';
    $mail->Body    =    "<h2>Please, click in the following link to verify your account</h2>
                        <a href='http://localhost/login-php/verify-email.php?token=$verify_token'>Verify my account<a/>"
                        ;
    $mail->AltBody = "Please, click in the following link to verify your account. http://localhost/login-php/$verify_token";

    $mail->send();
    // echo 'Message has been sent';
}

if(isset($_POST['register_btn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pw = $_POST['pw'];
    $confpw = $_POST['confpw'];
    $verify_token = md5(rand());

    // check if e-mail already exist
    $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($conn, $check_email_query);
    
    if(mysqli_num_rows($check_email_query_run) > 0)
    {
        $_SESSION['status'] = "E-mail Address Already Registered. Please Register Another E-mail Address";
        header("location: register.php");
    } else if($pw != $confpw){
        $_SESSION['status'] = "Password and Confirm Password not match. Please type again";
        header("location: register.php");
    } else {
        //Resgister user information
        $query = "INSERT INTO users (username, email, password, verify_token) VALUES ('$username','$email','$pw', '$verify_token')";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            sendemail_verify("$username","$email","$verify_token");
            $_SESSION['status'] = "Registration Successfully. Please Check Your E-mail Box to Validate Your E-mail Address";
            header("location: register.php");
        } else {
            $_SESSION['status'] = "Registration Failed. Try Again in one minute";
            header("location: register.php");
        }
    }
}

?>
