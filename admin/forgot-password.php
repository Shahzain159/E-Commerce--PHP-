<?php
$conn=mysqli_connect("localhost","root","","db_glamglow");
session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
if(isset($_POST["ResetPassword"])){
    $email=$_POST["email"];
    $token=rand(100000,999999);
    $_SESSION["token"]=$token;
    $query="SELECT * FROM admin WHERE admin_email='$email'";
    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)){
try {
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'umair.test.project@gmail.com';                     //SMTP username
    $mail->Password   = 'qplduqtkmtqcfbnh';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('umair.test.project@gmail.com', 'Mailer');
    $mail->addAddress($email, '');     //Add a recipient
    $mail->addReplyTo('umair.test.project@gmail.com', 'Information');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Password reset for Glam&Glow Admin';
    $mail->Body    = '<b>Verification Code</b><br><p>'.$token.'<p>';
    $mail->AltBody = 'Your Verification Code is '.$token;

    $mail->send();
    echo '<div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
      Verification code sent on registered email address.
    </div>
  </div>';
} catch (Exception $e) {
    header("location:forgot-password.php");
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
    }else{
        // echo'No user registered against this email';
        echo '
    <script>
        alert("No user registered with this email");
        window.location="forgot-password.php";
    </script>
  ';

    }
}
if(isset($_POST["setPass"])){
    $email=$_POST["email"];
    $pass=$_POST["password"];
    $checkpass=$_POST["checkpassword"];
    if(trim($pass)=='' || trim($checkpass)==''){
        echo "<script>alert('All fields are required!')</script>";
    } else if($pass != $checkpass){
        echo "<script>alert('Passwords do not match!')</script>";
    }else{
    $pass1=password_hash($pass,PASSWORD_BCRYPT);
    $query="UPDATE admin SET admin_password='$pass1' WHERE admin_email='$email';";
    mysqli_query($conn,$query);
        echo'
        <div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
                Password reset succuessful.
            </div>
        </div>';
    echo'<script>
    setTimeout(function(){
        window.location="login.php";
    },2000);
    </script>';
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>G&G Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <script src="./js/jquery.js"></script>

</head>

<body class="bg-gradient-dark">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg bg-light my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block"><img src="./img/forgot.jpg" width="500"></div>
                            <?php
                            if(isset($_POST["verifyCode"])){
                                $code=$_POST["VCode"];
                                $email=$_POST["email"];
                                $vcode=$_SESSION["token"];
                                if($vcode==$code){
                            echo'<div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Reset Your Password</h1>
                                    <p class="mb-4">Enter verification code recieved on your registered email</p>
                                </div>
                                <form class="user" method="post">
                                <input type="hidden" value="'.$email.'" name="email">
                                    <div class="form-group">
                                        <input type="password" id="password" class="form-control form-control-user" name="password" aria-describedby="emailHelp"
                                            placeholder="Set Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="checkpassword" class="form-control form-control-user"
                                            name="checkpassword" aria-describedby="emailHelp"
                                            placeholder="Confirm Password">
                                    </div>
                                    <div class="form-group">
                                    <input type="submit" name="setPass" value="Confirm" id="verify-code" class="btn btn-dark btn-user btn-block text-align-center">
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="register.php">Create an Account!</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="login.php">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                                ';
                                }
                            } else{
                                if(isset($_POST["ResetPassword"])){
                                    echo'
                                    <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Reset Your Password</h1>
                                        <p class="mb-4">Enter verification recieved on your registred email</p>
                                    </div>
                                    <form class="user" method="post">
                                    <input type="hidden" value="'.$email.'" name="email">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                name="VCode" aria-describedby=""
                                                placeholder="Enter Verification Code">
                                        </div>
                                        <input type="submit" name="verifyCode" value="Confirm" id="verify-code" class="btn btn-dark btn-user btn-block text-align-center">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                                    ';
                                } else{
                                    echo'
                                    <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below to reset your password!</p>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="email"  name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <input type="submit" name="ResetPassword" value="Reset Password" class="btn btn-dark btn-user btn-block">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                                    ';
                                }
                                
                            }
                            ?>
                            
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Custom Script -->

    <script>
        $(document).ready(function(){
$('#password, #checkpassword').on('keyup', function () {
  if ($('#password').val() == $('#checkpassword').val()) {
    $('#msg').html('').css('color', 'green');
    // $('#verify-code').prop('disabled',false);
  } else 
    $('#msg').html('Password must be the same').css('color', 'red');
    // $('#verify-code').prop('disabled',true);
});
})
    </script>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>