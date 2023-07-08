<?php
require_once "header.php"

?>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h1 class="m-0 font-weight-bold text-primary">Queries</h1>
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
                                            <th>Message</th>
                                        </tr>
                                    </thead>                                   
                                    <tbody>
                                        <?php
                                            $query="SELECT * FROM contact ";
                                            $res=mysqli_query($conn,$query);
                                            while($row=mysqli_fetch_assoc($res)){
                                                echo'
                                                <tr>
                                                    <td>'.$row["contact_id"].'</td>
                                                    <td>'.$row["contact_name"].'</td>
                                                    <td>'.$row["contact_email"].'</td>
                                                    <td>'.$row["contact_number"].'</td>
                                                    <td>'.$row["contact_message"].'</td>
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

?>