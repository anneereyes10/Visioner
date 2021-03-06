<?php
require_once ("App_Code/Database.php");
require_once ("App_Code/Functions.php");
require_once ("App_Code/Services.php");
include("functions/functions.php");


?>

<!DOCTYPE>
<html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Visioner Design and Builders | Home page</title>
        <meta name="description" content="Visioner Design and Builders">
        <meta name="author" content="Visioner">
        <meta name="keyword" content="html5, css, bootstrap, property, real-estate theme , bootstrap template">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <link rel="stylesheet" href="assets/css/normalize.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/fontello.css">
        <link href="assets/fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
        <link href="assets/fonts/icon-7-stroke/css/helper.css" rel="stylesheet">
        <link href="assets/css/animate.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/icheck.min_all.css">
        <link rel="stylesheet" href="assets/css/price-range.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.css">
        <link rel="stylesheet" href="assets/css/owl.theme.css">
        <link rel="stylesheet" href="assets/css/owl.transitions.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">

    </head>
    <body>

        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>
        <!-- Body content -->

        <div class="header-connect">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-8  col-xs-12">
                        <div class="header-half header-call">
                            <p>
                                <span><i class="pe-7s-call"></i> (02) 423 4351 </span>
                                <span><i class="pe-7s-mail"></i> visioneridesign@gmail.com</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2 col-md-offset-5  col-sm-3 col-sm-offset-1  col-xs-12">
                        <div class="header-half header-social">
                            <ul class="list-inline">
                                <li><a href="https://www.facebook.com/Visioner-Design-and-Builders-432801973461175/"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End top header -->

        <nav class="navbar navbar-default ">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php?home"><img src="assets/img/logo.png" alt=""></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse yamm" id="navigation">
              <div class="button navbar-right">

                <?php
        						if(isset($_SESSION['user_email']))
        						{
        						?>
                <div class="btn-group">
                  <button class="navbar-btn nav-button wow bounceInRight login" onclick="window.open('../user/logout.php', '_self')" data-wow-delay="0.4s">Logout</button>
                </div>
                <div class="btn-group">
                  <button class="main-nav navbar-btn nav-button wow bounceInRight login dropdown-toggle active" data-toggle="dropdown" data-hover="dropdown" data-wow-delay="0.5s">Account<b class="caret"></b></button>
                  <ul class="dropdown-menu">
                    <li><a href="user/edit_profile.php">Edit Information</a></li>
                    <li><a href="user/payment.php">Check Transaction</a></li>
                    <li><a href="user/change_password.php">Change Password</a></li>
                    <li><a href="user/logout.php">Logout</a></li>
                  </ul>
                </div>
                <?php
        						}
        						else
        						{
        						?>
                <div class="btn-group">
                  <button class="navbar-btn nav-button wow bounceInRight login" onclick="window.open('index.php?login', '_self')" data-wow-delay="0.4s">Login</button>
                </div>
                <div class="btn-group">
                  <button class="navbar-btn nav-button wow bounceInRight login" onclick=" window.open('index.php?login', '_self')" data-wow-delay="0.5s">Account</button>
                </div>

                <?php
        						}
        						?>

                <div class="btn-group">

                  <button class="navbar-btn nav-button wow fadeInRight" onclick=" window.open('builddesign/customization.php', '_self')" data-wow-delay="0.5s">Start Design & Build</button>
                </div>

              </div>
              <ul class="main-nav nav navbar-nav navbar-right">
                <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="" href="index.php?about">About</a></li>
                <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="" href="services.php">Services</a></li>
                <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="" href="index.php?gallery">Gallery</a></li>
                <li class="wow fadeInDown" data-wow-delay="0.4s"><a href="index.php?contact">Contact</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        <!-- End of nav bar -->


        <div class="page-head">
          <div class="container">
            <div class="row">
              <div class="page-head-content">
                <h1 class="page-title">Our SERVICES</h1>
              </div>
            </div>
          </div>
        </div>
		
		<div class="content-area blog-page padding-top-40" style="background-color: #FCFCFC; padding-bottom: 55px;">
            <div class="container">
                <div class="row">
                    <div class="blog-lst col-md-12 pl0">
                        <section id="id-100" class="post single">

                            <div class="post-header single">
                                <div class="">
                                    <h2 class="wow fadeInLeft animated">Our Services</h2>
                                    <div class="title-line wow fadeInRight animated"></div>
                                </div>
								
                                <div class="row wow fadeInRight animated">
                                    <div class="col-sm-6">
                                        
                                    </div>
									
                                    <div class="col-sm-6 right" >
                                   
                                    </div>
									
                                </div>
                                <div class="image wow fadeInRight animated"> 
                                    <img src="assets/img/6.jpg" class="img-responsive" alt="Example blog post alt">
                                </div>
                            </div> 

                            <div id="post-content" class="post-body single wow fadeInLeft animated">
                                <p>
                                    <strong>Visioner Design and Builders </strong><br>As the company name stands. Visioner Design and Builders is a group of talented visionaries, aimed towards transforming creative ideas into fulfillment. A family of Architects, Interior designer, Contractors, Realtors and brokers, gave birth to this well rounded company, which once was formerly called BGMAR Construction and Landscaping. Founded by son Arch. Bernardo Neri Jr. and mother Asuncion B. Neri, we "The Neri's" take pride in our craft, the wide versatile experience in construction and design, building homes, industrial, and commercial projects for over  10 years locally and overseas.
						<br><br>
						Our team of professionals is especially dedicated in putting great value to our clients' goals, driven to provide full service to achieve utmost client satisfaction. We are your one source of everything you may need in constructing a prospective property, be it simple renovation task, to a full-scale project. Our ability to plan, design, manage budget constraints, and vast knowledge in construction solutions, creates a hassle free construction experience for our clients, thus relieving them from unnecessary worries. Consequently making us a "Visioner" you can trust.
						<br><br>
						The company offers a worry-free construction experience from the design brief up to the delivery of the finished project with complete planning, architectural, engineering, interior design, construction, project management, 3D rendering and real estate on a single-responsibility basis. The company???s expertise spans from residential, industrial and commercial projects. Even as a small group of professionals, they give a non-sense approach to the building process. Budgets and schedules are always presented upfront. Client options and potential risks are openly discussed at initial meetings. 
						</p>
													   
             

                               
							</div>
                    </div>                                  
                </div>

            </div>
        </div>
		
        <div class="container">
          <div class="clearfix">
            <div class="wizard-container">
              <br>
			  <!-- list start -->
              <div class="container">
                <div class="clearfix">
                  <div class="col-md-12">
                   
                    
    <div class="container">
		<div class="row">
			<div class="col-sm-9 col-sm-offset-1 profiel-container">
                    <div class="profiel-header">
						<h3>
							<b>SELECT</b> FROM OUR SERVICES <br>
							<hr>
							<small>Select from the available services that Visioner Design & Builders can provide for you.</small>
						</h3>
						
					</div>
                    
                    <div class="box mt-0 mb-lg-0">
                     

                      <?php
                      $lstServices = $clsServices->Get();
                      foreach ($lstServices as $mdlServices) {
                        echo '<a href="builddesign/DisplayServices.php?id='.$mdlServices->getId().'">'.$mdlServices->getName().'</a><br />';
                      }
                      ?>
                      <p id="details"></p>

                    </div>
                  </div>

        </div>
	</div>
	<!-- list end-->
                 </div></div>
              </div>
            </div>
          </div>
        </div>

    <!-- Footer area-->
        <div class="footer-area">

            <div class=" footer">
                <div class="container">
                    <div class="row">

                        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
                            <div class="single-footer">
                                <h4>About us </h4>
                                <div class="footer-title-line"></div>

                                <img src="assets/img/footer-logo.png" alt="" class="wow pulse" data-wow-delay="1s">
                                <p>Visioner Design and Builders is a design & build firm based in Metro Manila, Philippines.</p>
                                <ul class="footer-adress">
                                    <li><i class="pe-7s-map-marker strong"> </i> 30-B Bascom St. North Fairview, Quezon City, Philippines.</li>
                                    <li><i class="pe-7s-mail strong"> </i> visioneridesign@gmail.com</li>
                                    <li><i class="pe-7s-call strong"> </i> (02) 423 4351 </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
                            <div class="single-footer">
                                <h4>Quick links </h4>
                                <div class="footer-title-line"></div>
                                <ul class="footer-menu">
                                    <li><a href="index.php?about">About</a>  </li>
                                    <li><a href="services.php">Service</a>  </li>
                                    <li><a href="index.php?login">Login</a></li>
                                    <li><a href="index.php?contact">Contact</a></li>

                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
                            <div class="single-footer">
                                <h4>Gallery</h4>
                                <div class="footer-title-line"></div>
                                <ul class="footer-blog">
                                    <li>
                                        <div class="col-md-3 col-sm-4 col-xs-4 blg-thumb p0">
                                            <a href="index.php/?gallery">
                                                <img src="assets/img/visioners/2.jpg">
                                            </a>
                                            <span class="blg-date">View</span>

                                        </div>

                                        <div class="col-md-8  col-sm-8 col-xs-8  blg-entry">
                                            <h6> <a href="index.php/?gallery">Project I</a></h6>
                                            <p style="line-height: 17px; padding: 8px 2px;">View Gallery</p>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="col-md-3 col-sm-4 col-xs-4 blg-thumb p0">
                                            <a href="index.php/?gallery">
                                                <img src="assets/img/visioners/3.jpg">
                                            </a>
                                            <span class="blg-date">View</span>

                                        </div>
                                        <div class="col-md-8  col-sm-8 col-xs-8  blg-entry">
                                            <h6> <a href="index.php/?gallery">Project II </a></h6>
                                            <p style="line-height: 17px; padding: 8px 2px;">View Gallery</p>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="col-md-3 col-sm-4 col-xs-4 blg-thumb p0">
                                            <a href="index.php/?gallery">
                                                <img src="assets/img/visioners/4.jpg">
                                            </a>
                                            <span class="blg-date">View</span>

                                        </div>
                                        <div class="col-md-8  col-sm-8 col-xs-8  blg-entry">
                                            <h6> <a href="index.php/?gallery">Project III</a></h6>
                                            <p style="line-height: 17px; padding: 8px 2px;">View Gallery</p>
                                        </div>
                                    </li>


                                </ul>
                            </div>
                        </div>


                        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
                            <div class="single-footer news-letter">
                                <h4>Stay in touch</h4>
                                <div class="footer-title-line"></div>
                                <p> </p>

                                <form>
                                    <div class="input-group">
                                        <input class="form-control" type="email" placeholder="E-mail ... ">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary subscribe" type="submit"><i class="pe-7s-paper-plane pe-2x"></i></button>
                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                </form>

                                <div class="social pull-right">
                                    <ul>

                                        <li><a class="wow fadeInUp animated" href="https://www.facebook.com/Visioner-Design-and-Builders-432801973461175/" data-wow-delay="0.2s"><i class="fa fa-facebook"></i></a></li>
                                        <li><a class="wow fadeInUp animated" href="https://www.facebook.com/Visioner-Design-and-Builders-432801973461175/" data-wow-delay="0.4s"><i class="fa fa-instagram"></i></a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="footer-copy text-center">
                <div class="container">
                    <div class="row">
                        <div class="pull-left">
                            <span> (C) <a href="https://www.facebook.com/Visioner-Design-and-Builders-432801973461175/">Visioner Design and Builders</a> , All rights reserved 2018  </span>
                        </div>
                        <div class="bottom-menu pull-right">
                            <ul>
                                <li><a class="wow fadeInUp animated" href="index.php?home" data-wow-delay="0.2s">Home</a></li>
                                <li><a class="wow fadeInUp animated" href="index.php?gallery" data-wow-delay="0.3s">Gallery</a></li>
                                <li><a class="wow fadeInUp animated" href="index.php?privacypolicy" data-wow-delay="0.4s">Privacy Policy</a></li>
                                <li><a class="wow fadeInUp animated" href="index.php?contact" data-wow-delay="0.6s">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            </div>

        </div>

        <script src="assets/js/modernizr-2.6.2.min.js"></script>

        <script src="assets/js/jquery-1.10.2.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-select.min.js"></script>
        <script src="assets/js/bootstrap-hover-dropdown.js"></script>

        <script src="assets/js/easypiechart.min.js"></script>
        <script src="assets/js/jquery.easypiechart.min.js"></script>

        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/wow.js"></script>

        <script src="assets/js/icheck.min.js"></script>
        <script src="assets/js/price-range.js"></script>

        <script src="assets/js/main.js"></script>

    </body>
</html>
