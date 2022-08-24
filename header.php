<?php
include('db.php');
include('function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Attendance</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="img/Untitled-1-modified.png" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
         
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/time_table.css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link href='https://css.gg/adidas.css' rel='stylesheet'>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Rubik+Mono+One&display=swap');
    
    /* giving color to small icon in book an event section*/
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(98%) sepia(17%) saturate(2207%) hue-rotate(330deg) brightness(99%) contrast(95%);
    }

    input[type="time"]::-webkit-calendar-picker-indicator {
        filter: invert(98%) sepia(17%) saturate(2207%) hue-rotate(130deg) brightness(99%) contrast(90%);
    }
    </style>

</head>





<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-text mx-3">Team Chromo<sup>4</sup></div>
            </a>

            <!-- Divider -->

            <hr class="sidebar-divider">
            <!-- Nav Item - Pages Collapse Menu -->
            <?php  if($_SESSION['QR_USER_ROLE']==0){ ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <img src="img/group.png" alt="" width="20">
                    <span>Users</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="student.php">Students</a>
                        <a class="collapse-item" href="staff.php">Staff</a>
                        <a class="collapse-item" href="employee.php">Employees</a>
                    </div>
                </div>
            </li>
            <?php } ?>


            <?php  if($_SESSION['QR_USER_ROLE']==1 || $_SESSION['QR_USER_ROLE']==3){ ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="scan.php" data-target="#collapseUtilities" aria-expanded="true"
                    aria-controls="collapseUtilities">
                    <img src="img/loupe.png" alt="" width="20">
                    <span>Scan</span>
                </a>
            </li>
            <?php } ?>

            <!-- Nav Item - Utilities Collapse Menu -->
            <?php  if($_SESSION['QR_USER_ROLE']==0){ ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <img src="img/er.png" alt="" width="22">
                    <span>QR Code</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item" href="qr_code.php?a=2">Students</a>
                        <a class="collapse-item" href="qr_code.php?a=1">Staff</a>
                        <a class="collapse-item" href="qr_code.php?a=3">Employees</a>

                    </div>
            </li>
            <?php } else{ ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="qr_code.php" data-target="#collapsePages" aria-expanded="true"
                    aria-controls="collapsePages">
                    <img src="img/er.png" alt="" width="22">
                    <span>QR Code</span>
                </a>

            </li>
            <?php } ?>

            <li class="nav-item">
                <a class="nav-link collapsed"
                    href="profile.php?admreq=<?php echo $_SESSION['QR_USER_ID'] ?>&pid=<?php echo $_SESSION['QR_USER_ROLE']?>"
                    data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <img src="img/id-card.png" alt="" width="20">
                    <span>Profile</span>
                </a>
            </li>


            <?php  
            if($_SESSION['QR_USER_ROLE']==1){ 
            $zincate =mysqli_query($con,"select * from event where user_id =$_SESSION[QR_USER_ID] and  user_pid=$_SESSION[QR_USER_ROLE]");
             if(mysqli_num_rows($zincate)>0){     
             ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="event.php" data-target="#collapsePages" aria-expanded="true"
                    aria-controls="collapsePages">
                    <i style="color: white;" class="fa-solid fa-calendar-check"></i>
                    <span>Your Event</span>
                </a>
            </li>
            <?php }} ?>


            <!-- Library -->
            <?php  if($_SESSION['QR_USER_ROLE']==2){ ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="library.php" data-target="#collapsePages" aria-expanded="true"
                    aria-controls="collapsePages">
                    <img src="img/book.png" alt="" width="20">
                    <span>Library</span>
                </a>
            </li>
            <?php } ?>

            <?php  if($_SESSION['QR_USER_ROLE']==3){
                $mine =mysqli_query($con,"select * from employee where email='$_SESSION[QR_USER_EMAIL]' ");
                $rant =mysqli_fetch_assoc($mine);
                if($rant['department']=='Library' && $rant['position']=='Employee'){
                ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="library.php" data-target="#collapsePages" aria-expanded="true"
                    aria-controls="collapsePages">
                    <img src="img/book.png" alt="" width="20">
                    <span>Library</span>
                </a>
            </li>
            <?php } }?>

            <?php  if($_SESSION['QR_USER_ROLE']!=0){  ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="help.php" data-target="#collapsePages" aria-expanded="true"
                    aria-controls="collapsePages">
                    <img src="img/help3.png" alt="" width="18">
                    <span>Help Desk</span>
                </a>
            </li>
            <?php } ?>

            <?php  if($_SESSION['QR_USER_ROLE']==0){  ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="help.php" data-target="#collapsePages" aria-expanded="true"
                    aria-controls="collapsePages">
                    <img src="img/comment.png" alt="" width="18">
                    <span>Messages</span>
                </a>
            </li>
            <?php } ?>

            <li class="nav-item">
                <a class="nav-link collapsed" href="logout.php" data-target="#collapsePages" aria-expanded="true"
                    aria-controls="collapsePages">
                    <img src="img/logout.png" alt="" width="18">
                    <span>Logout</span>
                </a>
            </li>




            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->




        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->


                        <li class="nav-item dropdown no-arrow">
                            <a target="_blank" class="nav-link dropdown-toggle"
                                href="https://erp.dituniversity.edu.in/">
                                <img src="img/unnamed (1).png" alt="" style="border-radius: 150px; margin: 0px"
                                    width="25px">
                                <!-- <img src="img/monkey-frustrated.gif" alt="" class="img-profile rounded-circle" >  -->
                            </a>
                            <!-- Dropdown - User Information -->

                        </li>

                        <!-- Nav Item - Alerts -->
                        <?php if($_SESSION['QR_USER_ROLE']!=0){ 
                             $fiona =mysqli_query($con,"select * from messages"); 
                             $siona =mysqli_query($con,"select * from messages order by timeupto desc"); 
                             
                             $n =0;
                             while($row2=mysqli_fetch_assoc($fiona))
                             {
                                if($row2['email']=="" || $row2['email']==4 || $row2['email']==$_SESSION['QR_USER_ROLE'] || $row2['email']==$_SESSION['QR_USER_EMAIL'])
                                {
                                    $n++;
                                }
                             }
                             ?>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>

                                <?php if($n>1){ 
                                     $n =$n-1; 
                                     ?>
                                <span class="badge badge-danger badge-counter"><?php echo $n ?>+</span>
                                <?php } ?>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown" style="overflow: auto; height: 420%; width:60%">
                                <h6 class="dropdown-header">
                                   <b> Alerts Center</b>
                                </h6>


                                <?php 
                                while($row3=mysqli_fetch_assoc($siona)){ 
                                if($row3['email']=="" || $row3['email']==4 || $row3['email']==$_SESSION['QR_USER_EMAIL'] || $row3['email']==$_SESSION['QR_USER_ROLE']){
                                 ?>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                        <i class="fa-brands fa-angellist"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500"><?php echo $row3['date'] ?></div>
                                        <span class="font-weight-bold"><?php echo $row3['des'] ?></span>
                                    </div>
                                </a>

                                <?php 
                                }
                            }
                         ?>
                                <a class="dropdown-item text-center small text-gray-500"
                                    href="profile.php?admreq=<?php echo $_SESSION['QR_USER_ID'] ?>&pid=<?php echo $_SESSION['QR_USER_ROLE']?>">End
                                    of messages</a>
                            </div>
                        </li>
                        <?php } ?>






                        <!-- Nav Item - Messages -->








                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b>Welcome
                                        <?php echo$_SESSION['QR_USER_NAME'] ?></b></span>
                                <?php if($_SESSION['IMAGE']!=""){ ?>
                                <img class="img-profile rounded-circle" src=<?php echo $_SESSION['IMAGE'] ?>>
                                <?php } else{?>
                                <img class="img-profile rounded-circle"
                                    src="https://lensesforsnap.com/wp-content/uploads/2019/03/stretched-res-lens.png">
                                <?php } ?>
                            </a>
                            <!-- Dropdown - User Information -->
                            <?php if($_SESSION['QR_USER_ROLE']==2){ ?>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a target="_blank" class="dropdown-item"
                                    href="https://www.dituniversity.edu.in/virtual-tour/index.html">
                                    <i class="fas fa-motorcycle fa-solid fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Virtual College tour
                                </a>
                                <a class="dropdown-item"
                                    href="attendance.php?sid=<?php echo $_SESSION['QR_USER_ID']?>&pid=<?php echo $_SESSION['QR_USER_ROLE'] ?>  ">
                                    <i class="fas fa-battery-full fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Attendance
                                </a>
                                <a class="dropdown-item" href="help.php">
                                    <i class="fas fa-phone fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Important Contacts
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                            <?php } ?>



                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">