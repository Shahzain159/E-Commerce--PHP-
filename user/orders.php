<?php

require_once("header.php");
if(!isset($_SESSION["auth_user"])){
    echo'<script>window.location="login.php"</script>';  
};
if(isset($_POST["ord_cancel"])){
    $id=$_POST["ord_id"];
    mysqli_query($conn,"UPDATE orders SET ord_status=4, ord_remarks='Cancelled by customer' WHERE ord_receipt_no='$id'");
    echo'<script>window.location="orders.php"</script>';
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
                  <li><a href="my-account.php">My Account</a></li>
                  <li class="breadcrumb-sep"><i class="fa fa-angle-right"></i></li>
                  <li>Orders</li>
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
      <div class="container" data-padding-top="62"> 
        <h4 class="fz-24 mb-25">Order Info  </h4>
       <div id="myAccount">
       <div class="row">
         <?php
              
                  echo'
                  <div class="card shadow mb-4">
                        <div class=" py-3">
                            <h6 class="m-0 font-weight-bold">Pending Orders</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th>Order Id</th>
                                            <th>Items</th>
                                            <th>Order Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>                                   
                                    <tbody>';
                                    $res=mysqli_query($conn,"SELECT ord_receipt_no,ord_create_date,os_status, SUM(ord_quantity) AS quantity FROM orders o INNER JOIN user u ON o.ord_user=u.user_id INNER JOIN order_status s ON o.ord_status=s.os_id WHERE ord_user=$userId && ord_status=1 GROUP BY ord_receipt_no;");
                                    while($row=mysqli_fetch_assoc(($res))){
                                                echo'
                                                <tr>
                                                    <td>'.$row["ord_receipt_no"].'</td>
                                                    <td>'.$row["quantity"].'</td>
                                                    <td>'.$row["ord_create_date"].'</td>
                                                    <td>'.$row["os_status"].'</td>
                                                    <td><button class="btn-theme ord_det" data-id="'.$row["ord_receipt_no"].'">Manage</button></td>
                                                </tr>';
                                            };
                                            echo'
                                       
                                </table>
                            </div>
                        </div>
                    </div>
                  ';
                  echo'
                  <div class="card shadow mb-4">
                        <div class=" py-3">
                            <h6 class="m-0 font-weight-bold">Orders to be delivered</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th>Order Id</th>
                                            <th>Items</th>
                                            <th>Order Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>                                   
                                    <tbody>';
                                    $res=mysqli_query($conn,"SELECT ord_receipt_no,ord_create_date,os_status, SUM(ord_quantity) AS quantity FROM orders o INNER JOIN user u ON o.ord_user=u.user_id INNER JOIN order_status s ON o.ord_status=s.os_id WHERE ord_user=$userId && ord_status=2 GROUP BY ord_receipt_no;");
                                    while($row=mysqli_fetch_assoc(($res))){
                                                echo'
                                                <tr>
                                                    <td>'.$row["ord_receipt_no"].'</td>
                                                    <td>'.$row["quantity"].'</td>
                                                    <td>'.$row["ord_create_date"].'</td>
                                                    <td>'.$row["os_status"].'</td>
                                                    <td><button class="btn-theme ord_info" data-id="'.$row["ord_receipt_no"].'">Manage</button></td>
                                                </tr>';
                                            };
                                            echo'
                                       
                                </table>
                            </div>
                        </div>
                    </div>
                  ';
                  echo'
                  <div class="card shadow mb-4">
                        <div class=" py-3">
                            <h6 class="m-0 font-weight-bold">Completed Orders</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th>Order Id</th>
                                            <th>Items</th>
                                            <th>Order Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>                                   
                                    <tbody>';
                                    $res=mysqli_query($conn,"SELECT ord_receipt_no,ord_create_date,os_status, SUM(ord_quantity) AS quantity FROM orders o INNER JOIN user u ON o.ord_user=u.user_id INNER JOIN order_status s ON o.ord_status=s.os_id WHERE ord_user=$userId && ord_status=3 GROUP BY ord_receipt_no;");
                                    while($row=mysqli_fetch_assoc(($res))){
                                                echo'
                                                <tr>
                                                    <td>'.$row["ord_receipt_no"].'</td>
                                                    <td>'.$row["quantity"].'</td>
                                                    <td>'.$row["ord_create_date"].'</td>
                                                    <td>'.$row["os_status"].'</td>
                                                    <td><button class="btn-theme ord_info" data-id="'.$row["ord_receipt_no"].'">Manage</button></td>
                                                </tr>';
                                            };
                                            echo'
                                       
                                </table>
                            </div>
                        </div>
                    </div>
                  ';
                  echo'
                  <div class="card shadow mb-4">
                        <div class=" py-3">
                            <h6 class="m-0 font-weight-bold">Cancelled Orders</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th>Order Id</th>
                                            <th>Items</th>
                                            <th>Order Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>                                   
                                    <tbody>';
                                    $res=mysqli_query($conn,"SELECT ord_receipt_no,ord_create_date,os_status, SUM(ord_quantity) AS quantity FROM orders o INNER JOIN user u ON o.ord_user=u.user_id INNER JOIN order_status s ON o.ord_status=s.os_id WHERE ord_user=$userId && ord_status=4 GROUP BY ord_receipt_no;");
                                    while($row=mysqli_fetch_assoc(($res))){
                                                echo'
                                                <tr>
                                                    <td>'.$row["ord_receipt_no"].'</td>
                                                    <td>'.$row["quantity"].'</td>
                                                    <td>'.$row["ord_create_date"].'</td>
                                                    <td>'.$row["os_status"].'</td>
                                                    <td><button class="btn-theme ord_info" data-id="'.$row["ord_receipt_no"].'">Manage</button></td>
                                                </tr>';
                                            };
                                            echo'
                                       
                                </table>
                            </div>
                        </div>
                    </div>
                  ';
         ?>
        </div>

       </div>
      </div>
    </section>
    <!--== End Account Area Wrapper ==-->

<?php
require_once("footer.php");

?>
