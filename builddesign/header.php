
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
        <a class="navbar-brand" href="../index.php?home"><img src="../assets/img/logo.png" alt=""></a>
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
              <li><a href="../user/user_account.php?edit_profile">Edit Information</a></li>
              <li><a href="../user/user_account.php?check_transaction">Check Transaction</a></li>
              <li><a href="../user/user_account.php?check_payment">Check Payment</a></li>
              <li><a href="../user/user_account.php?check_date">Check Appointment Date</a></li>
              <li><a href="../user/user_account.php?change_password">Change Password</a></li>
              <li><a href="../user/logout.php">Logout</a></li>
            </ul>
          </div>
          <?php
						}
						else
						{
						?>
          <div class="btn-group">
            <button class="navbar-btn nav-button wow bounceInRight login" onclick="window.open('../index.php?login', '_self')" data-wow-delay="0.4s">Login</button>
          </div>
          <div class="btn-group">
            <button class="navbar-btn nav-button wow bounceInRight login" onclick=" window.open('../index.php?login', '_self')" data-wow-delay="0.5s">Account</button>
          </div>

          <?php
						}
						?>

          <div class="btn-group">
            <button class="navbar-btn nav-button wow fadeInRight" onclick=" window.open('start.php', '_self')" data-wow-delay="0.5s">Start Design & Build</button>
          </div>

        </div>
        <ul class="main-nav nav navbar-nav navbar-right">
          <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="" href="../index.php?about">About</a></li>
          <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="" href="../index.php?services">Services</a></li>
          <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="" href="../index.php?gallery">Gallery</a></li>
          <li class="wow fadeInDown" data-wow-delay="0.4s"><a href="../index.php?contact">Contact</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <!-- End of nav bar -->

  <div class="page-head">
    <div class="container">
      <div class="row">
        <div class="page-head-content">
          <h1 class="page-title">Online Design and Build</h1>
        </div>
      </div>
    </div>
  </div>
  <!-- End page header -->
