 <!--== Start Contact Info Area Wrapper ==-->
 <section class="bg-black-color">
      <div class="container pt-35 pb-40">
        <div class="row">
          <div class="col-12">
            <div class="contact-info contact-info-static">
              <div class="row">
                <div class="col-border col-12 col-md-4 col-sm-6 border-0">
                  <div class="info-item">
                    <div class="icon-box">
                      <i class="icon las la-phone-volume"></i>
                    </div>
                    <p><?php echo$aunumber?></p>
                  </div>
                </div>
                <div class="col-border col-12 col-md-4 col-sm-6 mt-xs-35">
                  <div class="info-item">
                    <div class="icon-box">
                      <i class="icon las la-envelope"></i>
                    </div>
                    <p><?php echo$auemail?></p>
                  </div>
                </div>
                <div class="col-border col-12 col-md-4 col-sm-12 mt-sm-35">
                  <div class="info-item">
                    <div class="icon-box">
                      <i class="icon lab la-facebook-messenger"></i>
                    </div>
                    <p>Virtual Chat 24/7 | Live M-F 9am-6pm</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Contact Info Area Wrapper ==-->

    <!--== Start Divider Area Wrapper ==-->
    <section class="divider-area">
      <div class="container pt-90 pt-lg-70 pb-lg-60">
        <div class="row">
          <div class="col-12">
            <div class="divider-style-wrap">
              <div class="">
                <div class="col-md-6">
                  <div class="divider-content text-center">
                    <h4 class="title hidden-sm-down">Let’s Connect On Social</h4>
                    <h4 class="title2 hidden-md-up collapsed" data-bs-toggle="collapse" data-bs-target="#dividerId-1">Let’s Connect On Social</h4>
                    <div id="dividerId-1" class="collapse">
                      <div class="social-icons">
                        <a href="#/"><i class="la la-facebook"></i></a>
                        <a href="#/"><i class="la la-twitter"></i></a>
                        <a href="#/"><i class="la la-youtube"></i></a>
                        <a href="#/"><i class="la la-instagram"></i></a>
                      </div>
                      <p class="mb-sm-25">Follow us on your favorite platforms. Check out new launch teasers, how-to videos, and share your favorite looks.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Divider Area Wrapper ==-->
  </main>
<!--== Start Footer Area Wrapper ==-->
  <footer class="footer-area">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!--== Start Footer Widget Area ==-->
          <div class="footer-widget-area pb-30">
            <div class="row">
              <div class="col-lg-6">
                <div class="widget-item">
                  <div class="about-widget">
                    <div class="inner-content">
                      <div class="footer-logo">
                        <a href="index.php">
                          <img class="logo-light" src="assets/img/logo-light.png" alt="Logo" />
                        </a>
                      </div>
                      <p>Location:<?php echo$auaddress ?></p>
                    </div>
                    <div class="widget-desc">
                      <p>We are a team of designers and developers that create high quality Web Applications.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="widget-item">
                  <div class="widget-menu-wrap">
                    <ul class="nav-menu">
                      <li><a href="#/">Delivery</a></li>
                      <li><a href="#/">Legal Notice</a></li>
                      <li><a href="about-us.php">About us</a></li>
                      <li><a href="#/">Secure payment</a></li>
                      <li><a href="contact.php">Contact us</a></li>
                      <li><a href="#/">Sitemap</a></li>
                      <li><a href="login.php">Login</a></li>
                      <li><a href="my-account.php">My account</a></li>
                      <li><a href="products.php">Stores</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--== End Footer Widget Area ==-->
        </div>
      </div>
    </div>
    <!--== Start Footer Bottom Area ==-->
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <p class="copyright">Glam & Glow | Copyright © 2023 All Rights Reserved</p>
          </div>
          <div class="col-lg-6">
          </div>
        </div>
      </div>
    </div>
    <!--== End Footer Bottom Area ==-->
  </footer>
  <!--== End Footer Area Wrapper ==-->

  <!--== Scroll Top Button ==-->
  <div id="scroll-to-top" class="scroll-to-top"><span class="ion-md-arrow-up"></span></div>

  <!--== Start Side Menu ==-->
  <aside class="off-canvas-wrapper">
    <div class="off-canvas-inner">
      <div class="off-canvas-overlay"></div>
      <!-- Start Off Canvas Content Wrapper -->
      <div class="off-canvas-content">
        <!-- Off Canvas Header -->
        <div class="off-canvas-header">
          <div class="close-action">
            <button class="btn-menu-close">menu<i class="icon-arrow-left"></i></button>
          </div>
        </div>

        <div class="off-canvas-item">
          <!-- Start Mobile Menu Wrapper -->
          <div class="res-mobile-menu menu-active-one">
            <!-- Note Content Auto Generate By Jquery From Main Menu -->
          </div>
          <!-- End Mobile Menu Wrapper -->
        </div>
      </div>
      <!-- End Off Canvas Content Wrapper -->
    </div>
  </aside>
  <!--== End Side Menu ==-->


  <div class="popup-product-overlay"></div>
  <button class="popup-product-close"><i class="la la-close"></i></button>
  <!--== End Popup Product  ==-->
</div>

<!--  Confirmation Modal-->
<div class="modal fade" id="DelConfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation.</h5>
                    <button class="close closeModal" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to Cancel this order?</div>
                <div class="modal-footer">
                <form method="post">
                    <input type="hidden" id="feed_id" name="ord_id" value="" data-id="">
                    <button class="btn btn-secondary closeModal" type="button" data-dismiss="modal">Cancel</button>
                    <Button type="submit" name="ord_cancel" class="btn btn-danger">Confirm</button>
                </form>
                </div>
            </div>
        </div>
    </div>

<!---Customer script--->

<script>

    $(document).ready(function(){
      $(document).on('click','#cancelOrder',function(){
      $('#DelConfirmModal').modal('toggle');
      })

      $(document).on('click','.closeModal',function(){
      $('#DelConfirmModal').modal('toggle');
    })

     //Passing ID in Delete modal 
     $(document).on('click', '#cancelOrder', function(){
            document.getElementById("feed_id").value = $(this).attr('data-id');
                console.log($(this).attr('data-id'));
            });



    $(document).on('click', '.ord_det', function(){
        var id=$(this).data("id");
            console.log(id);
            $.ajax({
                    url:"data.php",
                    type:"POST",
                    data:{oid:id},
                    success:function(d){
                        $('#myAccount').html(d);
                        // setTimeout(function(){
                        //     $('#orders_msg').html('');
                        // },1000)
                }
            })
                $("html, body").animate({ scrollTop: 200 }, "slow");
            });
            
            $(document).on('click', '.ord_info', function(){
        var id=$(this).data("id");
            console.log(id);
            $.ajax({
                    url:"data.php",
                    type:"POST",
                    data:{ord:id},
                    success:function(d){
                        $('#myAccount').html(d);
                        // setTimeout(function(){
                        //     $('#orders_msg').html('');
                        // },1000)
                }
            })
                $("html, body").animate({ scrollTop: 200 }, "slow");
            });
    function cart_data(){
                $.ajax({
                    url:"tempcart.php",
                    type:"GET",
                    success:function(d){
                        $("#data_table").html(d)
                    }
                })
        };
        cart_data();

$(document).on("click",".btn-product-add",function(){
                var did=$(this).data("id");
                console.log(did);
                $.ajax({
                    url:"tempcart.php",
                    type:"POST",
                    data:{id:did},
                    success:function(){
                        cart_data();
                    }

                })
            });
          })
</script>



<!--=======================Javascript============================-->

<!--=== Modernizr Min Js ===-->
<script src="assets/js/modernizr.js"></script>
<!--=== jQuery Min Js ===-->
<script src="assets/js/jquery-main.js"></script>
<!--=== jQuery Migration Min Js ===-->
<script src="assets/js/jquery-migrate.js"></script>
<!--=== Bootstrap Min Js ===-->
<script src="assets/js/bootstrap.min.js"></script>
<!--=== jQuery Appear Js ===-->
<script src="assets/js/jquery.appear.js"></script>
<!--=== jQuery Swiper Min Js ===-->
<script src="assets/js/swiper.min.js"></script>
<!--=== jQuery Fancy Box Min Js ===-->
<script src="assets/js/fancybox.min.js"></script>
<!--=== jQuery Slick Nav Js ===-->
<script src="assets/js/slicknav.js"></script>
<!--=== jQuery Waypoints Js ===-->
<script src="assets/js/waypoints.js"></script>
<!--=== jQuery Owl Carousel Min Js ===-->
<script src="assets/js/owlcarousel.min.js"></script>
<!--=== jQuery Match Height Min Js ===-->
<script src="assets/js/jquery-match-height.min.js"></script>
<!--=== jQuery Zoom Min Js ===-->
<script src="assets/js/jquery-zoom.min.js"></script>
<!--=== Countdown Js ===-->
<script src="assets/js/countdown.js"></script>

<!--=== Custom Js ===-->
<script src="assets/js/custom.js"></script>

</body>
</html>