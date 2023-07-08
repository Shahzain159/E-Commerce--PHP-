<?php
// session_start();
// session_destroy();
if(isset($_SESSION["auth_user"])){
  echo'<script>window.location=history.go(-2)</script>';
}
$conn=mysqli_connect("localhost","root","","db_glamglow");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email=$_POST["email"];
    $pass=$_POST["pass"];
    $query="SELECT * FROM user where user_email='$email'";
    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)){
        $row=mysqli_fetch_assoc($res);
        if(password_verify($pass,$row["user_password"])){
                    session_start();
                    $_SESSION["auth_user"]=$row;
                    if(isset($_GET["cart"])){                      
                    $cid=$_GET["cart"];
                    $user=$row["user_id"];
                    header("location:products.php?cart=$cid");                      
                    } else{
                      echo'<script>window.location=history.go(-2)</script>';
                      // header("location:index.php");
                    };
                    
        } else{
            echo "<script>alert('Wrong password')</script>";
        };
    } else{
        echo "<script>alert('No user registered with $email')</script>";
    };

};
require("header.php");
?>

    <!--== Start Account Area Wrapper ==-->
    <section>
      <div class="container" data-padding-top="62"> 
        <h4 class="fz-24 mb-25">Log in to your account</h4>
        <div class="row">
          <div class="col-12">
            <div class="login-form-content">
              <div class="login-form">
                <form action="" method="post">
                  <div class="form-group row">
                    <label class="col-md-3" for="frm_email">Email</label>
                    <div class="col-md-6">
                      <input id="frm_email" name="email" class="form-control" type="email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3" for="frm_pass">Password</label>
                    <div class="col-md-6">
                      <div class="pass-content">
                        <input type="password" name="pass" class="form-control" id="form_pass">
                        <span class="show-pass" onclick="myFunction()" id="hide_pass">show</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row mb-15">
                    <div class="col-12 text-center">
                      <a class="btn-forgot" href="forgot-password.php">Forgot your password?</a>
                      <input class="btn-signin" type="submit" name="signIn"value="Sign In">
                      <!-- <a class="btn-signin" href="#/">Sign in</a> -->
                    </div>
                  </div>
                </form>
              </div>
              <a class="btn-create-account" href="register.php">No account? Create one here</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Account Area Wrapper ==-->


    <script>
function myFunction() {
  var x = document.getElementById("form_pass");
  var y = document.getElementById("hide_pass");

  if (x.type === "password") {
    x.type = "text";
    y.innerHTML="Hide"
  } else {
    x.type = "password";
    y.innerHTML="Show"
  }
}
</script>
    

<?php
require("footer.php");
?>