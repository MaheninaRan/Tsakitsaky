<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Gestion</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo base_url('asset/css/bootstrap.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/lib/animate/animate.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('lib/owlcarousel/assets/owl.carousel.min.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/all.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/all.css') ?>">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css') ?>">
    <!-- Template Stylesheet -->
    <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet">
    <script src="<?= base_url("asset/html2pdf.bundle.js") ?>"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="index.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">Tsakitsaky</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="<?= site_url('index.php/AdminController/accueil')?>" class="nav-item nav-link">Accueil</a>
                <a href="<?= site_url('index.php/AdminController/listePaiment')?>" class="nav-item nav-link">Liste paiement</a>


                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">CRUD</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="<?= base_url("index.php/AdminController/accueil") ?>" class="dropdown-item">Packet</a> 
                        <a href="<?= base_url("index.php/AdminController/crudFormule") ?>" class="dropdown-item">Formule packet</a>    
                    </div>
                </div>

                </div>
                        <a href="<?= base_url("index.php/Welcome/deconnexion") ?>" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block"><div class="logo">Deconnexion</div></a>    
                  
                <style>
                   .dropdown-menu a{
                        font-size: 15px;
                        text-decoration: none;
                    }
                    .dropdown-menu a:hover{
                        background-color: #00B074;
                        color: white;
                        font-weight: bold;
                    }

                    .logo{
                        font-size: 25px;
                        margin-top: -10px;
                    }
                    .bar{
                       background-color: white;
                       border-bottom: solid 1px red;
                       margin-bottom: 2%;
                    }
                    h6{
                        color: red;
                        font-family: 'Times New Roman', Times, serif;
                    }
                </style>
            </div>
        </nav>  
</body>
</html>