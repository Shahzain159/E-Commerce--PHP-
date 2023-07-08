<?php
$conn=mysqli_connect("localhost","root","","db_glamglow");

if(isset($_POST["oid"])){
    $oid=$_POST["oid"];
    $query="SELECT * FROM orders o INNER JOIN user u ON o.ord_user=u.user_id INNER JOIN user_details d ON o.ord_user=d.dt_user INNER JOIN products p ON o.ord_product=p.prod_id INNER JOIN brands b ON p.prod_brand=b.brand_id INNER JOIN order_status s ON o.ord_status=os_id INNER JOIN category c ON p.prod_category=c.cat_id WHERE ord_receipt_no='$oid';
    ";
    $res=mysqli_query($conn,$query);
    $query2="SELECT SUM(ord_amount) AS amount FROM orders WHERE ord_receipt_no='$oid';";
    $res2=mysqli_query($conn,"$query2");
    $am=mysqli_fetch_assoc($res2);
    $amount=$am["amount"];
    $dt=mysqli_fetch_assoc($res);
    $remarks=$dt["ord_remarks"];
    echo'<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Order Amount</th>

                </tr>
                <tr>
                    <td>'.$oid.'</td>
                    <td>'.$amount.'</td>
                </tr>
                <tr>
                    <th colspan="4">Remarks</th>
                </tr>
                <tr>
                    <td colspan="4">';
                    if($remarks){
                        echo $remarks;
                    } else{echo'None';}
                    echo'</td>
                </tr>
                <tr>
                    <th colspan="4">Order Status</th>
                </tr>
                <tr>
                    <td colspan="4">'.$dt["os_status"].'</td>
                </tr>
                              
            </thead>
            </tbody>
            </table>                            
            
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Brand Name</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Quantity</th>
                </tr> 
                <tbody> ';
    $query2="SELECT * FROM orders o INNER JOIN products p ON o.ord_product=p.prod_id INNER JOIN brands b ON p.prod_brand=b.brand_id INNER JOIN category c ON p.prod_category=c.cat_id WHERE ord_receipt_no='$oid';";
    $res=mysqli_query($conn,$query2);
    while($row=mysqli_fetch_array($res)){
        echo'                           
                    <tr>
                        <td>'.$row["prod_name"].'</td>
                        <td>'.$row["brand_name"].'</td>
                        <td>'.$row["cat_name"].'</td>
                        <td><img src="../admin/'.$row["prod_image"].'"  width=60px></td>
                        <td>'.$row["ord_quantity"].'</td>
                    </tr>
                ';
            };
    echo'
                   
                </tbody>
            </table>
        </div>
    </div>
        <div>
        <button class="btn btn-theme m-4 mt-1" id="cancelOrder" data-toggle="modal" data-target="#DelConfirmModal" data-id="'.$oid.'">Cancel Order</button>
        <a class="btn btn-theme m-4 mt-1" href="orders.php">&larr; Back</a>

        </div>
        ';
}
if(isset($_POST["ord"])){
    $oid=$_POST["ord"];
    $query="SELECT * FROM orders o INNER JOIN user u ON o.ord_user=u.user_id INNER JOIN user_details d ON o.ord_user=d.dt_user INNER JOIN products p ON o.ord_product=p.prod_id INNER JOIN brands b ON p.prod_brand=b.brand_id INNER JOIN order_status s ON o.ord_status=os_id INNER JOIN category c ON p.prod_category=c.cat_id WHERE ord_receipt_no='$oid';
    ";
    $res=mysqli_query($conn,$query);
    $query2="SELECT SUM(ord_amount) AS amount FROM orders WHERE ord_receipt_no='$oid';";
    $res2=mysqli_query($conn,"$query2");
    $am=mysqli_fetch_assoc($res2);
    $amount=$am["amount"];
    $dt=mysqli_fetch_assoc($res);
    $remarks=$dt["ord_remarks"];
    echo'<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Order Amount</th>
                </tr>
                <tr>
                    <td>'.$oid.'</td>
                    <td>'.$amount.'</td>
                </tr>
                <tr>
                    <th colspan="4">Remarks</th>
                </tr>
                <tr>
                    <td colspan="4">';
                    if($remarks){
                        echo $remarks;
                    } else{echo'None';}
                    echo'</td>
                </tr>
                <tr>
                    <th colspan="4">Order Status</th>
                </tr>
                <tr>
                    <td colspan="4">'.$dt["os_status"].'</td>
                </tr>
                              
            </thead>
            </tbody>
            </table>                            
            
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Brand Name</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Quantity</th>
                </tr> 
                <tbody> ';
    $query2="SELECT * FROM orders o INNER JOIN products p ON o.ord_product=p.prod_id INNER JOIN brands b ON p.prod_brand=b.brand_id INNER JOIN category c ON p.prod_category=c.cat_id WHERE ord_receipt_no='$oid';";
    $res=mysqli_query($conn,$query2);
    while($row=mysqli_fetch_array($res)){
        echo'                           
                    <tr>
                        <td>'.$row["prod_name"].'</td>
                        <td>'.$row["brand_name"].'</td>
                        <td>'.$row["cat_name"].'</td>
                        <td><img src="../admin/'.$row["prod_image"].'"  width=60px></td>
                        <td>'.$row["ord_quantity"].'</td>
                    </tr>
                ';
            };
    echo'
                   
                </tbody>
            </table>
        </div>
    </div>
        <div>
        <a class="btn btn-theme m-4 mt-1" href="orders.php">&larr; Back</a>

        </div>
        ';
}
?>