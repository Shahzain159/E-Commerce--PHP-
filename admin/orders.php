<?php
require_once "header.php";


if(isset($_POST["updOrder"])){
    $uid=$_POST["OrdId"];
    $status=$_POST["Ordstatus"];
   
    $query="UPDATE orders SET ord_status='$status' WHERE ord_id=$uid;";
    mysqli_query($conn,$query);
    echo '<div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Order Status Updated.
        </div>
        <button type="button" class="fas fa-scross" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}

?>
 
 <div id="orders_msg"></div>

<div class="container" id="data_form"> 

            <?php
            
            if(isset($_GET["uid"])){
                $uid=$_GET["uid"];
                $query="SELECT * FROM orders o INNER JOIN user u ON o.ord_user=u.user_id INNER JOIN products p ON o.ord_product=p.prod_id INNER JOIN order_status os ON o.ord_status=os.os_id;";
                $res=mysqli_query($conn,$query);
                $dt=mysqli_fetch_assoc($res);
                echo '<h1 class="h3 mb-2 text-gray-800">Order Details</h1>
                <form class="user" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                        <input type=number hidden="true" name="OrdId" value="'.$uid.'">
                            <div class="col-sm-6 mb-3 mb-sm-0">                            
                            <label for="orders">Order Status</label>
                                <select name="Ordstatus" id="orders" class="py-2 form-control" placeholder="Select Order Status">
                                    <option selected value='.$dt["os_id"].'>'.$dt["os_status"].'</option>
                                    ';
                                    $query="SELECT * FROM order_status";
                                    $res=mysqli_query($conn,$query);
                                    while($row=mysqli_fetch_assoc($res)){
                                    echo '<option value="'.$row["os_id"].'">'.$row["os_status"].'</option>';
                                    };
                               echo '
                                </select>
                            </div>                            
                        </div>
                       
                            <input type="submit" name="updOrder" class="btn btn-warning" value="Update">                                        
                            <hr>
                                            
                </form>';
            };
            
            ?>       
        </div>
<!-- Order Detail -->
            <div id="ord-det">

            </div>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Orders</h1>


                    <!-- Data Tables -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">View Orders</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Order Id</th>
                                            <th>Items</th>
                                            <th>Order Date</th>
                                            <th>Status</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>                                   
                                    <tbody>
                                        <?php
                                            $query="SELECT user_name,ord_receipt_no,ord_create_date,os_status, SUM(ord_quantity) AS quantity FROM orders o INNER JOIN user u ON o.ord_user=u.user_id INNER JOIN order_status s ON o.ord_status=s.os_id GROUP BY ord_receipt_no;";
                                            $res=mysqli_query($conn,$query);
                                            while($row=mysqli_fetch_assoc($res)){
                                                echo'
                                                <tr>
                                                    <td>'.$row["user_name"].'</td>
                                                    <td>'.$row["ord_receipt_no"].'</td>
                                                    <td>'.$row["quantity"].'</td>
                                                    <td>'.$row["ord_create_date"].'</td>
                                                    <td>'.$row["os_status"].'</td>
                                                    <td><button class="btn btn-info ord_det" data-id="'.$row["ord_receipt_no"].'">Details</button></td>
                                                </tr>';
                                            };
                                        ?>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
             

            </div>
     



<?php

require_once "footer.php"

?>