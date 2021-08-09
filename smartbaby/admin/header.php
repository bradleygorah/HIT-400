<?php
include("core.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Smart Baby Monitor</title>
        <meta name="description" content="For infinite ICT solutions. We provide an encompassing one stop shop for ICT services.">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alef">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab">
        <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/fonts/ionicons.min.css">
        <link rel="stylesheet" href="../assets/css/Footer-Dark.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    </head>
    <body id="page-top">
        <nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="index.php" style="color: white;">Smart Baby Monitor</a>
                <button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-align-justify"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link js-scroll-trigger" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Manage</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="index.php">Home</a></li>
      <li><a class="dropdown-item" href="manage.php">Check Up Register</a></li>
      <li><a class="dropdown-item" href="health.php">Health Tips</a></li>
      <li><a class="dropdown-item" href="users.php">Users</a></li>
      <li><a class="dropdown-item" href="users.php?nurses">Nurses</a></li>
      <li><a class="dropdown-item" href="users.php?doctors">Doctors</a></li>
    </ul>
  </li>

                        
  <?php
  if(!$_SESSION['userId']){
      ?>
      
      <?php
  }else{
      ?>
      <li class="nav-item" role="presentation">
                            <a class="nav-link js-scroll-trigger" href="logout.php">logout</a>
                        </li>
      <?php
  }
  ?>
                    </ul>
                </div>
            </div>
        </nav>

