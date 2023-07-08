<?php
require_once "header.php";
 
//TOP 10 CUSTOMERS//
// $query="SELECT  ord_user , count(`ord_id`) from orders group by ord_user ORDER BY count(`ord_id`) DESC  LIMIT 1 OFFSET 0";
// $res=mysqli_query($conn,$query);
?>


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



<?php
require_once("footer.php");

?>