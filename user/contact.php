<?php
require_once("header.php");

if(isset($_POST["query"])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['number'];
    $msg=$_POST['message'];
    $query="INSERT INTO contact VALUES (NULL,'$name','$email','$phone','$msg')";
    mysqli_query($conn,$query);
  echo'<script>alter("123")</script>';
}
$about="SELECT * FROM about_us";
$info=mysqli_query($conn,$about);

$address='';
$contact='';
$email='';
while($row=mysqli_fetch_assoc($info)){
  $address=$row["au_address"];
  $contact=$row["au_number"];
  $email=$row["au_email"];
}
?>

<main class="main-content">
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
                  <li>Contact us</li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

 <!--== Start Contact Area Wrapper ==-->
 <section class="contact-area contact-page-area">
      <div class="container">
        <div class="row contact-page-wrapper">
          <div class="col-lg-6">
            <div class="contact-form-wrap">
              <div class="contact-form-title">
                <h5 class="sub-title">Don’t worry!</h5>
                <h2 class="title">If you have any query? Contact with us.</h2>
              </div>
              <!--== Start Contact Form ==-->
              <div class="contact-form">
                <form method="post">
                  <div class="row row-gutter-20">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Name">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input class="form-control" type="tel" name="number" placeholder="Phone">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email">
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group mb--0">
                        <textarea class="form-control" name="message" placeholder="Massage"></textarea>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group mb--0">
                        <input class="btn-theme" type="submit" name="query" value="Submit Now">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!--== End Contact Form ==-->
            </div>
          </div>
          <div class="col-lg-6">
            <div class="contact-info-list">
              <div class="contact-info">
                <div class="info-item">
                  <div class="info">
                    <h5 class="title">Phone:</h5>
                    <p>
                      <a href="tel:<?php echo $contact ?>"><?php echo $contact ?></a>
                    </p>
                  </div>
                </div>
                <div class="info-item">
                  <div class="info">
                    <h5 class="title">Email:</h5>
                    <p>
                      <a href="mailto:<?php echo $email ?>"><?php echo $email ?></a>
                    </p>
                  </div>
                </div>
                <div class="info-item">
                  <div class="info">
                    <h5 class="title">Address:</h5>
                    <p><?php echo $address ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Contact Area Wrapper ==-->



<?php
require_once("footer.php");

?>
