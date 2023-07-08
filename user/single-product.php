<?php
require("header.php");
$id='';
if(isset($_GET["pid"])){
    $id=$_GET["pid"];
    
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
                  <li><a href="products.php">Shop</a></li>
                  <li class="breadcrumb-sep"><i class="fa fa-angle-right"></i></li>
                  <li>Product Single</li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start Product Single Area Wrapper ==-->
    <section class="product-area product-single-area">
      <div class="container pt-60 pb-0">
        <div class="row">
          <div class="col-12">
            <div class="product-single-item" data-margin-bottom="62">
              <div class="row">

              <div class="col-md-6">                  
                  <!--== Start Product Thumbnail Area ==-->                  
                  <div class="product-thumb">
                    <div class="swiper-container single-product-thumb-content single-product-thumb-slider2">
                      <div class="swiper-wrapper">
                        <?php
                        $res1=mysqli_query($conn,"SELECT prod_image FROM products WHERE prod_id=$id");
                        $row=mysqli_fetch_assoc($res1);
                        $cover=$row["prod_image"];
                        echo'<div class="swiper-slide">
                        <a class="lightbox-image" data-fancybox="gallery" href="../admin/'.$cover.'">
                          <img src="../admin/'.$cover.'" alt="Image-HasTech">
                        </a>
                      </div>';
                        $res=mysqli_query($conn,"SELECT * FROM product_images WHERE pi_product=$id");
                        while($row=mysqli_fetch_assoc($res)){
                          echo'
                          <div class="swiper-slide">
                          <a class="lightbox-image" data-fancybox="gallery" href="../admin/'.$row["pi_image"].'">
                            <img src="../admin/'.$row["pi_image"].'" alt="Image-HasTech">
                          </a>
                        </div>
                          ';
                        }
                        ?>
                      </div>
                    </div>
                    <div class="swiper-container single-product-nav-content single-product-nav-slider2">
                      <div class="swiper-wrapper">
                      <?php
                      echo'<div class="swiper-slide">
                      <img src="../admin/'.$cover.'" alt="Image-HasTech">
                    </div>';
                        $res=mysqli_query($conn,"SELECT * FROM product_images WHERE pi_product=$id");
                        while($row=mysqli_fetch_assoc($res)){
                          echo'
                          <div class="swiper-slide">
                          <img src="../admin/'.$row["pi_image"].'" alt="Image-HasTech">
                        </div>
                          
                          ';
                        }
                          ?>
                      </div>
                    </div>
                  </div>
                  <!--== End Product Thumbnail Area ==-->
                </div>

                <div class="col-md-6">
                  <!--== Start Product Info Area ==-->
                  <?php

$res=mysqli_query($conn,"SELECT * FROM products WHERE prod_id=$id");
while($row=mysqli_fetch_assoc($res)){

  echo'
  <div class="product-single-info mt-sm-70">
  <h1 class="title">'.$row["prod_name"].'</h1>
  <div class="prices">
    <span class="price">Rs.'.$row["prod_price"].'</span>
  </div>
  <div class="product-description">
    <ul class="product-desc-list">
      <li>Stay ready for a change in weather.</li>
      <li>Water-resistant.</li>
      <li>Some more details.</li>
      <li>Front-zip closure.</li>
    </ul>
  </div>
  <div class="product-quick-action">
    <div class="product-quick-qty">
    </div>
    <a class="btn-product-add" href="products.php?cart='.$row["prod_id"].'">Add to cart</a>
  </div>
</div>
  ';

}

                  ?>
                  
                  <!--== End Product Info Area ==-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Product Single Area Wrapper ==-->
    <?php
    require("footer.php");
    ?>