<?php
require_once "header.php"

?>

<!-- Begin Page Content -->
<div class="container-fluid">
 <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 ml-3 mb-0 text-gray-800">Dashboard</h1>
</div>


<!-- Content Row -->
<!-- first Div -->

<div class="row">

    <!-- Delivere Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow mr-2 h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Delivered Orders</div>
                                            <div class="h1 mb-0 font-weight-bold text-gray-800"><?php
                                            $query="SELECT count(*) AS delivered FROM (SELECT count(ord_receipt_no) FROM orders WHERE ord_status=3 GROUP BY ord_receipt_no ORDER BY ord_status) AS oldpend;
                                            ";
                                            $res=mysqli_query($conn,$query);
                                            $row=mysqli_fetch_assoc($res);
                                            echo$row["delivered"];
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-double fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
     <!-- In-process Requests Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow mr-2 h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                               In-process Orders</div>
                                            <div class="h1 mb-0 font-weight-bold text-gray-800"><?php
                                            $query="SELECT count(*) AS inprocess FROM (SELECT count(ord_receipt_no) FROM orders WHERE ord_status=2 GROUP BY ord_receipt_no ORDER BY ord_status) AS subquery";
                                            $res=mysqli_query($conn,$query);
                                            $row=mysqli_fetch_assoc($res);
                                            echo$row["inprocess"];
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shipping-fast fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

    <!-- Cancelled Requests Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow mr-2 h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            Cancelled Orders</div>
                                            <div class="h1 mb-0 font-weight-bold text-gray-800"><?php
                                            $query="SELECT count(*) AS cancelled FROM (SELECT count(ord_receipt_no) FROM orders WHERE ord_status=4 GROUP BY ord_receipt_no ORDER BY ord_status) AS oldpend;
                                            ";
                                            $res=mysqli_query($conn,$query);
                                            $row=mysqli_fetch_assoc($res);
                                            echo$row["cancelled"];
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-close fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow mr-2 h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Orders</div>
                                            <div class="h1 mb-0 font-weight-bold text-gray-800"><?php
                                            $query="SELECT count(*) AS pending FROM (SELECT count(ord_receipt_no) FROM orders WHERE ord_status=1 GROUP BY ord_receipt_no ORDER BY ord_status) AS subquery;
                                            ";
                                            $res=mysqli_query($conn,$query);
                                            $row=mysqli_fetch_assoc($res);
                                            echo$row["pending"];
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


<!-- Content Row -->
<!-- Second Div -->
<!-- <div class="row"> -->

<!-- Top 10 products -->
       <!-- Top Products Table -->
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h1 class="m-0 font-weight-bold text-primary">Top Selling Products</h1>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Brand</th>
                                        </tr>
                                    </thead>                                   
                                    <tbody>
                                        <?php
                                            $query="SELECT prod_id, prod_name,brand_name FROM products p inner join brands b on b.brand_id=p.prod_brand ";
                                            $res=mysqli_query($conn,$query);
                                            while($row=mysqli_fetch_assoc($res)){
                                                echo'
                                                <tr>
                                                    <td>'.$row["prod_id"].'</td>
                                                    <td>'.$row["prod_name"].'</td>
                                                    <td>'.$row["brand_name"].'</td>
                                                </tr>';
                                            };
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

<!-- Earnings (Monthly) Card Example -->
<!-- Top Products Table -->
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h1 class="m-0 font-weight-bold text-primary">Top Business Customers</h1>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Items</th>
                                        </tr>
                                    </thead>                                   
                                    <tbody>
                                        <?php
                                            $query="SELECT  ord_user,user_name, count(`ord_quantity`) from orders o INNER JOIN user u ON o.ord_user=u.user_id group by ord_user ORDER BY count(`ord_quantity`) DESC  LIMIT 10 OFFSET 0";
                                            $res=mysqli_query($conn,$query);
                                            $i=0;
                                            while($row=mysqli_fetch_assoc($res)){
                                                $i++;
                                                echo'
                                                <tr>
                                                    <th>'.$i.'</th>
                                                    <td>'.$row["user_name"].'</td>
                                                    <td>'.$row["count(`ord_quantity`)"].'</td>
                                                </tr>';
                                            };
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

 
                    <!-- </div> -->
                <!-- /.container-fluid -->

<?php

require_once "footer.php"

?>
