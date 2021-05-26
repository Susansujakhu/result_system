<?php 
session_start();

if (isset($_SESSION['studentId'])) {
  $student_id = $_SESSION['studentId'];
  include 'connect.php';
  $fetch_teacher_details = $con -> query("SELECT * FROM `student_details` WHERE `student_id` = $student_id");
  while ($details_result = $fetch_teacher_details -> fetch_array(MYSQLI_ASSOC)) {
      $profile__img = "img/".'person.jpg';
      $db_student_name = $details_result['student_name'];
      $db_student_batch = $details_result['batch']." Batch";
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
                <h2 class="h5"><?php echo $db_student_name; ?></h2><span><?php echo $db_student_batch; ?></span>
              </div>
              <!-- Small Brand information, appears on minimized sidebar-->
              <div class="sidenav-header-logo"><a href="student_dashboard_ui.php" class="brand-small text-center"> <strong>L</strong><strong class="text-primary">V</strong></a></div>
            </div>
            <!-- Sidebar Navigation Menus-->
            <div class="main-menu">
              <h5 class="sidenav-heading">Main</h5>
              <ul id="side-main-menu" class="side-menu list-unstyled">                  
                <li><a href="main_dashboard.php"> <i class="icon-home"></i>Dashboard</a></li>
                <li><a href="#"> <i class="icon-home"></i>Student Details</a></li>
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
                <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a>
                  <a href="student_dashboard_ui.php" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><span>    </span><strong class="text-success">LogicVent Technologies</strong></div></a></div>
                  <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">


              <!-- Log out-->



              <li class="nav-item">

                <form action="" method="post">
                  <button type="submit" name="logout" class="nav-link logout btn btn-success"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out ml-1"></i></button>           
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

