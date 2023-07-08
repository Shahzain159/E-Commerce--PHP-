<?php

require_once("header.php");

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
                  <li>Search</li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

<!--== Start Product Area Wrapper ==-->
<section class="product-area">
      <div class="container pb-55">
        <div class="row">
          <div class="col-lg-3 order-1 order-lg-1">
          </div>
          <div class="col-lg-9 order-0 order-lg-2">
            <!--== Start Shop Area ==-->
            <div class="product-header-wrap">
              <div class="row">
                <div class="col-4 col-sm-4 col-md-6">
                  <div class="total-products">
                    <?php
                    if(isset($_POST["search"])){
                        $word=$_POST["searchQuery"];
                        // $category=$_POST["poscats"];
                      $query="SELECT * FROM products WHERE prod_name LIKE '%$word%'";
                      $res=mysqli_query($conn,$query);
                      $results=mysqli_num_rows($res);
                      if($results>1){
                      echo$results.' Products found.';
                      }else{
                        echo$results.' Product found.';
                      }
                    }

                    ?>
                    <p class="hidden-sm-down"><?php
                    
                    ?></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-body-wrap">
              <div class="tab-content product-tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                  <div class="row">
                    <?php
                    if(isset($_POST["search"])){
                        $word=$_POST["searchQuery"];
                        // $category=$_POST["poscats"];
                      $query="SELECT * FROM products WHERE prod_name LIKE '%$word%'";
                      $res=mysqli_query($conn,$query);
                      while($row=mysqli_fetch_assoc($res)){
                        echo'
                        <div class="col-sm-6 col-md-4">
                        <!--== Start Shop Item ==-->
                        <div class="product-item">
                          <div class="inner-content">
                            <div class="product-thumb">
                              <a href="single-product.php?pid='.$row["prod_id"].'">
                                <img src="../admin/'.$row["prod_image"].'">
                              </a>
                            </div>
                            <div class="product-desc">
                              <div class="product-info">
                                <h4 class="title"><a href="single-product.php?pid='.$row["prod_id"].'">'.$row["prod_name"].'</a></h4>
                                <div class="prices">
                                  <span class="price text-black">Rs. '.$row["prod_price"].'</span>
                                </div>
                              </div>
                              <div class="product-footer">
                                <a class="btn-product-add" href="products.php?cart='.$row["prod_id"].'">Add to cart</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--== End Shop Item ==-->
                      </div>
                        ';
                      };
                    
                  };

                    ?>                    
                  </div>
                </div>
              </div>
            </div>
            <!--== End Shop Area ==-->
          </div>
        </div>
      </div>
    </section>
    <!--== End Product Area Wrapper ==-->

<?php
require_once("footer.php");

?>
