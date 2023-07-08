<?php

require_once("header.php");
if(!isset($_SESSION["auth_user"])){
    echo'<script>window.location="index.php"</script>';
    
} else{
  
$user=$_SESSION["auth_user"]["user_name"];
$userId=$_SESSION["auth_user"]["user_id"];
$email=$_SESSION["auth_user"]["user_email"];
$dob=$_SESSION["auth_user"]["user_dob"];
$phone=$_SESSION["auth_user"]["user_contact"];
$res=mysqli_query($conn,"SELECT * FROM user_details WHERE dt_user=$userId");
$address='';
$altPhone='';
if($dt=mysqli_fetch_assoc($res)){
$address=$dt["dt_address"];
$altPhone=$dt["dt_workphone"];
};

if(isset($_POST["order"])){
    $address=$_POST["address"];
    $altPhone=$_POST["altPhone"];
    $receipt=date('Ymd').'/'.$userId.'/'.random_int(1,1000);
    $res=mysqli_query($conn,"SELECT * FROM cart where cart_user=$userId");
    while($row=mysqli_fetch_assoc($res)){
        $product=$row["cart_product"];
        $quantity=$row["cart_quantity"];
        $totalCart=$row["cart_total"];
        if(isset($_POST["remarks"])){
          $remarks=$_POST["remarks"];
        mysqli_query($conn,"INSERT into orders VALUES(Null,$userId,$product,$quantity,$totalCart,1,'$receipt',CURRENT_TIMESTAMP,'$remarks')");
        } else{
          mysqli_query($conn,"INSERT into orders VALUES(Null,$userId,$product,$quantity,$totalCart,1,'$receipt',CURRENT_TIMESTAMP,NULL)");
        }

        $rem=mysqli_query($conn,"SELECT * FROM user_details WHERE dt_user=$userId");
        $dt=mysqli_fetch_assoc($rem);
        if(empty(mysqli_num_rows($rem))){
            mysqli_query($conn,"INSERT INTO user_details VALUES(NULL,$userId,'$address','$altPhone')");
        } else{
          if($dt["dt_address"]!=$address){
          mysqli_query($conn,"UPDATE user_details SET dt_address='$address' WHERE dt_user=$userId");
          }
          if($dt["dt_workphone"]!=$altPhone){
            mysqli_query($conn,"UPDATE user_details SET dt_workphone='$altPhone' WHERE dt_user=$userId");
            }
        }

        mysqli_query($conn,"DELETE FROM cart WHERE cart_user=$userId");
        echo'<script>window.location="my-account.php"</script>';
        
    };
}



};

?>
 
 <!--== Start Product Area Wrapper ==-->
  <section class="product-area">
      <div class="container" data-padding-top="62">
        <div class="shopping-cart-wrap">
          <div class="row">
            <div class="col-lg-8">
              <div class="shopping-checkout-content">
                <div class="checkout-accordion" id="accordionExample">
                  <div class="checkout-accordion-item">
                    <h2 class="heading" id="headingOne">
                      <button class="heading-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <span class="step-number">1</span>
                        Personal Information
                      </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="checkout-accordion-body">
                        <div class="personal-information">
                          <ul>
                            <li>Connected as <a href="#/">
                                 <?php echo$user; ?>
                            </a></li>
                            <li>Not you? <a href="logout.php">Log out</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="checkout-accordion-item">
                    <h2 class="heading" id="headingTwo">
                      <button class="heading-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <span class="step-number">2</span>
                        Addresses
                      </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                      <div class="checkout-accordion-body" data-margin-top="14">
                        <div class="personal-addresses">
                          <p class="p-text">The selected address will be used both as your personal address (for invoice) and as your delivery address.</p>
                          <div class="delivery-address-form">
                            <form action="#" method="post">
                              <div class="form-group row">
                                <label class="col-md-3" for="f_name" >Full Name</label>
                                <div class="col-md-6">
                                  <input id="f_name" class="form-control" value="<?php echo$user ?>"disabled type="text">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3" for="frm_address">Address</label>
                                <div class="col-md-6">
                                  <input id="frm_address" name="address" class="form-control" type="text" required value="<?php echo$address ?>">
                                </div>
                              </div>                              
                              <div class="form-group row">
                                <label class="col-md-3" for="frm_dob">Date of Birth</label>
                                <div class="col-md-6">
                                  <input id="frm_dob" name="dob" class="form-control" value="<?php echo$dob ?>"type="text">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3" for="frm-phone">Phone</label>
                                <div class="col-md-6">
                                  <input id="frm-phone" class="form-control" type="tel" value="<?php echo$phone ?>" required>
                                </div>
                              </div>                              
                              <div class="form-group row">
                                <label class="col-md-3" for="frm-2ndphone">Work Phone</label>
                                <div class="col-md-6">
                                  <input id="frm-2ndPhone" placeholder="03XX-1234567" name="altPhone" class="form-control" type="tel" required value="<?php echo$altPhone ?>" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3" for="frm_address">Remarks</label>
                                <div class="col-md-6">
                                  <textarea id="frm_remarks" name="remarks" value="NULL" class="form-control" type="text" row=8></textarea>
                                </div>
                                <div class="col-md-3">
                                  <span class="optional-label">Optional</span>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-md-12 text-center">
                                  <input type="submit" class="btn-submit fs-5" name="order" value="Confirm">
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="shopping-cart-summary mt-md-70">
                <div class="cart-detailed-totals">
                  <div class="separator"></div>
                  <div class="card-block">
                    <div class="card-block-item">
                      <span class="label">Total (Tax Incl.)</span>
                      <span class="value">
                      <?php
                            
                            if(isset($_SESSION["auth_user"])){
                              $user=$_SESSION["auth_user"]["user_id"];
                              $query="SELECT SUM(cart_total) AS total FROM cart WHERE cart_user=$user";
                              $res=mysqli_query($conn,$query);
                              
                                  while($row=mysqli_fetch_assoc($res)){
                                  echo $row["total"];
                                };
                              } else{
                                  echo'0';
                              };
                            ?>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="block-reassurance">
                <ul>
                  <li>
                    <img src="assets/img/shop/cart/verified-user.png" alt="Has-Image">
                    <span>Security Policy (Edit With Customer Reassurance Module)</span>
                  </li>
                  <li>
                    <img src="assets/img/shop/cart/local-shipping.png" alt="Has-Image">
                    <span>Delivery Policy (Edit With Customer Reassurance Module)</span>
                  </li>
                  <li>
                    <img src="assets/img/shop/cart/swap-horiz.png" alt="Has-Image">
                    <span>Return Policy (Edit With Customer Reassurance Module)</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
if(isset($_POST["prod-quantity"])){
  $q=$_POST["prod-quantity"];
  print_r($q);
}
      ?>
    </section>
    <!--== End Product Area Wrapper ==-->


<?php

require_once("header.php");

?>
