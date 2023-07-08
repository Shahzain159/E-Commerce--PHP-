<?php
session_start();
$conn=mysqli_connect("localhost","root","","db_glamglow");
$user=$_SESSION["auth_user"]["user_id"];
$res=mysqli_query($conn,"SELECT * FROM cart c INNER JOIN products p ON c.cart_produc=p.prod_id WHERE cart_user=$user");
  while($row=mysqli_fetch_assoc($res)){
      echo'
      <div class="row">
        <div class="col-4 col-md-3">
          <div class="product-thumb">
            <img src="../admin/'.$row["prod_image"].'" alt="Has-Image">
          </div>
        </div>
        <div class="col-8 col-md-4">
          <div class="product-content">
            <h5 class="title"><a href="single-product.php?spid='.$row["prod_id"].'">'.$row["prod_name"].'</a></h5>
            <h6 class="">'.$row["brand_name"].'</h6>
          </div>
        </div>
        <div class="col-6 offset-4 offset-md-0 col-md-5">
          <div class="product-info">
            <div class="row">
              <div class="col-md-10 col-xs-6">
                <div class="row">
                  <div class="col-md-6 col-xs-6 qty">
                    <div class="product-quick-qty">
                      <div class="pro-qty">
                      <form method="post">
                        <input type="number" name="prod-quantity id="quantity" title="Quantity" value="'.$row["cart_quantity"].'">
                    </form>
                      </div>
                    </div>
                  </div>
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
      </div>';
  };

?>
