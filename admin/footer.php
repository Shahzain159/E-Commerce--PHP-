            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Glam&Glow 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

     <!-- Delete Confirmation Modal-->
  <div class="modal fade" id="DelConfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation.</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to Delete this item?</div>
                <div class="modal-footer">
                <form method="post">
                    <input type="hidden" id="feed_id" name="del_id" data-id="">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="del_btn" class="btn btn-danger" id="prod-del">Delete</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    
        <!-- SubCategory Delete Confirmation Modal-->
  <div class="modal fade" id="DelSubcatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation.</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to Delete this item?</div>
                <div class="modal-footer">
                <form method="post">
                    <input type="hidden" id="feed_subid" name="subc_id" data-id="">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="del_subc" class="btn btn-danger" id="prod-del">Delete</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Image Delete Confirmation Modal-->
  <div class="modal fade" id="ImgDelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation.</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to Delete this item?</div>
                <div class="modal-footer">
                <form method="post">
                    <input type="hidden" id="feed_img" name="img_id" data-id="">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="del_img" class="btn btn-danger" id="img-del">Delete</button>
                </form>
                </div>
            </div>
        </div>
    </div>
      <!----Custom Script---->
    
<script>

    $(document).ready(function(){
        

        $('#alert_success').hide();
        $('#alert_delete').hide();


        $(document).on("click",".set_pid",function(){
            var id=$(this).data("id");
            console.log(id);
                $.ajax({
                    url:"data.php",
                    type:"POST",
                    data:{pid:id},
                    success:function(d){
                        $('#data_form').html(d);
                        // $("#alert_delete").show();
                        // setTimeout(function(){
                        //     $("#alert_delete").hide();
                        // },2000)
                    }                    
                });
                $("html, body").animate({ scrollTop: 80 }, "slow");
            });

        $(document).on("click","#prod_upd",function(){
            var id=$(this).data("id");
            console.log(id);
                $.ajax({
                    url:"data.php",
                    type:"POST",
                    data:{uid:id},
                    success:function(d){
                        $('#data_form').html(d);
                        // $("#alert_success").show();
                        // setTimeout(function(){
                        //     $("#alert_success").hide();
                        // },2000)
                    }

                })
                $("html, body").animate({ scrollTop: 80 }, "slow");
            });
            function ordDet(){
            $(document).on("click",".ord_det",function(){
            var id=$(this).data("id");
            console.log(id);
                $.ajax({
                    url:"data.php",
                    type:"POST",
                    data:{oid:id},
                    success:function(d){
                        $('#ord-det').html(d);
                        // $("#alert_success").show();
                        // setTimeout(function(){
                        //     $("#alert_success").hide();
                        // },2000)
                    }

                })
                $("html, body").animate({ scrollTop: 80 }, "slow");
            });
            };
            ordDet();
            $(document).on("click","#ordStatus",function(){
            var id=$(this).data("id");
            console.log(id);
                $.ajax({
                    url:"data.php",
                    type:"POST",
                    data:{stid:id},
                    success:function(d){
                        $('#ord-det').html(d);
                        // $("#alert_success").show();
                        // setTimeout(function(){
                        //     $("#alert_success").hide();
                        // },2000)
                    }

                })
                $("html, body").animate({ scrollTop: 80 }, "slow");
            });

            $(document).on("click","#upd_st",function(){
            var id=$(this).data("id");
            var st=$('#ord_status').val();
            console.log(id);
            console.log(st);
                $.ajax({
                    url:"data.php",
                    type:"POST",
                    data:{odid:id,os:st},
                    success:function(d){
                        $('#orders_msg').html(d);
                        setTimeout(function(){
                            $('#orders_msg').html('');
                        },1000)
                }
            })
                $("html, body").animate({ scrollTop: 80 }, "slow");
            });
            $(document).on("click","#view_img",function(){
            var id=$(this).data("id");
            console.log(id);
                $.ajax({
                    url:"data.php",
                    type:"POST",
                    data:{vid:id},
                    success:function(d){
                        $('#data_form').html(d);
                        // $("#alert_delete").show();
                        // setTimeout(function(){
                        //     $("#alert_delete").hide();
                        // },2000)
                    }
                })
                $("html, body").animate({ scrollTop: 80 }, "slow");
            });
            // function alert_dis(){
            //     setTimeout(function(){
            //             $("#alert").alert('close');
            //             },2000)
            // }
            // $(document).on("click","#prod-upd",function(){
            //     alert_dis();
            // });
            // $(document).on("click","#prod-add",function(){
            //     $("#alert_success").show();
            //             setTimeout(function(){
            //                 $("#alert_success").hide();
            //             },2000)
            // });
            // $(document).on("click","#img-upl",function(){
            //     alert_dis();
            // });
            // $(document).on("click","#prod-del",function(){
            //     alert_dis();
            // });

        $(document).on("click","#multipleImages",function(){
            var id=$(this).data("id");
            console.log(id);
                $.ajax({
                    url:"data.php",
                    type:"POST",
                    data:{multi:id},
                    success:function(d){
                        $('#data_form').html(d);
                        // $("#alert_success").show();
                        // setTimeout(function(){
                        //     $("#alert_success").hide();
                        // },8000)
                    }

                })
            });
            $(document).on("click","#img-del",function(){
            var id=$('#feed_img').data("id");
            console.log(id);
                $.ajax({
                    url:"data.php",
                    type:"POST",
                    data:{imgDel:id},
                    success:function(d){
                        $('#data_form').html(d);
                        // $("#alert_success").show();
                        // setTimeout(function(){
                        //     $("#alert_success").hide();
                        // },8000)
                    }

                })
            });

            $(document).on("click",".set_sid",function(){
            var id=$(this).data("id");
            console.log(id);
                $.ajax({
                    url:"data.php",
                    type:"POST",
                    data:{sid:id},
                    success:function(d){
                        $('#stock_upd').html(d);
                        // $("#alert_delete").show();
                        // setTimeout(function(){
                        //     $("#alert_delete").hide();
                        // },2000)
                    }                    
                });
                $("html, body").animate({ scrollTop: 80 }, "slow");
            });
            $(document).on("click","#stk_upd",function(){
            var id=$(this).data("id");
            var q=$('#prodStock').val();
            console.log(id);
                $.ajax({
                    url:"data.php",
                    type:"POST",
                    data:{skid:id,stk:q},
                    success:function(d){
                        $('#stock_msg').html(d);
                        setTimeout(function(){
                            window.location="stock.php";
                        },1000)
                    }                    
                });
                $("html, body").animate({ scrollTop: 80 }, "slow");
            });
        
        $(document).on('click','.delBtn',function(){
            document.getElementById("feed_id").value=$(this).attr('data-id');
            // console.log($(this).attr('data-id'));
        });
        $(document).on('click','.imgDelBtn',function(){
            document.getElementById("feed_img").value=$(this).attr('data-id');
            // console.log($(this).attr('data-id'));
        });
        
        $(document).on('click','.subCatDel',function(){
            document.getElementById("feed_subid").value=$(this).attr('data-id');
            // console.log($(this).attr('data-id'));
        });

    });
</script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>