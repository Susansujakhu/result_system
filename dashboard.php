<?php 
session_start();

if (isset($_SESSION['teacher_id'])) {
  $teacher_id = $_SESSION['teacher_id'];
  include 'connect.php';
  $fetch_teacher_details = $con -> query("SELECT * FROM `teacher_details` WHERE `teacher_id` = $teacher_id");
  while ($details_result = $fetch_teacher_details -> fetch_array(MYSQLI_ASSOC)) {
      $profile__img = "img/".'person.jpg';
      $db_teacher_name = $details_result['teacher_name'];
      $db_teacher_role = $details_result['role'];
  }
}
else {
    //echo 'notttt';
  header("location:./");
}
include 'logout.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LogicVent Technologies</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
  <!-- Fontastic Custom icon font-->
  <link rel="stylesheet" href="css/fontastic.css">
  <!-- Google fonts - Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
  <!-- jQuery Circle-->
  <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
  <!-- Custom Scrollbar-->
  <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
      </head>
      <body>
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <div class="side-navbar-wrapper">
            <!-- Sidebar Header    -->
            <div class="sidenav-header d-flex align-items-center justify-content-center">
              <!-- User Info-->
              <div class="sidenav-header-inner text-center"><img src=<?php echo $profile__img; ?> alt="person" class="img-fluid rounded-circle">
                <h2 class="h5"><?php echo $db_teacher_name; ?></h2><span><?php echo $db_teacher_role; ?></span>
              </div>
              <!-- Small Brand information, appears on minimized sidebar-->
              <div class="sidenav-header-logo"><a href="main_dashboard.php" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
            </div>
            <!-- Sidebar Navigation Menus-->
            <div class="main-menu">
              <h5 class="sidenav-heading">Main</h5>
              <ul id="side-main-menu" class="side-menu list-unstyled">                  
                <li><a href="main_dashboard.php"> <i class="icon-home"></i>Dashboard</a></li>
                <li><a href="add_subject_ui.php"> <i class="icon-form"></i>Add Subject                             </a></li>
                <li><a href="add_student_ui.php"> <i class="fa fa-bar-chart"></i>Add Student                             </a></li>
                <li><a href="add_teacher_ui.php"> <i class="icon-grid"></i>Add Teacher                             </a></li>
            <!--
            <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Example dropdown </a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
              </ul>
            </li>
          -->
          <li><a href="check_result_teacher_ui.php"> <i class="icon-interface-windows"></i>Check Result</a></li>
          <li><a href="add_result_ui.php"> <i class="icon-interface-windows"></i>Add Result</a></li>
          <li><a href="edit_subject_ui.php"> <i class="icon-interface-windows"></i>Edit Subject</a></li>
          <li><a href="edit_student_form_ui.php"> <i class="icon-interface-windows"></i>Edit Student Details</a></li>
          <li><a href="edit_teacher_ui.php"> <i class="icon-interface-windows"></i>Edit Teacher Details</a></li>
          <li> <a href="#"> <i class="icon-mail"></i>Demo
            <div class="badge badge-warning">6 New</div></a></li>
          </ul>
        </div>
        <div class="admin-menu">
          <h5 class="sidenav-heading">Second menu</h5>
          <ul id="side-admin-menu" class="side-menu list-unstyled"> 
            <li> <a href="#"> <i class="icon-screen"> </i>Demo</a></li>
            <li> <a href="#"> <i class="icon-flask"> </i>Demo
              <div class="badge badge-info">Special</div></a></li>
              <li> <a href=""> <i class="icon-flask"> </i>Demo</a></li>
              <li> <a href=""> <i class="icon-picture"> </i>Demo</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="page">
        <!-- navbar-->
        <header class="header">
          <nav class="navbar">
            <div class="container-fluid">
              <div class="navbar-holder d-flex align-items-center justify-content-between">
                <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="dashboard.php" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><span>    </span><strong class="text-primary">LogicVent Technologies</strong></div></a></div>
                  <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    <!-- Notifications dropdown-->
                    <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell"></i><span class="badge badge-warning">12</span></a>
                      <ul aria-labelledby="notifications" class="dropdown-menu">
                        <li><a rel="nofollow" href="#" class="dropdown-item"> 
                          <div class="notification d-flex justify-content-between">
                            <div class="notification-content"><i class="fa fa-envelope"></i>You have 6 new messages </div>
                            <div class="notification-time"><small>4 minutes ago</small></div>
                          </div></a></li>
                          <li><a rel="nofollow" href="#" class="dropdown-item"> 
                            <div class="notification d-flex justify-content-between">
                              <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                              <div class="notification-time"><small>4 minutes ago</small></div>
                            </div></a></li>
                            <li><a rel="nofollow" href="#" class="dropdown-item"> 
                              <div class="notification d-flex justify-content-between">
                                <div class="notification-content"><i class="fa fa-upload"></i>Server Rebooted</div>
                                <div class="notification-time"><small>4 minutes ago</small></div>
                              </div></a></li>
                              <li><a rel="nofollow" href="#" class="dropdown-item"> 
                                <div class="notification d-flex justify-content-between">
                                  <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                                  <div class="notification-time"><small>10 minutes ago</small></div>
                                </div></a></li>
                                <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i>view all notifications                                            </strong></a></li>
                              </ul>
                            </li>
                            <!-- Messages dropdown-->
                            <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope"></i><span class="badge badge-info">10</span></a>
                              <ul aria-labelledby="notifications" class="dropdown-menu">
                                <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                                  <div class="msg-profile"> <img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                  <div class="msg-body">
                                    <h3 class="h5">Jason Doe</h3><span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
                                  </div></a></li>
                                  <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                                    <div class="msg-profile"> <img src="img/avatar-2.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                    <div class="msg-body">
                                      <h3 class="h5">Frank Williams</h3><span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
                                    </div></a></li>
                                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                                      <div class="msg-profile"> <img src="img/avatar-3.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                      <div class="msg-body">
                                        <h3 class="h5">Ashley Wood</h3><span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
                                      </div></a></li>
                                      <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-envelope"></i>Read all messages    </strong></a></li>
                                    </ul>
                                  </li>
                <!-- Languages dropdown    
                <li class="nav-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><img src="img/flags/16/GB.png" alt="English"><span class="d-none d-sm-inline-block">English</span></a>
                  <ul aria-labelledby="languages" class="dropdown-menu">
                    <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/DE.png" alt="English" class="mr-2"><span>German</span></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/FR.png" alt="English" class="mr-2"><span>French                                                         </span></a></li>
                  </ul>
                </li>
              -->

              <!-- Log out-->



              <li class="nav-item">

                <form action="" method="post">
                  <button type="submit" name="logout" class="nav-link logout"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out"></i></button>           
                </form>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    
    <!-- DashBoard Main Contains -->

      <div class="container-fluid overflow-auto">
      
    
    <?php 
    call_function();
     ?>
     </div>
 
    

    <footer class="main-footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <p>Your company &copy; 2017-2020</p>
          </div>
          <div class="col-sm-6 text-right">
            <p>Design by <a href="https://logicvent.com/" class="external">LogicVent</a></p>
            <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions and it helps me to run Bootstrapious. Thank you for understanding :)-->
          </div>
        </div>
      </div>
    </footer>
  </div>
  <!-- JavaScript files-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
  <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
  <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="js/charts-home.js"></script>
  <!-- Main File-->
  <script src="js/front.js"></script>
</body>
</html>

