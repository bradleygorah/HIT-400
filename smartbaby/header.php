<?php
require 'core.php';
date_default_timezone_set('Africa/Harare');
if(isset($_SESSION['userId'])){
    $member_id = $_SESSION['userId']; // you can your integerate authentication module here to get logged in member
    }

$user = "SELECT * FROM users WHERE user_id = '$member_id'";
$query = $connect->query($user);
$data = $query->fetch_assoc();

$merchant = $_SESSION['userId'];
$sql2 = "SELECT * FROM users WHERE user_id = $merchant";
$result2 = $connect->query($sql2);
$row2 = $result2->fetch_assoc();
$merchants = $row2['	user_id'];
$email            = $row2['email'];

$bornday            = $row2['babydob'];
$datestamp           = date("Y-m-d");


$sql4 = "SELECT * FROM register WHERE patient = $merchant ORDER by date DESC LIMIT 1";
                                    $result4 = $connect->query($sql4);
                                    $row4 = $result4->fetch_assoc();
                                    

                                    $sql3 = "SELECT count(*) FROM register WHERE patient = $merchant";
                                    $result3 = $connect->query($sql3);
                                    $row3 = $result3->fetch_row();

                                    $sql7 = "SELECT count(*) FROM register WHERE patient = $merchant AND alert=2";
                                    $result7 = $connect->query($sql7);
                                    $row7 = $result7->fetch_row();

                                    $sql5 = "SELECT count(*) FROM register WHERE patient = $merchant AND status = 'missed'";
                                    $result5 = $connect->query($sql5);
                                    $row5 = $result5->fetch_row();

                                    $sql6 = "SELECT count(*) FROM register WHERE patient = $merchant AND status = 'visited'";
                                    $result6 = $connect->query($sql6);
                                    $row6 = $result6->fetch_row();

                                    $percent = ($row6[0]/$row3[0])*100;
                                    $mpercent = ($row5[0]/$row3[0])*100;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Bradley's smart baby monitor</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="chatbot/style.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-danger p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15">
                    <!-- <i class="fas fa-laugh-wink"></i> -->
                    </div>
                    <div class="sidebar-brand-text mx-auto"><span>Baby monitor</span></div>
                </a>
                <hr class="sidebar-divider justify-content-center">
                <ul class="nav navbar-nav text-light text-left" id="accordionSidebar">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.php"><i class="fas fa-prescription-bottle-alt"></i><span>home</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="table.php"><i class="fas fa-table"></i><span>Health records</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="maya.php"><i class="fas fa-table"></i><span>Talk to Bradley</span></a></li>
                    <!-- <li class="nav-item" role="presentation"><a class="nav-link" href="setting.php"><i class="far fa-user-circle"></i><span>Account settings</span></a></li> -->
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        
        <div class="d-flex flex-column" id="content-wrapper">
        
        <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                      
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
                                <span class="badge badge-danger badge-counter"><?php echo $row7[0];?></span><i class="fas fa-bell fa-fw"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in"
                                        role="menu">
                                        <h6 class="dropdown-header">alerts center</h6>
                                        <?php
                                $sql4a = "SELECT * FROM register WHERE patient = $merchant AND alert = 2 ORDER by date DESC";
                                $result4a = $connect->query($sql4a);
                                while($row4a = $result4a->fetch_assoc()){

                                ?>
                                        <a class="d-flex align-items-center dropdown-item" href="table.php?i=<?php echo $row4a['id'];?>">
                                            <div class="mr-3">
                                                <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500"><?php echo $row4a['date'];?></span>
                                                <p>A new check up date has been scheduled! click to view.</p>
                                            </div>
                                        </a>
                                        <?php
                                }
                                        ?>
                                </div>
                            </li>
                            <!-- <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-envelope fa-fw"></i><span class="badge badge-danger badge-counter">7</span></a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in"
                                        role="menu">
                                        <h6 class="dropdown-header">alerts center</h6>
                                        <a class="d-flex align-items-center dropdown-item" href="#">
                                            <div class="dropdown-list-image mr-3">
                                                <div class="bg-success status-indicator"></div>
                                            </div>
                                            <div class="font-weight-bold">
                                                <div class="text-truncate"><span>Polio immunisation  for Kuda on 6/6/2021</span></div>
                                                <p class="small text-gray-500 mb-0">system - 58m</p>
                                            </div>
                                        </a>
                                        
                                        </a><a class="text-center dropdown-item small text-gray-500" href="#">Show All Alerts</a></div>
                                </div>
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                            </li> -->
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow" role="presentation">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $data['first_name'].' '.$data['last_name'];?></span><img class="border rounded-circle img-profile" src="assets/img/blank-profile-picture-973460.svg"></a>
                                    <div
                                        class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu"><a class="dropdown-item" role="presentation" href="profile.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a>
                                     
                                        <a
                                            class="dropdown-item" role="presentation" href="table.php"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a></div>
                    </div>
                    </li>
                    </ul>
            </div>
            </nav>