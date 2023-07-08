<?php

require_once("header.php");
// session_destroy();
if(isset($_GET["cart"])){
  if(isset($_SESSION["auth_user"])){
  $id=$_GET["cart"];
  $_SESSION["cart"][$id]=$id;
  $cart=$_SESSION["cart"];
  $user=$_SESSION["auth_user"]["user_id"];
  $query="SELECT * FROM cart c INNER JOIN products p ON c.cart_product=p.prod_id WHERE cart_user=$user && cart_product=$id";
  $res=mysqli_query($conn,$query);
  $row=mysqli_fetch_assoc($res);

  
  if(empty($row)){
    $query="INSERT INTO cart VALUES(NULL,$user,$id,1,0,0)";
    $query2="UPDATE cart c INNER JOIN products p ON c.cart_product=p.prod_id SET c.cart_total = (c.cart_quantity * p.prod_price), cart_price=p.prod_price WHERE cart_user=$user && cart_product=$id ";
  mysqli_query($conn,$query);
  mysqli_query($conn,$query2);
  echo '<script type="text/javascript">
        window.location = "products.php";
        </script> ';
  } else{
    echo '<script type="text/javascript">
        alert("Product already present in basket");
        window.location = "products.php";
        </script> ';
  };  
  } else{
    $id=$_GET["cart"];
    echo '<script type="text/javascript">
        alert("You must be logged in to add products in basket");
        window.location = "login.php?cart='.$id.'";
        </script> ';
  };
};


?>
    <!--== Start Page Header Area Wrapper ==-->
    <div class="page-header-area bg-img" style="height:40px" data-bg-img="assets/img/photos/bg-02.jpg">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <div class="page-header-content">
              <nav class="breadcrumb-area">
                <ul class="breadcrumb">
                  <li><a href="index.php">Home</a></li>
                  <li class="breadcrumb-sep"><i class="fa fa-angle-right"></i></li>
                  <li>Shop</li>
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
            <!--== Start Sidebar Area ==-->
            <div class="shop-sidebar-wrapper">

              <!--== Start Sidebar Item ==-->
              <div class="sidebar-item mb-40">
                <h4 class="small-title">Categories</h4>
                <div class="sidebar-body">
                  <ul class="sidebar-product-category">
                    <?php
                      $res=mysqli_query($conn,"SELECT * FROM category");
                      while($row=mysqli_fetch_assoc($res)){
                        echo'<li class="color-grey"><a href="products.php?cid='.$row["cat_id"].'">'.$row["cat_name"].'</a></li>';
                      };
                    ?>
                  </ul>
                </div>
              </div>
              <!--== End Sidebar Item ==-->

              <!--== Start Sidebar Item ==-->
              <div class="sidebar-item mb-40">
                <h4 class="small-title">Sub-Categories</h4>
                <div class="sidebar-body">
                  <ul class="sidebar-product-category">
                    <?php
                      $res=mysqli_query($conn,"SELECT * FROM sub_category");
                      while($row=mysqli_fetch_assoc($res)){
                        echo'<li class="color-grey"><a href="products.php?subc='.$row["subcat_id"].'&cat='.$row["subcat_maincat"].'">'.$row["subcat_name"].'</a></li>';
                      };
                    ?>
                  </ul>
                </div>
              </div>
              <!--== End Sidebar Item ==-->

              <!--== Start Sidebar Item ==-->
              <div class="sidebar-item mb-40">
                <h4 class="small-title">Brands</h4>
                <div class="sidebar-body">
                  <ul class="sidebar-product-category">
                    <?php
                      $res=mysqli_query($conn,"SELECT * FROM brands");
                      while($row=mysqli_fetch_assoc($res)){
                        echo'<li class="color-grey"><a href="products.php?bid='.$row["brand_id"].'">'.$row["brand_name"].'</a></li>';
                      };
                    ?>
                  </ul>
                </div>
              </div>
              <!--== End Sidebar Item ==-->

            </div>
            <!--== End Sidebar Area ==-->
          </div>
          <div class="col-lg-9 order-0 order-lg-2">
            <!--== Start Shop Area ==-->
            <div class="product-header-wrap">
              <div class="row">
                <div class="col-4 col-sm-4 col-md-6">
                <ul class="nav product-tab-nav" id="pills-tab" role="tablist">
                    <li role="presentation" class="m-2">
                      <a id="grid-tab" data-bs-toggle="pill" href="#grid" role="tab" aria-controls="grid" aria-selected="false"><i class="fa fa-th fa-2x"></i></a>
                    </li>
                    <li role="presentation" class="m-2">
                      <a class="active"  id="list-care-tab" data-bs-toggle="pill" href="#list-care" role="tab" aria-controls="list-care" aria-selected="true"><i class="fa fa-list fa-2x"></i></a>
                    </li>
                  </ul>
                  <div class="total-products text-xl">
                    <?php
                    

                    ?>
                    <p class="hidden-sm-down"><?php
                    if(isset($_GET["subc"])){
                      $subc=$_GET["subc"];
                      $res=mysqli_query($conn,"SELECT count(prod_id) AS prod FROM products WHERE prod_subcategory=$subc");
                    $row=mysqli_fetch_array($res);
                    $items=$row["prod"];
                    if($items>1){
                    echo'There are '.$row["prod"].' products';
                    } else if($items<1){
                      echo'No products found';
                    } else{
                      echo'There is only '.$row["prod"].' product';
                    }

                    } else if(isset($_GET["cid"])){
                      $cid=$_GET["cid"];
                      $res=mysqli_query($conn,"SELECT count(prod_id) AS prod FROM products WHERE prod_category=$cid");
                    $row=mysqli_fetch_array($res);
                    $items=$row["prod"];
                    if($items>1){
                    echo'There are '.$row["prod"].' products';
                    } else if($items<1){
                      echo'No products found';
                    }  else{
                      echo'There is only '.$row["prod"].' product';
                    }
                    } else if(isset($_GET["bid"])){
                      $bid=$_GET["bid"];
                      $res=mysqli_query($conn,"SELECT count(prod_id) AS prod FROM products WHERE prod_brand=$bid");
                    $row=mysqli_fetch_array($res);
                    $items=$row["prod"];
                    if($items>1){
                    echo'There are '.$row["prod"].' products';
                    } else if($items<1){
                      echo'No products found';
                    }  else{
                      echo'There is only '.$row["prod"].' product';
                    }
                    }else{
                    $res=mysqli_query($conn,"SELECT count(prod_id) AS prod FROM products");
                    $row=mysqli_fetch_array($res);
                    $items=$row["prod"];
                    if($items>1){
                    echo'There are '.$row["prod"].' products';
                    } else if($items<1){
                      echo'No products found';
                    } else{
                      echo'There is only '.$row["prod"].' product';
                    }
                  }
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

if(isset($_GET["cid"])){
  $cid=$_GET["cid"];
  $query="SELECT * FROM products WHERE prod_category=$cid";
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

                  }else if(isset($_GET["subc"])){
                      $subc=$_GET["subc"];
                      $cat=$_GET["cat"];
                      $query="SELECT * FROM products WHERE prod_subcategory=$subc";
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
                    }else if(isset($_GET["bid"])){
                      $bid=$_GET["bid"];
                      $query="SELECT * FROM products WHERE prod_brand=$bid";
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
                    } else{                    
                    $res=mysqli_query($conn,"SELECT * FROM products");
                    while($row=mysqli_fetch_assoc($res)){
                      echo'
                      <div class="col-sm-6 col-md-4">
                      <!--== Start Shop Item ==-->
                      <div class="product-item">
                        <div class="inner-content">
                          <div class="product-thumb">
                            <a href="single-product.php?pid='.$row["prod_id"].'">
                              <img src="../admin/'.$row["prod_image"].'">
                              <img class="second-image" src="../admin/'.$row["prod_image"].'">
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
                <div class="tab-pane fade" id="list-care" role="tabpanel" aria-labelledby="list-care-tab">
                  <div class="row">

                  <?php
if(isset($_GET["cid"])){
  $cid=$_GET["cid"];
  $query="SELECT * FROM products p INNER JOIN stock s ON s.stk_product=p.prod_id WHERE prod_category=$cid";
  $res=mysqli_query($conn,$query);
  while($row=mysqli_fetch_assoc($res)){
    echo'
    <div class="col-lg-12">
    <!--== Start Shop Item ==-->
    <div class="product-item">
      <div class="inner-content product-list-item">
        <div class="row m-0">
          <div class="col-sm-4 p-0">
            <div class="product-thumb">
              <a href="single-product.php?pid='.$row["prod_id"].'">
                <img src="../admin/'.$row["prod_image"].'" alt="Image-HasTech">
                <img class="second-image" src="../admin/'.$row["prod_image"].'" alt="Image-HasTech">
              </a>
            </div>
          </div>
          <div class="col-sm-8 p-0">
            <div class="product-desc">
              <div class="product-info">
                <h4 class="title"><a href="single-product.php?pid='.$row["prod_id"].'">'.$row["prod_name"].'</a></h4>
                <div class="prices">
                  <span class="price text-black">Rs.'.$row["prod_price"].'</span>
                </div>
                <div class="availability-list">Availability: <span>'.$row["stk_quantity"].' In Stock</span></div>
              </div>
              <div class="product-footer">
                <a class="btn-product-add" href="products.php?cart='.$row["prod_id"].'">Add to cart</a>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Shop Item ==-->
  </div>
    ';
  };
                }else if(isset($_GET["subc"])){
                      $subc=$_GET["subc"];
                      $cat=$_GET["cat"];
                      $query="SELECT * FROM products p INNER JOIN stock s ON s.stk_product=p.prod_id WHERE prod_subcategory=$subc";
                      $res=mysqli_query($conn,$query);
                      while($row=mysqli_fetch_assoc($res)){
                        echo'
                        <div class="col-lg-12">
                        <!--== Start Shop Item ==-->
                        <div class="product-item">
                          <div class="inner-content product-list-item">
                            <div class="row m-0">
                              <div class="col-sm-4 p-0">
                                <div class="product-thumb">
                                  <a href="single-product.php?pid='.$row["prod_id"].'">
                                    <img src="../admin/'.$row["prod_image"].'" alt="Image-HasTech">
                                    <img class="second-image" src="../admin/'.$row["prod_image"].'" alt="Image-HasTech">
                                  </a>
                                </div>
                              </div>
                              <div class="col-sm-8 p-0">
                                <div class="product-desc">
                                  <div class="product-info">
                                    <h4 class="title"><a href="single-product.php?pid='.$row["prod_id"].'">'.$row["prod_name"].'</a></h4>
                                    <div class="prices">
                                      <span class="price text-black">Rs.'.$row["prod_price"].'</span>
                                    </div>
                                    <div class="availability-list">Availability: <span>'.$row["stk_quantity"].' In Stock</span></div>
                                  </div>
                                  <div class="product-footer">
                                    <a class="btn-product-add" href="products.php?cart='.$row["prod_id"].'">Add to cart</a>
                                    
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--== End Shop Item ==-->
                      </div>
                        ';
                      };
                    }else if(isset($_GET["bid"])){
                      $bid=$_GET["bid"];
                      $query="SELECT * FROM products WHERE prod_brand=$bid";
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
                    }else{
                        $res=mysqli_query($conn,"SELECT * FROM products");
                    while($row=mysqli_fetch_assoc($res)){
                      echo'
                      <div class="col-lg-12">
                        <!--== Start Shop Item ==-->
                        <div class="product-item">
                          <div class="inner-content product-list-item">
                            <div class="row m-0">
                              <div class="col-sm-4 p-0">
                                <div class="product-thumb">
                                  <a href="single-product.php?pid='.$row["prod_id"].'">
                                    <img src="../admin/'.$row["prod_image"].'" alt="Image-HasTech">
                                    <img class="second-image" src="../admin/'.$row["prod_image"].'" alt="Image-HasTech">
                                  </a>
                                </div>
                              </div>
                              <div class="col-sm-8 p-0">
                                <div class="product-desc">
                                  <div class="product-info">
                                    <h4 class="title"><a href="single-product.php?pid='.$row["prod_id"].'">'.$row["prod_name"].'</a></h4>
                                    <div class="prices">
                                      <span class="price text-black">Rs.'.$row["prod_price"].'</span>
                                    </div>
                                    <div class="availability-list">Availability: <span>300 In Stock</span></div>
                                  </div>
                                  <div class="product-footer">
                                    <a class="btn-product-add" href="products.php?cart='.$row["prod_id"].'">Add to cart</a>
                                    
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--== End Shop Item ==-->
                      </div>
                      ';

                      }}
                        
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
