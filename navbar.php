<?php  session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">

  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="add_subject.php">Create Subject</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add_student.php">Add Student</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add_teacher.php">Add Teacher</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="edit_student_form.php">Edit Student</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="edit_teacher.php">Edit Teacher</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="check_result_teacher.php">Check Result</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add_result.php">Publish Result</a>
        </li>
      </ul>
      <form action="" method="post" class="d-flex">
        <button class="btn btn-dark" type="submit" name="logout">Logout</button>
      </form>
    </div>
  </div>
</nav>

     <?php 
      include 'logout.php';

      //$teacherRole = $_SESSION['role'];
      
      ?>