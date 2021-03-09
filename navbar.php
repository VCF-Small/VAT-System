<?php 

  echo '<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
  <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
          <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-address-card"></i></div>
          <div class="sidebar-brand-text mx-3"><span>VAT</span></div>
      </a>
      <hr class="sidebar-divider my-0">
      <ul class="nav navbar-nav text-light" id="accordionSidebar">
      <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-table"></i><span>Dashboard</span></a></li>
          <li class="nav-item">
              <div class="dropdown show">
                  <a class="nav-link dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-tachometer-alt"></i>Admin
                  </a>
                
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item"  href="departments.php">Departments</a>
                      <a class="dropdown-item"  href="classes.php">Classes</a>
                      <a class="dropdown-item"  href="add_student.php">Add Student</a>
                  </div>
              </div>
          </li>
          <!-- <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user"></i><span>Student Profile</span></a></li> -->
          <!-- <li class="nav-item"><a class="nav-link" href="table.php"><i class="far fa-user-circle"></i><span>Employees</span></a></li> -->

          <li class="nav-item"><a class="nav-link" href="students.php"><i class="fa fa-users" aria-hidden="true"></i></i><span>Students</span></a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Log Out</span></a></li>
          <!-- <li class="nav-item"><a class="nav-link" href="register.php"><i class="fas fa-user-circle"></i><span>Register</span></a></li> -->
          <!-- <li class="nav-item"><a class="nav-link" href="register.php"><i class="fas fa-user-circle"></i><span>Register</span></a></li> -->
          
      </ul>
      <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
  </div>
</nav>
';
?>