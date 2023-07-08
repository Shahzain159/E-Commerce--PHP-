<?php
$conn=mysqli_connect("localhost","root","","db_glamglow");
session_start();
if(isset($_SESSION["auth_user"])){
  $userName=$_SESSION["auth_user"]["user_name"];
  $userId=$_SESSION["auth_user"]["user_id"];
  $cartCheck=mysqli_query($conn,"SELECT * FROM cart WHERE cart_user=$userId");
}
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
$CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
if(isset($_GET["cart"])){
$pid=$_GET["cart"];
$_SESSION["cart"][$pid]=$pid;
};
if(isset($_GET["did"])){
  $id=$_GET["did"];
  $user=$_SESSION["auth_user"]["user_id"];
  $query="DELETE FROM cart WHERE cart_user=$user && cart_product=$id";
  mysqli_query($conn,$query);
  $exp=explode(".php",$CurPageURL);
  $url=$exp[0].'.php';
  echo'<script>window.location="'.$url.'"</script>';
};

  $abt=mysqli_query($conn,"SELECT * FROM about_us");
    $about=mysqli_fetch_assoc($abt);
    $auemail=$about["au_email"];
    $auname=$about["au_name"];
    $auaddress=$about["au_address"];
    $aunumber=$about["au_number"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Glam & Glow</title>

    <!--== Favicon ==-->
    <link rel="shortcut icon" href="assets/img/logo.jpg" type="image/x-icon" />

    <!--== Google Fonts ==-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!--== Bootstrap CSS ==-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--== Bootstrap 5.0.2 CSS ==-->
    <link href="assets/bscss/bootstrap.min.css" rel="stylesheet" />
    <!--== Ionicon CSS ==-->
    <link href="assets/css/ionicons.min.css" rel="stylesheet" />
    <!--== Simple Line Icon CSS ==-->
    <link href="assets/css/simple-line-icons.css" rel="stylesheet" />
    <!--== Line Icons CSS ==-->
    <link href="assets/css/lineIcons.css" rel="stylesheet" />
    <!--== Font Awesome Icon CSS ==-->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--== Animate CSS ==-->
    <link href="assets/css/animate.css" rel="stylesheet" />
    <!--== Swiper CSS ==-->
    <link href="assets/css/swiper.min.css" rel="stylesheet" />
    <!--== Range Slider CSS ==-->
    <link href="assets/css/range-slider.css" rel="stylesheet" />
    <!--== Fancybox Min CSS ==-->
    <link href="assets/css/fancybox.min.css" rel="stylesheet" />
    <!--== Slicknav Min CSS ==-->
    <link href="assets/css/slicknav.css" rel="stylesheet" />
    <!--== Owl Carousel Min CSS ==-->
    <link href="assets/css/owlcarousel.min.css" rel="stylesheet" />
    <!--== Owl Theme Min CSS ==-->
    <link href="assets/css/owltheme.min.css" rel="stylesheet" />
    <!--== Spacing CSS ==-->
    <link href="assets/css/spacing.css" rel="stylesheet" />

    
    <!--== Bootstrap 5.0.2 JS ==-->
    <link href="assets/bsjs/bootstrap.min.js" rel="stylesheet" />

    <!--== Main Style CSS ==-->
    <link href="assets/css/style.css" rel="stylesheet" />

    <!---jQuery--->
    <script src="assets/js/jquery.js"></script>
</head>

<body>

<!--wrapper start-->
<div class="wrapper home-default-wrapper">

  <!--== Start Header Wrapper ==-->
  <header class="header-area header-default header-style3">
    <!--== Start Header Top ==-->
    <div class="header-top">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 hidden-md-down">
            <div class="contact-email">
              <span>Email us:<a href="mailto:<?php echo$auemail ?>"><?php echo$auemail ?></a>
              </span>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 text-md-start text-lg-center text-center">
            <p>Additional 20% Off Sale Items | Please See Details</p>
          </div>
<!---User login Condition--->
    <?php
    if(isset($_SESSION["auth_user"])){
        echo'
        <div class="col-md-6 col-lg-4 text-md-end text-center mt-sm-15">
            <div class="theme-setting">
            <span class="bi bi-person-circle"></span>
              <a class="dropdown-btn" href="#" role="button">
                '.$_SESSION["auth_user"]["user_name"].'
                <i class="ion-ios-arrow-down"></i> 
              </a>
              <ul class="dropdown-content">
                <li>
                  <a href="my-account.php">My account</a>
                </li>
                <li>
                  <a href="logout.php" >Sign out</a>
                </li>
              </ul>
            </div>
          </div>
        ';
    } else{
        echo'<div class="col-md-6 col-lg-4 text-md-end text-center mt-sm-15">
        <div class="theme-setting">            
          <a class="" href="login.php" role="button">
          <i class="icon-user"></i>
            Login
          </a>
        </div>
      </div>';
    };


    ?>  
    <!---End User login Condition--->        
        </div>
      </div>
    </div>
    <!--== End Header Top ==-->

    <!--== Start Header Bottom ==-->
    <div class="header-bottom sticky-header hidden-md-down">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col col-12">
            <div class="header-align">
              <div class="row align-items-center">
                <div class="col-md-5">
                  <div class="header-navigation-area">
                    <ul class="main-menu nav position-relative">
                      <li class=""><a href="index.php">Home</a>
                      </li>
                      <li><a href="about-us.php">About Us</a></li>
                      <li class="has-submenu full-width"><a href="products.php">Shop</a>
                        <ul class="submenu-nav submenu-nav-mega submenu-nav-width">
                    <!--- Start Fetching Category--->
                          <?php
                          $query="SELECT * FROM category";
                          $res=mysqli_query($conn,$query);
                          while($row=mysqli_fetch_assoc($res)){
                            echo'
                            <li class="mega-menu-item"><a href="products.php?cid='.$row["cat_id"].'" class="mega-title">'.$row["cat_name"].'</a>
                            <ul>';
                            $cat=$row["cat_id"];
                            $query2="SELECT * FROM sub_category WHERE subcat_maincat=$cat";
                            $res2=mysqli_query($conn,$query2);
                            while($row2=mysqli_fetch_assoc($res2)){
                              echo '<li><a href="products.php?subc='.$row2["subcat_id"].'&cat='.$cat.'">'.$row2["subcat_name"].'</a></li>';
                            };

                            echo '</ul>
                          </li>
                            ';
                          };
                          ?>
                          <!---End Fetching Category--->
                        </ul>
                      </li>
                      <li><a href="contact.php">Contact us</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="header-logo-area text-center">
                    <a href="index.php">
                      <img class="logo-main  d-none" src="assets/img/logo.png" alt="Logo" />
                      <img class="logo-light" src="assets/img/logo-light.png" alt="Logo" />
                    </a>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="header-action-area float-end">
                    <div class="search-content-wrap">
                      <button class="btn-search">
                        <span class="icon icon-search icon-magnifier"></span>
                      </button>
                      <div class="btn-search-content">
                        <form method="post" action="search.php">
                          <div class="form-input-item">
                            <input type="text" name="searchQuery" placeholder="Enter your search key ...">
                            <button type="submit" name="search" Value="" class="btn-src">
                              <i class="icon-magnifier"></i>
                        </button>
                            <div class="search-categorie">
                              <select class="form-select" name="poscats">
                                <option selected>All categories</option>
                                <?php
                                  $res=mysqli_query($conn,"SELECT * FROM category");
                                  while($row=mysqli_fetch_assoc($res)){
                                    $cat=$row["cat_id"];
                                    echo'<option value="'.$row["cat_id"].'">'.$row["cat_name"].'</option>';
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    
                    <div class="shop-button-group">
                      <div class="shop-button-item">
                        <a class="shop-button" href="cart.php">
                          <i class="icon-bag icon"></i>
                          
                            <!---Item Count--->
                            <?php
                            if(isset($_SESSION["auth_user"])){
                              $res=mysqli_query($conn,"SELECT COUNT(*) FROM cart c INNER JOIN products p ON c.cart_product=p.prod_id WHERE cart_user=$userId");
                              while($row=mysqli_fetch_assoc($res)){
                               echo '<sup class="shop-count">'.$row["COUNT(*)"].'
                               </sup>';
                                };
                              
                              } else{
                                  echo'';
                              };
                          ?>
                          <!---/Item Count--->
                          
                            <?php
                            
                            if(isset($_SESSION["auth_user"])){
                              $query="SELECT SUM(cart_total) AS total FROM cart c INNER JOIN products p ON c.cart_product=p.prod_id WHERE cart_user=$userId";
                              $res=mysqli_query($conn,$query);
                              // $total=$row["total"];
                                  while($row=mysqli_fetch_assoc($res)){
                                  echo '<span class="cart-total">Rs.'.$row["total"].'</span>';
                                };
                              } else{
                                  echo'<span class="cart-total">Rs.0</span>';
                              };
                            ?>
                        </a>
                        <div class="popup-cart-content">
                          <ul class="popup-product-list" id="dropdown-cart">  
              <!---Start Fetching Cart Items--->                          
              <?php
            if(isset($_SESSION["auth_user"])){
              $res=mysqli_query($conn,"SELECT * FROM cart c INNER JOIN products p ON c.cart_product=p.prod_id WHERE cart_user=$userId");
              while($row=mysqli_fetch_assoc($res)){              
                if(empty($row)){
                  echo'<li class="product-list-item">
                  Cart is empty
                  </li>';
                } else{               
                  echo'
                <li class="product-list-item">
                <a href="single-product.php?pid='.$row["prod_id"].'">
                <img src="../admin/'.$row["prod_image"].'" alt="Image-HasTech">
                <span class="product-title">'.$row["prod_name"].'</span>
                <span class="product-quantity">'.$row["cart_quantity"].'x</span>
                </a>
                <span class="product-price">Rs. '.$row["prod_price"].'</span>
                <a class="product-close" href="'.$CurPageURL.'?did='.$row["prod_id"].'"><i class="la la-close"></i></a>
                </li>';
                };
                };
              } else{
                  echo'<li class="product-list-item">
                  Cart is empty
                  </li>';
              };
                ?>
                <!---End Fetching Cart Items--->
                          </ul>
                          <div class="price-content">
                            <div class="cart-total">
                              <span class="label">Total</span>
                              <?php
                            
                            if(isset($_SESSION["auth_user"])){
                              $query="SELECT SUM(cart_total) AS total FROM cart c INNER JOIN products p ON c.cart_product=p.prod_id WHERE cart_user=$userId";
                              $res=mysqli_query($conn,$query);
                              
                                  while($row=mysqli_fetch_assoc($res)){
                                  echo '<span class="value">Rs.'.$row["total"].'</span>';
                                };
                              } else{
                                  echo'<span class="value"></span>';
                              };
                            ?>
                            </div>
                          </div>
                          <div class="checkout">
                          <a href="
                          <?php
                            if(isset($_SESSION["auth_user"])){
                            $res=mysqli_query($conn,"SELECT * FROM cart WHERE cart_user=$userId");
                            if(mysqli_num_rows($res)){
                              echo'cart.php';
                              } else{
                              echo$url;
                              }
                            } else{
                              echo$url;
                            };
                          ?>
                          " class="btn-Checkout">Checkout</a> 
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Header Bottom ==-->

    <!--== Start Responsive Header ==-->
    <div class="responsive-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-4">
            <div class="header-item">
              <button class="btn-menu" type="button"><i class="icon-menu"></i></button>
            </div>
          </div>
          <div class="col-4">
            <div class="header-item justify-content-center">
              <div class="header-logo-area">
                <a href="index.html">
                  <img class="logo-main" src="assets/img/logo.png" alt="Logo" />
                </a>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="header-item justify-content-end">
              <button class="btn-user" onclick="window.location.href='my-account.php'"><i class="icon-user"></i></button>
              <button class="btn-cart" onclick="window.location.href='cart.php'"><i class="icon-bag"></i> <span class="item-count">2</span></button>
            </div>
          </div>
          <div class="col-12">
            <div class="responsive-search-content">
              <form action="search.php" method="post">
                <div class="form-input-item">
                  <input type="text" name="search" placeholder="Enter your search key ...">
                  <button type="submit" name="" class="btn-src">
                    <i class="icon-magnifier"></i>
                  </button>
                  <div class="search-categorie">
                    <select class="form-select" name="poscats">
                      <option selected>All categories</option>
                      <?php
                      $res=mysqli_query($conn,"SELECT * FROM category");
                      while($row=mysqli_fetch_assoc($res)){
                        $cat=$row["cat_id"];
                        echo'<option value="'.$row["cat_id"].'">'.$row["cat_name"].'</option>';
                      }
                    ?>
                    </select>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Responsive Header ==-->
  </header>
  <!--== End Header Wrapper ==-->
  <main class="main-content">