<?php
require_once "header.php";

if(isset($_POST["addBrand"])){
    $name=$_POST["brandName"];
    $cat=$_POST["category"];
    $query="INSERT INTO brands VALUE(NULL,'$name',$cat);";
    mysqli_query($conn,$query);
    echo '<div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          New Brand added.
        </div>
        <button type="button" class="fas fa-scross" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
};
if(isset($_POST["updBrand"])){
    $uid=$_POST["brandId"];
    $name=$_POST["updBrandName"];
    $cat=$_POST["updCat"];
    $query="UPDATE brands SET brand_name='$name', brand_category=$cat WHERE brand_id=$uid;";
    mysqli_query($conn,$query);
    echo '<div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Brand updated.
        </div>
        <button type="button" class="fas fa-solid fa-xmark" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
};
if(isset($_POST["del_btn"])){
    $did=$_POST['del_id'];
    $brandcheck=mysqli_query($conn,"SELECT * FROM products WHERE prod_brand=$did");
    if(mysqli_num_rows($brandcheck)){
        echo '<div class="alert alert-warning alert-dismissible d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Brand cannot be deleted if products are available of this brand.
        </div>
        <button type="button" class="fas fa-solid fa-xmark" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        
} else{
    mysqli_query($conn,"DELETE from brands WHERE brand_id=$did");
    echo '<div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Successully Deleted.
        </div>
        <button type="button" class="fas fa-solid fa-xmark" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}}


?>
<!---Product Add & Edit Form--->
    <div class="container"> 
            <?php
            
            if(isset($_GET["uid"])){
            $uid=$_GET["uid"];
            $query="SELECT * FROM brands WHERE brand_id=$uid;";
            $res=mysqli_query($conn,$query);
            $dt=mysqli_fetch_assoc($res);
                echo '<h1 class="h3 mb-2 text-gray-800">Edit Brand</h1>
                <form class="user" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                        <input type=number hidden="true" name="brandId" value="'.$uid.'">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="name" placeholder="Enter Brand Name" value="'.$dt["brand_name"].'" name="updBrandName" class="form-control">
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <select name="updCat" id="" class="py-2 form-control" placeholder="Select Brand">
                                    <option selected value='.$dt["brand_category"].'>Select Category</option>
                                    ';
                                    $query="SELECT * FROM category";
                                    $res=mysqli_query($conn,$query);
                                    while($row=mysqli_fetch_assoc($res)){
                                    echo '<option value="'.$row["cat_id"].'">'.$row["cat_name"].'</option>';
                                    };
                               echo '
                                </select>
                            </div>
                        </div>                        
                            <input type="submit" name="updBrand" class="btn btn-warning alert_close" value="Update">                                        
                            <hr>
                                            
                </form>';
            } else{
                echo '<h1 class="h3 mb-2 text-gray-800">Add Brand</h1>
                <form class="user" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="name" value="" placeholder="Enter Brand Name" name="brandName" class="form-control">
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <select name="category" id="" class="py-2 form-control" placeholder="Select Category">
                                    <option selected value="0">None</option>
                                    ';
                                    $query="SELECT * FROM category";
                                    $res=mysqli_query($conn,$query);
                                    while($row=mysqli_fetch_assoc($res)){
                                    echo '<option value="'.$row["cat_id"].'">'.$row["cat_name"].'</option>';
                                    };
                               echo '
                                </select>
                            </div>
                        </div>                        
                            <input type="submit" name="addBrand" class="btn btn-dark w-25 alert_close" value="Add">                                        
                            <hr>
                                            
                </form>';
            };
            
            ?>       
        </div>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Brands</h1>


                    <!-- Data Tables -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">View Brands</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Brand</th>
                                            <th>Category</th>
                                            <th>Delete</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>                                   
                                    <tbody>
                                        <?php
                                            $query="SELECT * FROM brands b INNER JOIN category c ON b.brand_category=c.cat_id";
                                            $res=mysqli_query($conn,$query);
                                            while($row=mysqli_fetch_assoc($res)){
                                                echo'
                                                <tr>
                                                    <td>'.$row["brand_id"].'</td>
                                                    <td>'.$row["brand_name"].'</td>
                                                    <td>'.$row["cat_name"].'</td>
                                                    <td><a class="btn btn-danger delBtn" href="#" data-id="'.$row["brand_id"].'" data-toggle="modal" data-target="#DelConfirmModal">Delete</a></</td>
                                                    <td><a class="btn btn-warning" href="brands.php?uid='.$row["brand_id"].'">Update</a></td>
                                                </tr>';
                                            };
                                        ?>
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