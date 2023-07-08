<?php
$conn=mysqli_connect("localhost","root","","db_glamglow");

if(isset($_POST["ordId"])){
$id=$_POST["ordId"];
$res=mysqli_query($conn,"SELECT * FROM orders o INNER JOIN products p ON o.ord_product=p.prod_id WHERE ord_user=$userId");
while($row=mysqli_fetch_assoc(($res))){
    echo'
    <div class="order container border">
        <div class="">
            <div class="pull-left">
                <div class="font-weight-bold">Order <a class="link"> #153368946752954</a></div>
                <p class="">Placed on 28 Nov 2022  14:52:21</p>
            </div>
                <div class="pull-cont"></div>
                <a class="pull-right" href="#" style="color: rgb(26, 156, 183);">MANAGE</a>
            </div>
            <div class="order-item">
                <div class="item-pic">
                    <a href="#"><img src="../admin/img/1685600086loreal facepowd1.png" class="m-4" height="200" width="200"></a>
                </div>
                <div class="item-main item-main-mini">
                    <div>
                        <div class="text title item-title"><h6>'.$row["prod_name"].'</h6></div>
                        <p class="text desc bold"></p>
                    </div>
                </div>
                <div class="item-quantity" data-spm-anchor-id="a2a0e.order_list.0.i1.1cff7d686nOkeq">
                    <span>
                        <span class="text desc info multiply">Qty:</span>
                        <span class="text">&nbsp;1</span>
                    </span>
                </div>
                <div class="item-status item-capsule"><p class="capsule">Delivered</p></div>
                <div class="item-info"><p class="text delivery-success">Delivered on 19 Dec 2022</p>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    ';
}
}


?>