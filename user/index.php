<?php

require_once("header.php");

?>

    <!--== Start Hero Area Wrapper ==-->
    <section class="home-slider-area">
      <div class="swiper-container swiper-pagination-style dots-bg-light home-slider-container default-slider-container">
        <div class="swiper-wrapper home-slider-wrapper slider-default">
<?php
$res=mysqli_query($conn,"SELECT * FROM sliders");
while($row=mysqli_fetch_assoc($res)){
    echo'
          <div class="swiper-slide">
            <div class="slider-content-area" data-bg-img="'.$row["slider_image"].'">
              <div class="container">
                <div class="row">
                  <div class="col-10 col-sm-6 col-md-5">
                    <div class="slider-content animate-flipInX">
                      <h5 class="sub-title transition-slide-0">REAL COVER PINK CUSHION</h5>
                      <h2 class="title transition-slide-1 mb-0"><span class="font-weight-400">FACE MAKEUP</span></h2>
                      <h2 class="title transition-slide-2">SALE 40% OFF</h2>
                      <a class="btn-slide transition-slide-3" href="#/">Shop Now</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        ';
}
?>
        </div>
        <!--== Add Swiper Pagination ==-->
        <div class="swiper-pagination"></div>
      </div>
    </section>
    <!--== End Hero Area Wrapper ==-->

    <!--== Start Product Category Area Wrapper ==-->
    <section class="product-area product-category-area">
      <div class="container pt-95 pb-35 pt-lg-70 pb-lg-10">
        <div class="row">
          <div class="col-sm-8 m-auto">
            <div class="section-title text-center mb-30">
              <h2 class="title">Popular Categories</h2>
              <div class="desc">
                <p>Some of our popular categories include cosmetic</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="product-categorys-slider owl-carousel owl-theme">
<?php
$res=mysqli_query($conn,"SELECT * FROM category");
while($row=mysqli_fetch_assoc($res)){
$cid=$row["cat_id"];
  echo'
  <div class="item">
                <div class="product-category-item">
                  <div class="inner-content-style2">
                    <div class="thumb">
                      <a href="products.php?cid='.$cid.'"><img src="assets/img/category/03.jpg" alt="Image-HasTech" class="img"></a>
                    </div>
                    <div class="content">
                      <h4 class="title"><a href="products.php?cid='.$row["cat_id"].'">'.$row["cat_name"].'</a></h4>
                      <p class="product-number">';
                      $pro=mysqli_query($conn,"SELECT count(*) AS prods FROM products WHERE prod_category=$cid");
                      $count=mysqli_fetch_assoc($pro);
                      echo$count["prods"].' Products';
                      echo'</p>
                    </div>
                  </div>
                </div>
              </div>
  
  ';

}

?>
             


            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Product Category Area Wrapper ==-->


<?php
require_once("footer.php");

?>
