<?php
require_once "header.php";

if(isset($_POST["del_btn"])){
    $id=$_POST["del_id"];
    $catecheck=mysqli_query($conn,"SELECT * FROM products WHERE prod_category=$id");
    if(mysqli_num_rows($catecheck)){
        echo 
        '<div class="alert alert-warning alert-dismissible d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Category cannot be deleted if products are available in this category.
        </div>
        <button type="button" class="fas fa-solid fa-xmark" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        
} else{
    mysqli_query($conn,"DELETE FROM `category` WHERE cat_id='$id'");
    echo '<div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Successully Deleted.
        </div>
        <button type="button" class="fas fa-solid fa-xmark" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}
      
    };

if(isset($_POST["updCategory"])){    
    $uid=$_POST["updCatId"];
    $updName=$_POST["updCatName"];
    mysqli_query($conn,"UPDATE category SET cat_name='$updName' WHERE cat_id=$uid;");
    echo '<script type="text/javascript">
    window.location = "category.php";
    </script>';
};

if(isset($_POST["addCategory"])){
    $catName=$_POST["catName"];
    mysqli_query($conn,"INSERT INTO category VALUES(NULL,'$catName')");
};
if(isset($_POST["addSubCategory"])){
    $subCat=$_POST["subCategory"];
    $mainCat=$_POST["category"];
    if($mainCat==0){
        echo'<div class="alert alert-warning alert-dismissible d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Select Main Category.
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    } else{
    mysqli_query($conn,"INSERT INTO sub_category VALUES(NULL,$mainCat,'$subCat')");
    }
};
if(isset($_POST["updSubCategory"])){
    $uid=$_POST["updSubId"];
    $updName=$_POST["updSubCat"];
    $updCategory=$_POST["mainCat"];
    mysqli_query($conn,"UPDATE sub_category SET subcat_name='$updName',subcat_maincat=$updCategory, WHERE subcat_id=$uid;");
    echo '<script type="text/javascript">
    window.location = "category.php";
    </script>';
}

if(isset($_POST["del_subc"])){
    $did=$_POST['subc_id'];
    $subcatcheck=mysqli_query($conn,"SELECT * FROM products WHERE prod_subcategory=$did");
    if(mysqli_num_rows($subcatcheck)){
        echo '<div class="alert alert-warning alert-dismissible d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Category cannot be deleted if products are available in this category.
        </div>
        <button type="button" class="fas fa-solid fa-xmark" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        
} else{
    mysqli_query($conn,"DELETE from sub_category WHERE subcat_id=$did");
    echo '<div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Successully Deleted.
        </div>
        <button type="button" class="fas fa-solid fa-xmark" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}}
?>


<!-- Category Add & Update -->
<div class="container-fluid">

<?php

if(isset($_GET["uid"])){
    $uid=$_GET["uid"];
    $query="SELECT * FROM category WHERE cat_id=$uid;";
$res=mysqli_query($conn,$query);
$dt=mysqli_fetch_assoc($res);
    echo '<h1 class="h3 mb-2 text-gray-800">Edit Category</h1>
    <form class="user" method="post">
            <div class="form-group row">
                    <input type="hidden" value="'.$uid.'" name="updCatId">
                    <input type="name" value="'.$dt["cat_name"].'" name="updCatName" class="form-control col-sm-3 mb-3 mb-sm-0">
            </div>            
                <input type="submit" name="updCategory" class="btn btn-warning" value="Update">                                        
                <hr>                                
    </form>';
} else{
    if(isset($_GET["suid"])){
        $uid=$_GET["suid"];
        $query="SELECT * FROM sub_category s INNER JOIN category c ON s.subcat_maincat=c.cat_id WHERE subcat_id=$uid;";
    $res=mysqli_query($conn,$query);
    $dt=mysqli_fetch_assoc($res);
    $category=$dt["cat_name"];
        echo '<h1 class="h3 mb-2 text-gray-800">Edit Sub-Category</h1>
        <form class="user" method="post">
                <div class="form-group row">
                        <input type="hidden" value="'.$uid.'" name="updSubId">
                        <input type="name" value="'.$dt["subcat_name"].'" name="updSubCat" class="form-control col-sm-3 m-3 mb-sm-0">                        
                    <select class="form-control col-sm-3 m-3 mb-sm-0" name="mainCat">
                    <option value="'.$dt["cat_id"].'" selected>'.$dt["cat_name"].'</option>';
                    $query="SELECT * FROM category WHERE cat_name!='$category'";
                                    $res=mysqli_query($conn,$query);
                                    while($row=mysqli_fetch_assoc($res)){
                                    echo '<option value="'.$row["cat_id"].'">'.$row["cat_name"].'</option>';
                                    };

                 echo'</select>
                </div>            
                    <input type="submit" name="updSubCategory" class="btn btn-warning" value="Update">                                        
                    <hr>                                
        </form>';
    } else{
    echo '<h1 class="h3 mb-2 text-gray-800">Add Category</h1>
    <form class="user" method="post">
            <div class="form-group">
                    <input type="name" name="catName" placeholder="Category Name" class="form-control col-sm-3 mb-3 mb-sm-0">
            </div>            
                <input type="submit" name="addCategory" class="btn btn-dark" value="Add">                                        
                <hr>                                
    </form>
    <h1 class="h3 mb-2 text-gray-800">Add Sub-Category</h1>
    <form class="user" method="post">
            <div class="form-group row">
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="name" name="subCategory" placeholder="Sub-Category Name" class="form-control">
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <select name="category" id="subcategory" class="py-2 form-control" placeholder="Select Sub-Category">
                                    <option selected value="0">Select Main Category</option>
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
                <input type="submit" name="addSubCategory" class="btn btn-dark" value="Add">                                        
                <hr>                                
    </form>
    ';}
};




                    ?>


                    <!-- Categories Table -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">View Categories</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Delete</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>                                   
                                    <tbody>
                                        <?php
                                            $query="SELECT * FROM category";
                                            $res=mysqli_query($conn,$query);
                                            while($row=mysqli_fetch_assoc($res)){
                                                echo'
                                                <tr>
                                                    <td>'.$row["cat_id"].'</td>
                                                    <td>'.$row["cat_name"].'</td>
                                                    <td><a class="btn btn-danger delBtn" href="#" data-id="'.$row["cat_id"].'" data-toggle="modal" data-target="#DelConfirmModal">Delete</a></</td>
                                                    <td><a class="btn btn-warning" href="category.php?uid='.$row["cat_id"].'">Edit</a></td>
                                                </tr>';
                                            };
                                        ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
<!-- Sub Category Table -->
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">View Sub-Categories</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Sub-Category</th>
                                            <th>Category</th>
                                            <th>Delete</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>                                   
                                    <tbody>
                                        <?php
                                            $query="SELECT * FROM sub_category s INNER JOIN category c ON s.subcat_maincat=c.cat_id";
                                            $res=mysqli_query($conn,$query);
                                            while($row=mysqli_fetch_assoc($res)){
                                                echo'
                                                <tr>
                                                    <td>'.$row["subcat_id"].'</td>
                                                    <td>'.$row["subcat_name"].'</td>
                                                    <td>'.$row["cat_name"].'</td>
                                                    <td><a class="btn btn-danger subCatDel" href="#" data-id="'.$row["subcat_id"].'" data-toggle="modal" data-target="#DelSubcatModal">Delete</a></</td>
                                                    <td><a class="btn btn-warning" href="category.php?suid='.$row["subcat_id"].'">Edit</a></td>
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