<?php

require("header.php");

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require ('../admin/vendor/autoload.php');

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
if(isset($_POST["ResetPassword"])){
    $email=$_POST["email"];
    $token=rand(100000,999999);
    $_SESSION["token"]=$token;
    $query="SELECT * FROM user WHERE user_email='$email'";
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
  echo'<script>
  $(document).ready(function(){
    $("#resetPara").html("");
    $("#resetHead").html("Verification Code");

})
  </script>';
} catch (Exception $e) {
    echo '<script>window.location="forgot-password.php"</script>';
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
    $pass=$_POST["pass"];
    $checkpass=$_POST["checkPass"];
    if(trim($pass)=='' || trim($checkpass)==''){
        echo "<script>alert('All fields are required!')</script>";
    } else if($pass != $checkpass){
        echo "<script>alert('Passwords do not match!')</script>";
    }else{
    $pass1=password_hash($pass,PASSWORD_BCRYPT);
    $query="UPDATE user SET user_password='$pass1' WHERE user_email='$email';";
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
 <!--== Start Account Area Wrapper ==-->
 <section>
      <div class="container" data-padding-top="62"> 
        <h4 class="fz-24 mb-25" id="resetHead">Forgot your password.?</h4>
        <p id="resetPara">Enter your email to reset your password</p>
        <div class="row">
          <div class="col-12">
            <div class="register-form-content">
              <div class="register-form">
                <?php
                if(isset($_POST["verifyCode"])){
                    $code=$_POST["VCode"];
                    $email=$_POST["email"];
                    $vcode=$_SESSION["token"];
                    if($vcode==$code){
                        echo'
                        <form method="post">
                        <input type="hidden" value="'.$email.'" name="email">
                        <div class="form-group row">
                        <label class="col-md-3" for="frm_pass">Password</label>
                        <div class="col-md-6">
                          <div class="pass-content">
                            <input type="password" name="pass" class="form-control" id="form_pass" required>
                            <span class="show-pass" onclick="myFunction()" id="hide_pass">show</span>
                          </div>
                        </div>
                      </div>
                      <span id="msg"></span>
                      <div class="form-group row">
                        <label class="col-md-3" for="frm_pass">Confirm Password</label>
                        <div class="col-md-6">
                          <div class="pass-content">
                            <input type="password" name="checkPass" class="form-control" id="cnfrm_pass" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-15">
                      <div class="col-12 text-center">
                        <input class="btn-save" type="submit" name="setPass"value="Confirm">
                      </div>
                    </div>
                  </div>
                  </form>
                        ';
                   } }else{
              if(isset($_POST["ResetPassword"])){
                echo'
                <form method="post" class="mt-4">
                <input type="hidden" value="'.$email.'" name="email">
                <div class="form-group row">
                <label class="col-md-3" for="frm_code">Code</label>
              <div class="col-md-6">
               <input id="frm_code" name="VCode" class="form-control" type="text" placeholder="Enter Verification Code"required>
              </div>
             </div>
             <div class="row">
                  <div class="col-12 text-center">
                    <input class="btn-save" name="verifyCode" type="submit" value="Submit">
                  </div>
                 </div>              
                </form>';                   
              } else{
                echo'
                <form method="post" class="mt-4">
                 <div class="form-group row">
                    <label class="col-md-3" for="frm_email">Email</label>
                  <div class="col-md-6">
                   <input id="frm_email" name="email" class="form-control" type="email" required>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-12 text-center">
                    <input class="btn-save" name="ResetPassword" type="submit" value="Submit">
                  </div>
                 </div>              
                </form>';
              }
            }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Account Area Wrapper ==-->

    <script>
        $(document).ready(function(){
$('#password, #checkpassword').on('keyup', function () {
  if ($('#password').val() == $('#checkpassword').val()) {
    $('#msg').html('').css('color', 'green');
  } else 
    $('#msg').html('Password must be the same').css('color', 'red');
});
})
function myFunction() {
  var x = document.getElementById("form_pass");
  var y = document.getElementById("cnfrm_pass");
  var z = document.getElementById("hide_pass");

  if (x.type === "password") {
    x.type = "text";
    y.type="text";
    z.innerHTML="Hide"
  } else {
    x.type = "password";
    y.type="password";
    z.innerHTML="Show"
  }
}
</script>

<?php

require_once("footer.php");

?>