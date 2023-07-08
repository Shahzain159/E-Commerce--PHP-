<?php
require_once "header.php";

if(isset($_POST["updabout"])){    
    $uid=$_GET["uid"];
    $updName=$_POST["updauName"];
    $updEmail=$_POST["updauEmail"];
    $updNumber=$_POST["updauNumber"];
    $updAddress=$_POST["updauAddress"];
    mysqli_query($conn,"UPDATE about_us SET au_name='$updName',au_email='$updEmail',au_number='$updNumber',au_address='$updAddress' WHERE au_id='$uid'");
    echo '<script type="text/javascript">
    window.location = "about-us.php";
    </script>';
};




if(isset($_GET["uid"])){
    $uid=$_GET["uid"];
    $query="SELECT * FROM about_us WHERE au_id=$uid;";
$res=mysqli_query($conn,$query);
$dt=mysqli_fetch_assoc($res);
    echo '<h1 class="h3 ml-3 mb-2  text-gray-800">Edit About Us</h1>
    <form class="user" method="post">
            <div class="form-group">
                <div class="col-sm-12 mb-3 mb-sm-0">
                    <input type="name" value="'.$dt["au_name"].'" name="updauName" class="form-control col-sm-3 mb-3 mt-3 mb-sm-0">
                    <input type="email" value="'.$dt["au_email"].'" name="updauEmail" class="form-control mt-3 col-sm-3 mb-3 mb-sm-0">
                    <input type="text" value="'.$dt["au_number"].'" name="updauNumber" class="form-control mt-3 col-sm-3 mb-3 mb-sm-0">
                    <input type="text" value="'.$dt["au_address"].'" name="updauAddress" class="form-control mt-3 col-sm-3 mb-3 mb-sm-0">
                </div>
            </div>            
                <input type="submit" name="updabout" class="btn btn-warning ml-3" value="Update">                                        
                <hr>                                
    </form>';
}
 ?>
   <!-- About-Us Table -->
   <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h1 class="m-0 font-weight-bold text-primary">About Us</h1>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                            <th>Address</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>                                   
                                    <tbody>
                                        <?php
                                            $query="SELECT * FROM about_us ";
                                            $res=mysqli_query($conn,$query);
                                            while($row=mysqli_fetch_assoc($res)){
                                                echo'
                                                <tr>
                                                    <td>'.$row["au_id"].'</td>
                                                    <td>'.$row["au_name"].'</td>
                                                    <td>'.$row["au_email"].'</td>
                                                    <td>'.$row["au_number"].'</td>
                                                    <td>'.$row["au_address"].'</td>
                                                    <td><a class="btn btn-warning" href="about-us.php?uid='.$row["au_id"].'">Edit</a></td>
                                                </tr>';
                                            };
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>






<?php

require_once "footer.php"

?>x