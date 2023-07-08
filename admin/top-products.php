<?php
require_once "header.php";
 
//TOP 10 CUSTOMERS//
// $query="SELECT  ord_user , count(`ord_id`) from orders group by ord_user ORDER BY count(`ord_id`) DESC  LIMIT 1 OFFSET 0;";
// $res=mysqli_query($conn,$query);
?>


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
                                            <th>Sales</th>
                                        </tr>
                                    </thead>                                   
                                    <tbody>
                                        <?php
                                            $query="SELECT prod_id,prod_name,brand_name, SUM(`ord_quantity`) AS quant from orders o INNER JOIN user u ON o.ord_user=u.user_id INNER JOIN products p ON o.ord_product=p.prod_id INNER JOIN brands b ON b.brand_id=p.prod_brand group by ord_product ORDER BY quant DESC LIMIT 10 OFFSET 0;";
                                            $res=mysqli_query($conn,$query);
                                            while($row=mysqli_fetch_assoc($res)){
                                                echo'
                                                <tr>
                                                    <td>'.$row["prod_id"].'</td>
                                                    <td>'.$row["prod_name"].'</td>
                                                    <td>'.$row["brand_name"].'</td>
                                                    <td>'.$row["quant"].'</td>
                                                </tr>';
                                            };
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



<?php
require_once("footer.php");

?>