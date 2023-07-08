<?php

require_once("header.php");
if(isset($_POST["signUp"])){
  $name=$_POST["name"];  
  $email=$_POST["email"];
  $pass=$_POST["pass"];  
  $checkpass=$_POST["checkPass"];
  $dob=$_POST["dob"];
  $contact=$_POST["contact"];
if(trim($pass)=='' || trim($checkpass)==''){
    echo "<script>alert('All fields are required!')</script>";
} else if($pass != $checkpass){
    echo "<script>alert('Passwords do not match!')</script>";
}else{
$pass1=password_hash($pass,PASSWORD_BCRYPT);
$query="INSERT INTO user VALUES (NULL,'$name','$email','$pass1','$dob','$contact')";
mysqli_query($conn,$query);
if(isset($_POST["address"])){
  $address=$_POST["address"];
  $lastId=mysqli_insert_id($conn);
  $query2="INSERT INTO user_details VALUES(NULL,$lastId,'$address',Null)";
  mysqli_query($conn,$query2);
}
echo '<script type="text/javascript">
        window.location = "login.php";
        </script> ';
};
};

?>
 <script>
      
      $(document).ready(function(){
        $("#frm_birt").on('click',datepicker());
      });
      </script>
    <!--== Start Account Area Wrapper ==-->
    <section>
      <div class="container" data-padding-top="62"> 
        <h4 class="fz-24 mb-25">Create an account</h4>
        <div class="row">
          <div class="col-12">
            <div class="register-form-content">
              <div class="register-form">
                <span class="login-account">Already have an account? <a href="login.php">Log in instead!</a></span>
                <form method="post">
                  <div class="form-group row">
                    <label class="col-md-3" for="f_name">Full name</label>
                    <div class="col-md-6">
                      <input id="f_name" name="name" class="form-control" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3" for="frm_email">Email</label>
                    <div class="col-md-6">
                      <input id="frm_email" name="email" class="form-control" type="email" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3" for="frm_pass">Password</label>
                    <div class="col-md-6">
                      <div class="pass-content">
                        <input type="password" name="pass" class="form-control" id="form_pass" required>
                        <span class="show-pass" onclick="myFunction()" id="hide_pass">show</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3" for="frm_pass">Confirm Password</label>
                    <div class="col-md-6">
                      <div class="pass-content">
                        <input type="password" name="checkPass" class="form-control" id="cnfrm_pass" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3" for="frm_birt">Birthdate</label>
                    <div class="col-md-6">
                      <input id="frm_birt" name="dob" class="form-control" type="date" placeholder="MM/DD/YYYY" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3" for="frm_cont">Contact</label>
                    <div class="col-md-6">
                      <input id="frm_cont" name="contact" class="form-control" type="text" placeholder="03xx-1234567" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3" for="frm_addr">Address</label>
                    <div class="col-md-6">
                      <input id="frm_addr" name="address" class="form-control" type="text" placeholder="">
                    </div>
                    <label class="col-md-3">Optional</label>
                  </div>
              </div>
              <div class="row">
                <div class="col-12 text-end">
                  <input class="btn-save" name="signUp" type="submit" value="Register">
                </div>
              </div>              
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Account Area Wrapper ==-->

    <script>
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