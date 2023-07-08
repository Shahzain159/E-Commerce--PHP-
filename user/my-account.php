<?php

require_once("header.php");
if(!isset($_SESSION["auth_user"])){
  echo'<script>window.location="login.php"</script>';  
}
?>

   <!--== Start Page Header Area Wrapper ==-->
   <div class="page-header-area bg-img" data-bg-img="assets/img/photos/bg-02.jpg">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <div class="page-header-content">
              <nav class="breadcrumb-area">
                <ul class="breadcrumb">
                  <li><a href="index.php">Home</a></li>
                  <li class="breadcrumb-sep"><i class="fa fa-angle-right"></i></li>
                  <li>My Account</li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start Account Area Wrapper ==-->
    <section>
      <div class="container"> 
        <h4 class="fz-24 mb-25">Your account</h4>
       <div id="myAccount">
       <div class="row">
          <div class="col-lg-6 col-sm-6" id="ord_hist" data-id="<?php echo $userId ?>">
            <div class="account-item">
              <div class="account-inner mb-30">
                <a href="orders.php">
                  <i class="fa fa-calendar"></i>
                  <span>Order history and details</span>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-sm-6">
            <div class="account-item">
              <div class="account-inner">
                <a href="logout.php">
                  <i class="fa fa-smile-o"></i>
                  <span>Sign out</span>
                </a>
              </div>
            </div>
          </div>
        </div>

       </div>
      </div>
    </section>
    <!--== End Account Area Wrapper ==-->

<?php
require_once("footer.php");

?>
