<?php

require_once("header.php");
if(isset($_POST["quantity"])){
  foreach($_POST["prodId"] as $key=>$val){
    $id=$_POST["prodId"][$key];
    $q=$_POST["prodQuantity"][$key];
    $res=mysqli_query($conn,"SELECT cart_price FROM cart WHERE cart_product=$id && cart_user=$userId");
    $price=mysqli_fetch_assoc($res);
    $pr=$price["cart_price"];
    mysqli_query($conn,"UPDATE cart SET cart_quantity=$q, cart_total=($q*$pr) WHERE cart_product=$id && cart_user=$userId");
  }
  echo'<script>window.location="cart.php"</script>';
}

?>

   <!--== Start Product Area Wrapper ==-->
   <section class="product-area">
      <div class="container">
        <div class="shopping-cart-wrap">
          <div class="row">
            <div class="col-lg-8">
              <div class="shopping-cart-content">
                <h4 class="title">Shopping Cart</h4>                
                <form method="post">
                <input type="submit" value="Update Cart" name="quantity" class="btn-theme">
                <?php
                if(isset($_SESSION["auth_user"])){
                  $user=$_SESSION["auth_user"]["user_id"];
                  $res=mysqli_query($conn,"SELECT * FROM cart c INNER JOIN products p ON c.cart_product=p.prod_id INNER JOIN brands b ON p.prod_brand=b.brand_id WHERE cart_user=$user");
                    // $res=mysqli_query($conn,"SELECT * FROM products p INNER JOIN brands b ON p.prod_brand=b.brand_id INNER JOIN user u ON  WHERE prod_id=$id");
                    while($row=mysqli_fetch_assoc($res)){
                      if(empty($row)){
                        echo'
                        <div class="shopping-cart-item">
                          <div class="row">
                            <h6 class="title">Empty Cart</h6>
                          </div>
                        </div>';
                      } else{
                        echo'
                <div class="shopping-cart-item" id="cart_items">
                  <div class="row">
                    <div class="col-4 col-md-3">
                      <div class="product-thumb">
                        <img src="../admin/'.$row["prod_image"].'" alt="Has-Image">
                      </div>
                    </div>
                    <div class="col-6 col-md-3">
                      <div class="product-content">
                        <h5 class="title"><a href="single-product.php?pid='.$row["prod_id"].'">'.$row["prod_name"].'</a></h5>
                        <h6 class="">'.$row["brand_name"].'</h6>
                      </div>
                    </div>
                    <div class="col-6 offset-4 offset-md-0 col-md-5">
                      <div class="product-info">
                        <div class="row">
                          <div class="col-md-10 col-xs-6">
                          <input type="hidden" name="prodId[]" value="'.$row["prod_id"].'">
                    <div class="row">                                  
                    <div class="col-md-8">
                    <div class="product-quick-qty">
                                  <div class="pro-qty">                                  
                                    <input type="text" name="prodQuantity[]" data-id="'.$row["prod_id"].'" id="quantity" title="Quantity" value="'.$row["cart_quantity"].'">
                                  </div>
                                </div>
                    <label class="col-md-8" for="frm_quantity">Quantity</label>
                    </div>
                  </div>
                  
                            <div class="row">                              
                              <div class="col-md-6 col-xs-2 price">
                                <h6 class="product-price">Rs.'.$row["cart_total"].'</h6>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-2 col-xs-2 text-end">
                            <div class="product-close"><a href="'.$CurPageURL.'?did='.$row["prod_id"].'" class="delBtn" data-toggle="modal" data-target="#DelConfirmModal" data-id="'.$row["prod_id"].'"><i class="ion-md-trash"></i></a></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                        ';
                    };};
                } else{
                    echo'
                    <div class="shopping-cart-item">
                          <div class="row">
                            <h5 class="title"><a href="login.php">Login</a> to View you Cart</h5>
                          </div>
                        </div>';
              };
                ?>
                
                </form>
                <a class="btn btn-primary" href="products.php">Continue shopping</a>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="shopping-cart-summary mt-md-70">
                <div class="cart-detailed-totals">
                  <div class="card-block">
                    <div class="card-block-item">
                      <span class="label">
                        <!---Item Count--->
                        <?php
                            if(isset($_SESSION["auth_user"])){
                              $user=$_SESSION["auth_user"]["user_id"];
                              $res=mysqli_query($conn,"SELECT COUNT(*) FROM cart WHERE cart_user=$user");
                              while($row=mysqli_fetch_assoc($res)){
                                $count=$row["COUNT(*)"];
                                if($count>1){
                                  echo $count.' Items';
                              } else if($count<1){
                                 echo'No item in cart';
                              } else{
                                  echo '1 Item';
                              };
                                };
                              
                              } else{
                                  echo'';
                              };
                          ?>
                          <!---/Item Count--->
                      </span>
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
                    <div class="card-block-item">
                      <span class="label">Shipping</span>
                      <span class="value">Free</span>
                    </div>
                  </div>
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
                  <div class="separator"></div>
                </div>
                <div class="checkout-shopping">
                  <a class="btn-checkout" href="<?php
                            if(isset($_SESSION["auth_user"])){
                            $res=mysqli_query($conn,"SELECT * FROM cart WHERE cart_user=$userId");
                            if(mysqli_num_rows($res)){
                              echo'checkout.php';
                              } else{
                              echo$url;
                              }
                            } else{
                              echo$url;
                            };
                          ?>">Proceed to checkout</a>
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
    </section>
    <!--== End Product Area Wrapper ==-->

    


<?php
require_once("footer.php");

?>
