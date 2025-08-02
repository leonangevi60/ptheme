
            <footer id="footer">
                <div class="container">
                    <div class="footer-ribbon">
                        <span>Sharstore</span>
                    </div>
                    <div class="row py-5 my-4">
                        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                            <h5 class="text-3 mb-3">Sharstore</h5>
                            <p class="pr-1">Tôi là 1 lập trình viên và luôn muốn chia sẻ với tất cả các bạn những hiểu biết của mình.</p>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                            <h5 class="text-3 mb-3">Tin mới</h5>
                            <div id="tweet" class="twitter" data-plugin-tweets data-plugin-options="{'username': 'oklerthemes', 'count': 2}">
                                  
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                            <div class="contact-details">
                                <h5 class="text-3 mb-3">Liên hệ</h5>
                                <ul class="list list-icons list-icons-lg">
                                    <!-- <li class="mb-1"><i class="far fa-dot-circle text-color-primary"></i><p class="m-0">HÀ Nội</p></li>
                                    <li class="mb-1"><i class="fab fa-whatsapp text-color-primary"></i><p class="m-0"><a href="tel:8001234567">(800) 123-4567</a></p></li> -->
                                    <li class="mb-1"><i class="far fa-envelope text-color-primary"></i><p class="m-0"><a href="mailto:thuongdq@gmail.com">thuongdq@gmail.com</a></p></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <h5 class="text-3 mb-3">Mạng xã hội</h5>
                            <ul class="social-icons">
                                <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright">
                    <div class="container py-2">
                        <div class="row py-4">
                            <div class="col-lg-1 d-flex align-items-center justify-content-center justify-content-lg-start mb-2 mb-lg-0">
                                <?php
                                    if(is_array(client_get_options('logo-footer')) && isset(client_get_options('logo-footer')['url'])){
                                        $logo_footer = client_get_options('logo-footer')['url'];
                                    }else{
                                        global $default_image;
                                        $logo_footer = $default_image;;
                                    }
                                ?>
                                <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>" class="logo pr-0 pr-lg-3">
                                    <img alt="<?php echo get_bloginfo('name'); ?>" src="<?php echo $logo_footer; ?>" class="opacity-5" height="33">
                                </a>
                            </div>
                            <div class="col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-start mb-4 mb-lg-0">
                                <p>© Copyright 2019.</p>
                            </div>
                            <div class="col-lg-4 d-flex align-items-center justify-content-center justify-content-lg-end">
                                <nav id="sub-menu">
                                    <ul>
                                        <!-- <li><i class="fas fa-angle-right"></i><a href="page-faq.html" class="ml-1 text-decoration-none"> FAQ's</a></li> -->
                                        <li><i class="fas fa-angle-right"></i><a href="<?php echo home_url(); ?>/sitemap_index.xml" class="ml-1 text-decoration-none"> Sitemap</a></li>
                                        <li><i class="fas fa-angle-right"></i><a href="#" class="ml-1 text-decoration-none"> Liên hệ</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Vendor -->
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/jquery/jquery.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/jquery.appear/jquery.appear.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/jquery.easing/jquery.easing.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/jquery.cookie/jquery.cookie.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/popper/umd/popper.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/common/common.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/jquery.validation/jquery.validate.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/jquery.gmap/jquery.gmap.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/isotope/jquery.isotope.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/owl.carousel/owl.carousel.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/vide/jquery.vide.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/vivus/vivus.min.js"></script>
        
        <!-- Theme Base, Components and Settings -->
        <script src="<?php echo home_url(); ?>/assets/porto/js/theme.js"></script>
        
        <!-- Current Page Vendor and Views -->
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/vendor/circle-flip-slideshow/js/jquery.flipshow.min.js"></script>
        <script src="<?php echo home_url(); ?>/assets/porto/js/views/view.home.js"></script>
        
        <!-- Theme Custom -->
        <script src="<?php echo home_url(); ?>/assets/porto/js/custom.js"></script>
        
        <!-- Theme Initialization Files -->
        <script src="<?php echo home_url(); ?>/assets/porto/js/theme.init.js"></script>

        <!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        
            ga('create', 'UA-12345678-1', 'auto');
            ga('send', 'pageview');
        </script>
         -->
        <?php wp_footer(); ?>
        <style type="text/css">
            .post-ratings img, .post-ratings-loading img, .post-ratings-image img{
                width: auto;
            }
        </style>
    </body>
</html>
