<?php
session_start();
include("functions/functions.php");
include("includes/db.php");

$msg = "";
	if(isset($_POST['register']))
	{


		$ip = getIP();
		$u_name = $_POST['u_name'];
		$u_birthday = $_POST['u_birthday'];
		$u_address = $_POST['u_address'];
		$u_contact = $_POST['u_contact'];
		$u_gender = $_POST['u_gender'];
    $u_email = $_POST['u_email'];
    $u_pass = $_POST['u_pass'];
    $hashcode = md5($ip . $u_email);

    $search = "SELECT COUNT(*) FROM `user_account`
			         WHERE `user_email` = '".$u_email."'";
    $result=mysqli_query($con,$search) or die(mysqli_error($con));
    $rows = mysqli_fetch_row($result);


    $u_search = "SELECT COUNT(*) FROM `user_account_p`
			         WHERE `user_email` = '".$u_email."'";
    $u_result=mysqli_query($con,$u_search) or die(mysqli_error($con));
    $u_rows = mysqli_fetch_row($u_result);

		if($rows[0] > 0)
		{
      $msg = '<div class="alert alert-danger">
                <strong>Duplicate!</strong> Email already registered.
              </div>';
		}else{
  		if($u_rows[0] > 0)
  		{
        $msg = '<div class="alert alert-danger">
                  <strong>Duplicate!</strong> Email already registered.
                </div>';
  		}else{

        $insert_user = "INSERT INTO `user_account_p`(`ip_address`, `user_email`, `user_pass`, `full_name`, `birthdate`, `gender`, `contact`, `address`, `hashcode`)
        VALUES ('$ip','$u_email','$u_pass','$u_name','$u_birthday','$u_gender','$u_contact','$u_address','$hashcode')";
        $insert_payment = "insert into payment_status(user_id, user_email, type_selected, pay_status,payment_image) values(LAST_INSERT_ID(),'$u_email','None','None','None')";
        $insert_transaction="insert into transaction_type(user_id,user_email,ip_address,transaction_type) values(LAST_INSERT_ID(),'$u_email','$ip','None')";
        $insert_appointment = "insert into appointment(user_id, user_email, appointment_status, appointment_date,appointment_made) values (LAST_INSERT_ID(),'$u_email', 'None', '0000-00-00','0000-00-00')";
        $run_user = mysqli_query($con, $insert_user);
        $run_payment = mysqli_query($con, $insert_payment);
        $run_appointment = mysqli_query($con, $insert_appointment);
        $run_trans = mysqli_query($con, $insert_transaction);

        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );

        $from 		= "donotreply@visioner.com";
        $to 			= $u_email;
        $subject 	= "Confirmation Email - Visioner";

        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: ". $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = 	'<html>';
        $message .= 	'<body>';

        $message .= 	'Hey there,';
        
        $message .= 	'We are excited to have you get started. First, you need to confirm your account by clicking the button below<br /><br />
        <a href="https://visionerdesignandbuilders.com/confirmemail.php?u='.$hashcode.'&e='.$u_email.'">Click here</a> to verify your email.<br /><br />';
        $message .= 	'If that doesnt work, copy and paste the URL below into your web browser.<br /> https://visionerdesignandbuilders.com/confirmemail.php?u='.$hashcode.'&e='.$u_email.'<br /><br />';
        
        $message .= 	'Thanks, <br />
Visioner Design and Builders Team <br /><br />';
        $message .= '(C) Visioner Design and Builders , All rights reserved 2018 <br />
 30-B Bascom St. North Fairview, Quezon City, Philippines.';
        $message .= 	'</body>';
        $message .= '</html>';

        mail($to, $subject, $message, $headers);

        if($run_user and $run_payment and $run_appointment)
        {
          $_SESSION['user_email']=$u_email;

          echo "<script>alert('Account has been created successfully! Check your email to verify your account.')</script>";
          // echo "<script>window.open('user/user_account.php?edit_profile','_self')</script>";
        }
      }
    }

	}
?>

<!DOCTYPE>
<html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

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
            <button class="navbar-btn nav-button wow bounceInRight login" onclick="window.open('logout.php', '_self')" data-wow-delay="0.4s">Logout</button>
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
          <h1 class="page-title">Register</h1>
        </div>
      </div>
    </div>
  </div>
  <!-- End page header -->


  <!-- register-area -->
  <div class="register-area" style="background-color: rgb(249, 249, 249);">
    <div class="container">

      <!-- Register Area -->
      <div class="col-md-12">
        <div class="box-for overflow">
          <div class="col-md-12 col-xs-12 login-blocks">
            <center><h3><strong>CREATE</strong> AN ACCOUNT </h3></center>
            <hr>
            <?php echo $msg; ?>
            <form action="register.php" method="post" enctype="multipart/form-data">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="email">Full Name</label>
                  <input type="text" class="form-control" name="u_name" required placeholder="Enter Full Name" />
                </div>
  							<div class="form-group">
  								<label>Birthdate :</label>
  								<div class='input-group date' id='datepicker'>
  									<input type='date' class="form-control" name="u_birthday" required />
  									<span class="input-group-addon">
  										<span class="glyphicon glyphicon-calendar"></span>
  									</span>
  								</div>
  							</div>
  							<div class="form-group">
  								<label>Address:</label>
  								<input type="text" class="form-control" placeholder="Address" required name="u_address" />
  							</div>
  							<div class="form-group">
  								<label>Contact Number (+63) </label>
  								<input type="number" class="form-control" placeholder="Contact Number" required name="u_contact">
  							</div>
              </div>
              
              <div class="col-sm-6">
                    <div class="form-group">
  								<!-- <label>Gender</label><br> -->
  								
  								<label for="u_gender">Gender</label>
                                <select name="u_gender" class="form-control">
                                <option selected> </option>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                                <option value="other" >Other</option>
                                </select>
  								<!-- 
  							    <input type="radio" name="u_gender" value="female">Female
  								<input type="radio" name="u_gender" value="male" >Male  
  								<input type="radio" name="u_gender" value="other">Other
  								-->
  								
  							</div>
  							
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="u_email" required placeholder="Enter Email" />
                </div>
                
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="u_pass" required placeholder="Enter Password" />
                </div>
                
              </div>
             
    <div class="col-sm-10 col-sm-offset-1"><br>
              <center><h6>By clicking Sign up, you agree to our Terms and that you have read our  <a href="#" data-toggle="modal" data-target="#myModal"><strong><u>Terms of Service.</u></strong></a> </h6></center>
              
               <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Visioner Design and Builders - Terms and Conditions</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <h2>Welcome to Visioner Design and Builders</h2>
	<p>These terms and conditions outline the rules and regulations for the use of Visioner Design and Builders's Website.</p> <br /> 
	<span style="text-transform: capitalize;"> Visioner Design and Builders</span> is located at:<br /> 
	<address>30 Bascom Quezon City <br />1123 - Metro Manila , Philippines<br />
	</address>
	<p>By accessing this website we assume you accept these terms and conditions in full. Do not continue to use Visioner Design and Builders's website 
	if you do not accept all of the terms and conditions stated on this page.</p>
	<p>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice
	and any or all Agreements: “Client”, “You” and “Your” refers to you, the person accessing this website
	and accepting the Company’s terms and conditions. “The Company”, “Ourselves”, “We”, “Our” and “Us”, refers
	to our Company. “Party”, “Parties”, or “Us”, refers to both the Client and ourselves, or either the Client
	or ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake
	the process of our assistance to the Client in the most appropriate manner, whether by formal meetings
	of a fixed duration, or any other means, for the express purpose of meeting the Client’s needs in respect
	of provision of the Company’s stated services/products, in accordance with and subject to, prevailing law
	of Philippines. Any use of the above terminology or other words in the singular, plural,
	capitalisation and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p><h2>Cookies</h2>
	<p>We employ the use of cookies. By using Visioner Design and Builders's website you consent to the use of cookies 
	in accordance with Visioner Design and Builders’s privacy policy.</p><p>Most of the modern day interactive web sites
	use cookies to enable us to retrieve user details for each visit. Cookies are used in some areas of our site
	to enable the functionality of this area and ease of use for those people visiting. Some of our 
	affiliate / advertising partners may also use cookies.</p><h2>License</h2>
	<p>Unless otherwise stated, Visioner Design and Builders and/or it’s licensors own the intellectual property rights for
	all material on Visioner Design and Builders. All intellectual property rights are reserved. You may view and/or print
	pages from https://visionerdesignandbuilders.com/ for your own personal use subject to restrictions set in these terms and conditions.</p>
	<p>You must not:</p>
	<ol>
		<li>Republish material from https://visionerdesignandbuilders.com/</li>
		<li>Sell, rent or sub-license material from https://visionerdesignandbuilders.com/</li>
		<li>Reproduce, duplicate or copy material from https://visionerdesignandbuilders.com/</li>
	</ol>
	<p>Redistribute content from Visioner Design and Builders (unless content is specifically made for redistribution).</p>
<h2>Hyperlinking to our Content</h2>
	<ol>
		<li>The following organizations may link to our Web site without prior written approval:
			<ol>
			<li>Government agencies;</li>
			<li>Search engines;</li>
			<li>News organizations;</li>
			<li>Online directory distributors when they list us in the directory may link to our Web site in the same
				manner as they hyperlink to the Web sites of other listed businesses; and</li>
			<li>Systemwide Accredited Businesses except soliciting non-profit organizations, charity shopping malls,
				and charity fundraising groups which may not hyperlink to our Web site.</li>
			</ol>
		</li>
	</ol>
	<ol start="2">
		<li>These organizations may link to our home page, to publications or to other Web site information so long
			as the link: (a) is not in any way misleading; (b) does not falsely imply sponsorship, endorsement or
			approval of the linking party and its products or services; and (c) fits within the context of the linking
			party's site.
		</li>
		<li>We may consider and approve in our sole discretion other link requests from the following types of organizations:
			<ol>
				<li>commonly-known consumer and/or business information sources such as Chambers of Commerce, American
					Automobile Association, AARP and Consumers Union;</li>
				<li>dot.com community sites;</li>
				<li>associations or other groups representing charities, including charity giving sites,</li>
				<li>online directory distributors;</li>
				<li>internet portals;</li>
				<li>accounting, law and consulting firms whose primary clients are businesses; and</li>
				<li>educational institutions and trade associations.</li>
			</ol>
		</li>
	</ol>
	<p>We will approve link requests from these organizations if we determine that: (a) the link would not reflect
	unfavorably on us or our accredited businesses (for example, trade associations or other organizations
	representing inherently suspect types of business, such as work-at-home opportunities, shall not be allowed
	to link); (b)the organization does not have an unsatisfactory record with us; (c) the benefit to us from
	the visibility associated with the hyperlink outweighs the absence of <?=$companyName?>; and (d) where the
	link is in the context of general resource information or is otherwise consistent with editorial content
	in a newsletter or similar product furthering the mission of the organization.</p>

	<p>These organizations may link to our home page, to publications or to other Web site information so long as
	the link: (a) is not in any way misleading; (b) does not falsely imply sponsorship, endorsement or approval
	of the linking party and it products or services; and (c) fits within the context of the linking party's
	site.</p>

	<p>If you are among the organizations listed in paragraph 2 above and are interested in linking to our website,
	you must notify us by sending an e-mail to <a href="mailto:isioneridesign@gmail.com" title="send an email to isioneridesign@gmail.com">isioneridesign@gmail.com</a>.
	Please include your name, your organization name, contact information (such as a phone number and/or e-mail
	address) as well as the URL of your site, a list of any URLs from which you intend to link to our Web site,
	and a list of the URL(s) on our site to which you would like to link. Allow 2-3 weeks for a response.</p>

	<p>Approved organizations may hyperlink to our Web site as follows:</p>

	<ol>
		<li>By use of our corporate name; or</li>
		<li>By use of the uniform resource locator (Web address) being linked to; or</li>
		<li>By use of any other description of our Web site or material being linked to that makes sense within the
			context and format of content on the linking party's site.</li>
	</ol>
	<p>No use of Visioner Design and Builders’s logo or other artwork will be allowed for linking absent a trademark license
	agreement.</p>
<h2>Iframes</h2>
	<p>Without prior approval and express written permission, you may not create frames around our Web pages or
	use other techniques that alter in any way the visual presentation or appearance of our Web site.</p>
<h2>Reservation of Rights</h2>
	<p>We reserve the right at any time and in its sole discretion to request that you remove all links or any particular
	link to our Web site. You agree to immediately remove all links to our Web site upon such request. We also
	reserve the right to amend these terms and conditions and its linking policy at any time. By continuing
	to link to our Web site, you agree to be bound to and abide by these linking terms and conditions.</p>
<h2>Removal of links from our website</h2>
	<p>If you find any link on our Web site or any linked web site objectionable for any reason, you may contact
	us about this. We will consider requests to remove links but will have no obligation to do so or to respond
	directly to you.</p>
	<p>Whilst we endeavour to ensure that the information on this website is correct, we do not warrant its completeness
	or accuracy; nor do we commit to ensuring that the website remains available or that the material on the
	website is kept up to date.</p>
<h2>Content Liability</h2>
	<p>We shall have no responsibility or liability for any content appearing on your Web site. You agree to indemnify
	and defend us against all claims arising out of or based upon your Website. No link(s) may appear on any
	page on your Web site or within any context containing content or materials that may be interpreted as
	libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or
	other violation of, any third party rights.</p>
<h2>Disclaimer</h2>
	<p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website (including, without limitation, any warranties implied by law in respect of satisfactory quality, fitness for purpose and/or the use of reasonable care and skill). Nothing in this disclaimer will:</p>
	<ol>
	<li>limit or exclude our or your liability for death or personal injury resulting from negligence;</li>
	<li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>
	<li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
	<li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>
	</ol>
	<p>The limitations and exclusions of liability set out in this Section and elsewhere in this disclaimer: (a)
	are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer or
	in relation to the subject matter of this disclaimer, including liabilities arising in contract, in tort
	(including negligence) and for breach of statutory duty.</p>
	<p>To the extent that the website and the information and services on the website are provided free of charge,
	we will not be liable for any loss or damage of any nature.</p>
<h2></h2>
	<p></p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div> <!-- end of modal -->
              
    </div>
              <div class="col-sm-4 col-sm-offset-4"><br>
                  <input type="submit" class="btn btn-finish btn-primary" name="register" value="SIGN UP"/>
                </div>
            </form>

          </div>

        </div>
      </div>

      <div class="col-md-6">
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
                <li><a href="index.php?about">About</a> </li>
                <li><a href="services.php">Service</a> </li>
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
                    <a href="index.php?gallery">
                      <img src="assets/img/visioners/2.jpg">
                    </a>
                    <span class="blg-date">View</span>

                  </div>

                  <div class="col-md-8  col-sm-8 col-xs-8  blg-entry">
                    <h6> <a href="index.php?gallery">Project I</a></h6>
                    <p style="line-height: 17px; padding: 8px 2px;">View Gallery</p>
                  </div>
                </li>

                <li>
                  <div class="col-md-3 col-sm-4 col-xs-4 blg-thumb p0">
                    <a href="index.php?gallery">
                      <img src="assets/img/visioners/3.jpg">
                    </a>
                    <span class="blg-date">View</span>

                  </div>
                  <div class="col-md-8  col-sm-8 col-xs-8  blg-entry">
                    <h6> <a href="index.php?gallery">Project II </a></h6>
                    <p style="line-height: 17px; padding: 8px 2px;">View Gallery</p>
                  </div>
                </li>

                <li>
                  <div class="col-md-3 col-sm-4 col-xs-4 blg-thumb p0">
                    <a href="index.php?gallery">
                      <img src="assets/img/visioners/4.jpg">
                    </a>
                    <span class="blg-date">View</span>

                  </div>
                  <div class="col-md-8  col-sm-8 col-xs-8  blg-entry">
                    <h6> <a href="index.php?gallery">Project III</a></h6>
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
            <span> (C) <a href="https://www.facebook.com/Visioner-Design-and-Builders-432801973461175/">Visioner Design and Builders</a> , All rights reserved 2018 </span>
          </div>
          <div class="bottom-menu pull-right">
            <ul>
              <li><a class="wow fadeInUp animated" href="index.php?home" data-wow-delay="0.2s">Home</a></li>
              <li><a class="wow fadeInUp animated" href="index.php?gallery" data-wow-delay="0.3s">Gallery</a></li>
              <li><a class="wow fadeInUp animated" href="privacypolicy.html" data-wow-delay="0.4s">Privacy Policy</a></li>
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
<!-- start of php code for register -->
