<?php
require_once "header.php";

if(isset($_POST["addsliders"])){
$name=$_POST["sliderName"];

$imgName=$_FILES["slider_image"]["name"];
$tmpFile=$_FILES["slider_image"]["tmp_name"];
$path='../user/assets/img/slider/'.time().$imgName;
$xt=explode('.',$imgName);
$type=end($xt);
$ext=array('jpg','jpeg','png','jfif');
if(in_array($type,$ext)){
    move_uploaded_file($tmpFile,$path);
    $query="INSERT INTO sliders VALUE(NULL,'$name','$path');";
    mysqli_query($conn,$query);
   
} else{
    echo "<script>alert('Invalid File Type.!')</script>";
};
};

if(isset($_POST["del_btn"])){
    $did=$_POST["del_id"];
    $sliders=mysqli_query($conn,"SELECT * FROM sliders WHERE slider_id=$did");
    $res=mysqli_fetch_assoc($sliders);
    $img=$res["slider_image"];
    unlink($img);
        $res=mysqli_query($conn,"DELETE FROM sliders WHERE slider_id=$did");
        echo '<div class="alert alert-danger alert-dismissible d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Deleted Successfully
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

    };

if(isset($_POST["updslider"])){
    $id=$_POST["sliderId"];
    $name=$_POST["updsliderName"];
   
    if($_FILES["slider_image"]["error"]==0){
        $imgName=$_FILES["slider_image"]["name"];
        $tmpFile=$_FILES["slider_image"]["tmp_name"];
        $path='../user/assets/img/slider/'.time().$imgName;
        $xt=explode('.',$imgName);
        $type=end($xt);
        $ext=array('jpg','jpeg','png','jfif');
        if(in_array($type,$ext)){
            $res=mysqli_query($conn,"SELECT * FROM sliders WHERE slider_id=$id");
            $row=mysqli_fetch_assoc($res);
            $oldimg=$row["slider_image"];
            unlink($oldimg);
            move_uploaded_file($tmpFile,$path);
            $query="UPDATE sliders SET slider_name='$name',slider_image='$path' WHERE slider_id=$id;";
            mysqli_query($conn,$query);
           

               } else{
            echo "<script>alert('Invalid File Type.!')</script>";
        }; 
    } 
};



?>

<!-- images upload form -->

            <?php
        

                if(isset($_GET["uid"])){
                    $uid=$_GET["uid"];
                    $query="SELECT * FROM sliders WHERE slider_id=$uid;";
                    $res=mysqli_query($conn,$query);
                    $dt=mysqli_fetch_assoc($res);
                        echo '<h1 class="h3 m-2 text-gray-800">Edit Sliders</h1>
                        <form class="user" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                <input type=number hidden="true" name="sliderId" value="'.$uid.'">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="name" placeholder="Enter Slider Name" value="'.$dt["slider_name"].'" name="updsliderName" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-6 mb-3 mb-sm-0">
                                    <input type="file" name="slider_image" class="m-3">
                                    </div>
                                </div>                        
                                    <input type="submit" name="updslider" class="btn btn-warning m-3" value="Update">                                        
                                    <hr>
                                                    
                        </form>';
                    } else{
                        echo '<h1 class="h3 m-2 text-gray-800">Add Slider</h1>
                        <form class="user" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="name" value="" placeholder="Enter Slider Name" name="sliderName" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-6 mb-3 mb-sm-0">
                                    <input type="file" name="slider_image" class="m-3">
                                    </div>   
                                    <input type="submit" name="addsliders" class="btn btn-dark w-25 m-3" value="Add">                                        
                                    <hr>
                                                    
                        </form>';
                    };               
            
            ?>       
        </div>

                <!-- Begin Page Content -->
                <div class="container-fluid" id="slider_data">

                <h1 class="h3 mb-2 text-gray-800">Sliders</h1>


<!-- Data Tables -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">View Sliders</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Delete</th>
                        <th>Update</th>
                    </tr>
                </thead>                                   
                <tbody>
                    <?php
                        $query="SELECT * FROM sliders ";
                        $res=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_assoc($res)){
                            echo'
                            <tr>
                                <td>'.$row["slider_id"].'</td>
                                <td>'.$row["slider_name"].'</td>
                                <td><img src="'.$row["slider_image"].'" width=100px></td>
                                <td><a class="btn btn-danger delBtn" href="#" data-id="'.$row["slider_id"].'" data-toggle="modal" data-target="#DelConfirmModal">Delete</a></</td>
                                <td><a class="btn btn-warning" href="slider.php?uid='.$row["slider_id"].'">Update</a></td>
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

require_once "footer.php";

?>