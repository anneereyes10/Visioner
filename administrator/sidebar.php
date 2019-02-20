<ul class="sidebar navbar-nav">

  <!-- Start Dropdown Menu for Payments -->
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-folder"></i>
      <span>Payments</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <h6 class="dropdown-header">Pending Payments</h6>
      <a class="dropdown-item" href="ViewPayment.php">New Payments</a>
      <a class="dropdown-item" href="index.php?pending_payments">Unpaid Customers</a>
      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">Finished Payments</h6>
      <a class="dropdown-item" href="index.php?paid_payments">Paid Customers</a>
      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">Manage Payments</h6>
      <a class="dropdown-item" href="index.php?payments">Modify Payments</a>

    </div>
  </li>
  <!-- End Dropdown Menu for Payments -->

  <!-- Start Dropdown Menu for Appointments -->
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-folder"></i>
      <span>Appointments</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <h6 class="dropdown-header">Appointments</h6>
      <a class="dropdown-item" href="ViewAppointment.php">View Appointments</a>
      <h6 class="dropdown-header">Pending Appointments</h6>
      <a class="dropdown-item" href="index.php?new_appointments">New Appointments</a>
      <a class="dropdown-item" href="index.php?pending_appointments">Pending Appointments</a>
      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">Finished Appointments</h6>
      <a class="dropdown-item" href="index.php?fin_appointments">Finished Appointments</a>
      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">Manage Appointments</h6>
      <a class="dropdown-item" href="index.php?modify_calendar">Modify Appointments</a>

    </div>
  </li>
  <!-- menu for services -->
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-folder"></i>
      <span>Services</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <h6 class="dropdown-header">Manage</h6>
      <a class="dropdown-item" href="index.php?add_services">Add Services</a>

    </div>
  </li>
  <!--  Dropdown Menu for Customers -->
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-folder"></i>
      <span>Customers</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <h6 class="dropdown-header">Manage Customers</h6>
      <a class="dropdown-item" href="index.php?view_customers">View All Customers</a>
      <a class="dropdown-item" href="index.php?search_customers">Search for a Customer</a>
    </div>
  </li>

  <!--  Dropdown Menu for Defaults -->
  <li class="nav-item">
    <a class="nav-link" href="AddFinish.php" id="pagesDropdown">
      <i class="fas fa-fw fa-clipboard-list"></i>
      <span>Set Finish</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="ViewPaymentType.php" id="pagesDropdown">
      <i class="fas fa-fw fa-money-check"></i>
      <span>Payment Type</span>
    </a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-pencil-ruler"></i>
      <span>Design & Build</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <h6 class="dropdown-header">Plan</h6>
      <a class="dropdown-item" href="AddPlan.php">Add Plan</a>
      <a class="dropdown-item" href="ViewPlan.php">View Plan</a>
    </div>
  </li>
</ul>
