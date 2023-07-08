<?php
$conn= mysqli_connect("localhost","root","","db_glamglow");

//Product Detail View
if(isset($_POST["pid"])){
    $pid=$_POST["pid"];
                $query="SELECT * FROM products p INNER JOIN category c ON p.prod_category=c.cat_id INNER JOIN brands b ON p.prod_brand=b.brand_id INNER JOIN stock s ON s.stk_product=p.prod_id INNER JOIN sub_category u ON u.subcat_maincat=c.cat_id WHERE prod_id=$pid;";
                $res=mysqli_query($conn,$query);
                $dt=mysqli_fetch_assoc($res);
                echo '
                <form id="detailForm">
                <h1 class="h3 mb-2 text-gray-800">Product Details</h1>
                        <div class="row">
                        <div class="col">
                            <div class="col mb-3 mb-sm-0">                            
                                <label for="prodName" class="mt-3">Product Name</label>
                                <input type="hidden" value="'.$pid.'" name="prodId">
                                <input type="name" id="prodName" value="'.$dt["prod_name"].'" name="updProdName" class="form-control" disabled>
                            </div>
                            <div class="col mb-3 mb-sm-0">                            
                            <label for="brand" class="mt-3">Brand</label>
                                <input value="'.$dt["brand_name"].'" class="form-control" disabled>
                            </div>
                            <div class="col mb-3 mb-sm-0">                            
                            <label for="category" class="mt-3">Category</label>
                                <input value="'.$dt["cat_name"].'" class="form-control" disabled>
                            </div>
                            <div class="col mb-3 mb-sm-0">                            
                            <label for="subcategory" class="mt-3">Sub Category</label>
                                <input value="'.$dt["subcat_name"].'" class="form-control" disabled>
                            </div>
                                <div class="col mb-3 mb-sm-0">                            
                                <label for="prodStock" class="mt-3">Stock</label>
                                    <input type="number" id="prodStock" value="'.$dt["stk_quantity"].'" name="updStock" class="form-control disabled" disabled>
                                </div>
                                <div class="col mb-3 mb-sm-0">                            
                                <label for="prodName" class="mt-3">Product Price</label>
                                <input type="name" id="prodPrice" value="'.$dt["prod_price"].'" name="updPrice" class="form-control" disabled>
                            </div> 
                            </div>
                            <div  class="col-sm-6 mb-3 mb-sm-0">
                            <div>
                            <label for="coverImage" class="mt-3 mb-4">Product Cover Image</label>
                            </div>
                                <img id="coverImage" src="'.$dt["prod_image"].'" height="450" width="350" class="border">
                            </div>
                            </div>                               
                        </form>

                        <button class="btn btn-warning mt-3" id="prod_upd" data-id="'.$pid.'">Edit</button>


                <button class="btn btn-dark mt-3" id="view_img" data-id="'.$pid.'">View Images</button>

            

                <a class="btn btn-info mt-3" href="products.php">&larr; Back</a>
                <hr>
                ';
};

// Product Image Gallery

if(isset($_POST["vid"])){
    $id=$_POST["vid"];
    $query="SELECT * FROM product_images WHERE pi_product=$id";
    $res=mysqli_query($conn,$query);
        echo '<div class="container row">';
        if(mysqli_num_rows($res)){
    while($row=mysqli_fetch_assoc($res)){
        echo'
        <div class="col-sm-2 mb-sm-0 m-2">
        <img src="'.$row["pi_image"].'" class="col border">
        <hr>
        <a class="btn btn-danger imgDelBtn" data-id="'.$row["pi_id"].'" data-toggle="modal" data-target="#ImgDelModal">Delete</a>
        </div>
        
        ';
    }
} else{
    echo'No images found, upload images first.';
}
    echo'</div>
    <button class="btn btn-dark mt-3" id="multipleImages" data-id="'.$id.'">Add mulitple Images</button>
    <a class="btn btn-info mt-3 set_pid" data-id="'.$id.'">&larr; Back</a>
    <hr>                                        

    ';
}

//Delete image from gallery

if(isset($_POST["imgDel"])){
    $id=$_POST["imgDel"];
    $select="SELECT * FROM product_images WHERE pi_id=$id";
    $res=mysqli_query($conn,$select);
    $row=mysqli_fetch_assoc($res);
    $delImg=$row["pi_image"];
    unlink($delImg);
    $delete="DELETE FROM product_images WHERE pi_id=$id";
    mysqli_query($conn,$query);
}

//Product Update

if(isset($_POST["uid"])){
    $uid=$_POST["uid"];
    $query="SELECT * FROM products p INNER JOIN category c ON p.prod_category=c.cat_id INNER JOIN brands b ON p.prod_brand=b.brand_id INNER JOIN stock s ON s.stk_product=p.prod_id INNER JOIN sub_category u ON u.subcat_maincat=c.cat_id WHERE prod_id=$uid;";
    $res=mysqli_query($conn,$query);
    $dt=mysqli_fetch_assoc($res);
    echo '
    <form class="user" method="post" enctype="multipart/form-data" id="detailForm">
    <h1 class="h3 mb-2 text-gray-800">Product Details</h1>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">                            
                    <label for="prodName">Product Name</label>
                    <input type="hidden" value="'.$uid.'" name="prodId">
                    <input type="name" id="prodName" value="'.$dt["prod_name"].'" name="updProdName" class="form-control">
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">                            
                <label for="brand">Brand</label>
                    <select name="updBrand" id="brand" class="py-2 form-control" placeholder="Select Brand">
                        <option selected value='.$dt["brand_id"].'>'.$dt["brand_name"].'</option>
                        ';
                        $query="SELECT * FROM brands";
                        $res=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_assoc($res)){
                        echo '<option value="'.$row["brand_id"].'">'.$row["brand_name"].'</option>';
                        };
                   echo '
                    </select>
                </div>                            
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">                            
                <label for="category">Category</label>
                    <select name="updCategory" id="category" class="py-2 form-control" placeholder="Select Category">
                        <option selected value='.$dt["cat_id"].'>'.$dt["cat_name"].'</option>
                        ';
                        $query="SELECT * FROM category";
                        $res=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_assoc($res)){
                        echo '<option value="'.$row["cat_id"].'">'.$dt["cat_name"].'</option>';
                        };
                   echo '
                    </select>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">                            
                <label for="subcategory">Sub Category</label>
                    <select name="updSubC" id="subcategory" class="py-2 form-control" placeholder="Select Sub-Category">
                        <option selected value='.$dt["subcat_id"].'>'.$dt["subcat_name"].'</option>
                        ';
                        $query="SELECT * FROM sub_category";
                        $res=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_assoc($res)){
                        echo '<option value="'.$row["subcat_id"].'">'.$row["subcat_name"].'</option>';
                        };
                   echo '
                    </select>
                </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">                            
                    <label for="prodStock">Stock</label>
                        <input type="number" id="prodStock" value="'.$dt["stk_quantity"].'" name="updStock" class="form-control">
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">                            
                    <label for="prodName">Product Price</label>
                    <input type="name" id="prodPrice" value="'.$dt["prod_price"].'" name="updPrice" class="form-control">
                </div>
                </div> 
                <div class="form-group row">                      
                    <div class="col-sm-6 mb-3 mb-sm-0">                            
                    <label for="prodImage">Product Image</label>
                        <input type="file" id="prodImage" name="image" class="form-control">
                    </div>
                </div>
                <button type="submit" name="updProduct" class="btn btn-warning set_pid" id="prod-upd" data-id="'.$uid.'">Update</button>                                        
                
                                
    </form>
    <button class="btn btn-dark mt-3" id="multipleImages" data-id="'.$uid.'">Add mulitple Images</button><br>
    <a class="btn btn-info mt-3 set_pid" data-id="'.$uid.'">&larr; Back</a>
    <hr>
    ';}

    //Multiple Images Upload

if(isset($_POST["multi"])){
    $id=$_POST["multi"];
    $res=mysqli_query($conn,"SELECT * FROM products WHERE prod_id=$id");
    $row=mysqli_fetch_assoc($res);

    echo'<div id="uploadForm" class="m-4 w-50">
    <form method="post" enctype="multipart/form-data">    
        <input type="hidden" value="'.$id.'" name="multiId">
        <label for="product">Product</label>
        <input type="text" id="product" value="'.$row["prod_name"].'" disabled class="form-control">
        <label for="images">Choose Images</label>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">       
                <input type="file" name="images[]" id="images" multiple class="form-control">
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="submit" name="multiUpload" value="UPLOAD" class="btn btn-primary form-control set_pid" id="img-upl"  data-id="'.$id.'">
        </div>
        </div>
    </form>
    <a class="btn btn-info mt-3 set_pid" data-id="'.$id.'">&larr; Back</a>
</div>';
}
if(isset($_POST["added"])){
    echo'
    <div class="alert-success d-flex align-items-center">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
            Product added successfully
        </div>
    </div>
    ';
}
if(isset($_POST["update"])){
    echo'
    <div class="alert-success d-flex align-items-center">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
            Product updated successfully
        </div>
    </div>
    ';
}
if(isset($_POST["upload"])){
    echo'
    <div class="alert-success d-flex align-items-center">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
            Images uploaded successfully
        </div>
    </div>
    ';
}
if(isset($_POST["multiUpload"])){ 
    // File upload configuration 
    $id=$_POST["multiId"];
    $targetDir = "img/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    foreach($_FILES['images']['name'] as $key=>$val){ 
        $image_name = $_FILES['images']['name'][$key]; 
        $tmp_name   = $_FILES['images']['tmp_name'][$key];
         
        // File upload path 
        $fileName = basename($_FILES['images']['name'][$key]); 
        $targetFilePath = $targetDir . $fileName; 
         
        // Check whether file type is valid 
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
        if(in_array($fileType, $allowTypes)){     
            // Store images on the server 
            if(move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetFilePath)){ 
                mysqli_query($conn,"INSERT INTO product_images VALUES(NULL,$id,'$targetFilePath')");
            } 
        } else{
            echo '
        <div id="alertmsg">
            <div class="alert alert-danger d-flex align-items-center">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    Invalid File Type. Only '.$allowTypes.' file types allowed.                
                </div>
                <button type="button" class="" data-bs-dismiss="alert" aria-label="Close"><i class="fa-duotone fa-xmark"></i></button>                
            </div>
        </div>
        ';
        }
    }
}
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
                    <th>Customer Name</th>
                    <th>Contact No.</th>
                    <th>Alternate No.</th>
                </tr>
                <tr>
                    <td>'.$oid.'</td>
                    <td>'.$dt["user_name"].'</td>
                    <td>'.$dt["user_contact"].'</td>
                    <td>'.$dt["dt_workphone"].'</td>
                </tr>
                <tr>
                    <th colspan="4">Customer Remarks</th>
                </tr>
                <tr>
                    <td colspan="4">';
                    if($remarks){
                        echo $remarks;
                    } else{echo'None';}
                    echo'</td>
                </tr>
                <tr>
                    <th colspan="4">Shipping Address</th>
                </tr>
                <tr>
                    <td colspan="4">'.$dt["dt_address"].'</td>
                </tr>
                <tr>
                    <th colspan="2">Order Status</th>
                    <th colspan="2">Order Amount</th>
                </tr>
                <tr>
                    <td colspan="2">'.$dt["os_status"].'</td>
                    <td colspan="2">'.$amount.'</td>
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
                    <th>Amount</th>
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
                        <td><img src="'.$row["prod_image"].'"  width=60px></td>
                        <td>'.$row["ord_quantity"].'</td>
                        <td>'.$row["ord_amount"].'</td>
                    </tr>
                ';
            };
    echo'
                   
                </tbody>
            </table>
        </div>
    </div>
        <div>
        <button class="btn btn-warning ml-4 mb-4" id="ordStatus" data-id="'.$oid.'">Update Status</button>
        <a class="btn btn-info ml-2 mb-4" href="orders.php">&larr; Back</a>

        </div>
        ';
    
}
if(isset($_POST["stid"])){
    $oid=$_POST["stid"];
    $query="SELECT * FROM orders o INNER JOIN user u ON o.ord_user=u.user_id INNER JOIN user_details d ON o.ord_user=d.dt_user INNER JOIN products p ON o.ord_product=p.prod_id INNER JOIN brands b ON p.prod_brand=b.brand_id INNER JOIN order_status s ON o.ord_status=os_id INNER JOIN category c ON p.prod_category=c.cat_id WHERE ord_receipt_no='$oid';
    ";
    $res=mysqli_query($conn,$query);
    $dt=mysqli_fetch_assoc($res);
    $status=$dt["ord_status"];
    $remarks=$dt["ord_remarks"];
    echo'<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tr>
                    <th>Order Id</th>
                    <th>Customer Name</th>
                    <th>Contact No.</th>
                    <th>Alternate No.</th>
                </tr>
                <tr>
                    <td>'.$oid.'</td>
                    <td>'.$dt["user_name"].'</td>
                    <td>'.$dt["user_contact"].'</td>
                    <td>'.$dt["dt_workphone"].'</td>
                </tr>
                <tr>
                    <th colspan="4">Customer Remarks</th>
                </tr>
                <tr>
                    <td colspan="4">';
                    if($remarks){
                        echo $remarks;
                    } else{echo'None';}
                    echo'</td>
                </tr>
                <tr>
                    <th colspan="4">Shipping Address</th>
                </tr>
                <tr>
                    <td colspan="4">'.$dt["dt_address"].'</td>
                </tr>
                <tr>
                    <th colspan="4">Order Status</th>
                </tr>
                <tr>
                    <td>
                            <select class="form-control" name="status" id="ord_status">
                            <option value="'.$dt["os_id"].'" selected>'.$dt["os_status"].'</option>';
                            $res=mysqli_query($conn,"SELECT * FROM order_status WHERE os_id!=$status");
                            while($row=mysqli_fetch_assoc($res)){
                                echo'<option value="'.$row["os_id"].'">'.$row["os_status"].'</option>';
                            };

                                
                echo '
                        </select>
                    </td>
                    <td colspan="3"><button class="btn btn-dark" id="upd_st" data-id="'.$oid.'">Update</button</td>

                </tr>
                    
            </tbody>
            </table>
        </div>
    </div>
    <button class="btn btn-info ml-4 mb-4 ord_det" data-id="'.$oid.'">&larr; Back</button>
    
    ';
}
if(isset($_POST["odid"])){
    $oid=$_POST["odid"];
    $ost=$_POST["os"];
    mysqli_query($conn,"UPDATE orders SET ord_status=$ost WHERE ord_receipt_no='$oid'");
    echo'<div class="alert alert-success d-flex align-items-center">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
            Status updated successfully
        </div>
    </div>';
}
if(isset($_POST["sid"])){
    $sid=$_POST["sid"];
    $query="SELECT * FROM products p INNER JOIN stock s ON s.stk_product=p.prod_id INNER JOIN brands b ON b.brand_id=p.prod_brand WHERE prod_id=$sid";
    $res=mysqli_query($conn,$query);
    $row=mysqli_fetch_assoc($res);
    echo'
                <h1 class="h3 mb-2 text-gray-800">Product Details</h1>
                        <div class="row">
                            <div class="col mb-3 mb-sm-0">                            
                                <label for="prodName" class="mt-3">Product Name</label>
                                <input type="hidden" value="'.$sid.'" name="prodId">
                                <input type="name" id="prodName" value="'.$row["prod_name"].'" name="updProdName" class="form-control" disabled>
                            </div>
                            <div class="col mb-3 mb-sm-0">                            
                            <label for="brand" class="mt-3">Brand</label>
                                <input value="'.$row["brand_name"].'" class="form-control" disabled>
                            </div>
                                <div class="col mb-3 mb-sm-0">                            
                                <label for="prodStock" class="mt-3">Stock</label>
                                    <input type="number" id="prodStock" value="'.$row["stk_quantity"].'" name="updStock" class="form-control disabled">
                                </div>
                            </div>
                            <button class="btn btn-warning mt-3" id="stk_upd" data-id="'.$sid.'">Update</button>       

                <a class="btn btn-info mt-3" href="stock.php">&larr; Back</a>
                <hr>
                ';
    
}
if(isset($_POST["skid"])){
$id=$_POST["skid"];
$stk=$_POST["stk"];
$query="UPDATE stock SET stk_quantity=$stk WHERE stk_product=$id";
mysqli_query($conn,$query);
echo'
<div class="alert alert-success d-flex align-items-center">
     <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
         <div>
             Stock updated successfully
         </div>
     </div>
';
}

?>