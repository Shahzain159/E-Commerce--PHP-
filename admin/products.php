<!-- <script>
    document.onload.preventDefault();
</script> -->
<?php
require_once "header.php";

if(isset($_POST["addProduct"])){
$name=$_POST["prodName"];
$brand=$_POST["brand"];
$category=$_POST["category"];
$subCategory=$_POST["subCategory"];
$stock=$_POST["stock"];
$price=$_POST["price"];
$imgName=$_FILES["image"]["name"];
$tmpFile=$_FILES["image"]["tmp_name"];
$path='img/'.time().$imgName;
$xt=explode('.',$imgName);
$type=end($xt);
$ext=array('jpg','jpeg','png','jfif');
if(in_array($type,$ext)){
    move_uploaded_file($tmpFile,$path);
    $query="INSERT INTO products VALUE(NULL,'$name',$brand,$category,$subCategory,$price,'$path');";
    mysqli_query($conn,$query);
    $last_id = mysqli_insert_id($conn);
    mysqli_query($conn,"INSERT INTO stock VALUES(NULL,$last_id,$stock)");
    // echo '
    // <div id="alertmsg">
    // <div class="alert alert-success d-flex align-items-center">
    // <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    //     <div>
    //         Product added successfully
    //     </div>
    //     <button type="button" class="btn-close bi bi-x-lg" data-bs-dismiss="alert" aria-label="Close"><i class="fa-duotone fa-xmark"></i></button>
    // </div>
    // </div>';
} else{
    echo "<script>alert('Invalid File Type.!')</script>";
};
};

if(isset($_POST["del_btn"])){
    $did=$_POST["del_id"];
    $orderCheck=mysqli_query($conn,"SELECT * FROM orders WHERE ord_product=$did");
    if(mysqli_num_rows($orderCheck)){
        echo '<div class="alert alert-warning alert-dismissible d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          You have orders pending for this product
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fa-duotone fa-xmark"></i></button>';
    } else{        
        $res=mysqli_query($conn,"SELECT * FROM products WHERE prod_id=$did");
        $row=mysqli_fetch_assoc($res);
        $file=$row["prod_image"];
        unlink($file);
        mysqli_query($conn,"DELETE FROM stock WHERE stk_product=$did");
        mysqli_query($conn,"DELETE FROM products WHERE prod_id=$did");
        // echo '
        // <div id="alertmsg">
        //     <div class="alert alert-danger d-flex align-items-center">
        //         <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#check-circle-fill"/></svg>
        //         <div>
        //             Product Deleted successfully
        //         </div>
        //         <button type="button" class="" data-bs-dismiss="alert" aria-label="Close"><i class="fa-duotone fa-xmark"></i></button>                
        //     </div>
        // </div>
        // ';
    }
};
if(isset($_POST["updProduct"])){
    $id=$_POST["prodId"];
    $name=$_POST["updProdName"];
    $brand=$_POST["updBrand"];
    $category=$_POST["updCategory"];
    $subCategory=$_POST["updSubC"];
    $stock=$_POST["updStock"];
    $price=$_POST["updPrice"];
    if($_FILES["image"]["error"]==0){
        $imgName=$_FILES["image"]["name"];
        $tmpFile=$_FILES["image"]["tmp_name"];
        $path='img/'.time().$imgName;
        $xt=explode('.',$imgName);
        $type=end($xt);
        $ext=array('jpg','jpeg','png','jfif');
        if(in_array($type,$ext)){
            $res=mysqli_query($conn,"SELECT * FROM products WHERE prod_id=$id");
            $row=mysqli_fetch_assoc($res);
            $oldimg=$row["prod_image"];
            unlink($oldimg);
            move_uploaded_file($tmpFile,$path);
            $query="UPDATE products SET prod_name='$name',prod_brand=$brand,prod_category=$category,prod_subcategory=$subCategory,prod_price=$price,prod_image='$path' WHERE prod_id=$id;";
            mysqli_query($conn,$query);
            mysqli_query($conn,"UPDATE stock SET stk_quantity=$stock WHERE stk_product=$id");

               } else{
            // echo "<script>alert('Invalid File Type.!')</script>";
            print_r($_FILES["image"]);
        }; 
    } else{
    $query="UPDATE products SET prod_name='$name',prod_brand=$brand,prod_category=$category,prod_subcategory=$subCategory,prod_price=$price WHERE prod_id=$id;";
    mysqli_query($conn,$query);  
    mysqli_query($conn,"UPDATE stock SET stk_quantity=$stock WHERE stk_product=$id");
};
}


?>

<!--Alert SVGs -->

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
</svg>


<!-- Confirmation Alerts -->

<div class="alert alert-success" role="alert" id="alert_success" hidden>
  Operation completed.
</div>

<div class="alert alert-danger" role="alert" id="alert_delete" hidden>
  Deleted successfully.
</div>

<!---Product Add & Edit Form--->
    <div class="container mt-4" id="data_form"> 
            <?php
            
                           echo '<h1 class="h3 mb-2 text-gray-800">Add Product</h1>
                <form class="user" method="post" enctype="multipart/form-data" id="addProduct">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="name" name="prodName" id="prodName" class="form-control"
                                placeholder="Enter Product Name">
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <select name="brand" id="" class="py-2 form-control" placeholder="Select Brand">
                                <option selected value=0>Select Brand</option>
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
                            <select name="category" id="" class="py-2 form-control" placeholder="Select Category">
                                <option selected value=1>Select Category</option>
                                ';
                                $query="SELECT * FROM category";
                                $res=mysqli_query($conn,$query);
                                while($row=mysqli_fetch_assoc($res)){
                                echo '<option value="'.$row["cat_id"].'">'.$row["cat_name"].'</option>';
                                };
                            echo '
                            </select>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                        <select name="subCategory" id="" class="py-2 form-control" placeholder="Select Sub-category">
                            <option selected value=1>Select Sub-category</option>
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
                            <input type="number" value="" name="price" class="form-control" placeholder="Enter Price">
                        </div>           
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="number" value="" name="stock" class="form-control" placeholder="Enter Stock">
                        </div>                    
                    </div>
                    <div class="form-group row">
                    <input type="file" name="image" class="col-sm-6 mb-3 mb-sm-0">
                    </div>
                    <input type="submit" name="addProduct" class="btn btn-dark mt-3 col-sm-2" value="Add" id="prod-ad">
                    <hr>                                        
                </form>';
            
            ?>       
        </div>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Products</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">View Products</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Image</th>
                        <th>Delete</th>
                        <th>Update</th>
                    </tr>
                </thead>                                   
                <tbody><?php
                        $query="SELECT * FROM products p INNER JOIN category c ON p.prod_category=c.cat_id INNER JOIN brands b ON p.prod_brand=b.brand_id;";
                        $res=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_assoc($res)){
                            echo'
                            <tr>
                                <td>'.$row["prod_id"].'</td>
                                <td>'.$row["prod_name"].'</td>
                                <td>'.$row["brand_name"].'</td>
                                <td><img src="'.$row["prod_image"].'" width=60px></td>
                                <td><a class="btn btn-danger delBtn" data-id="'.$row["prod_id"].'" data-toggle="modal" data-target="#DelConfirmModal">Delete</a></</td>
                                <td><a class="btn btn-warning set_pid" data-id="'.$row["prod_id"].'" >Details</a></td>
                            </tr>';
                        };
                    
                    ?></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



<?php

require_once "footer.php"

?>