<?php
    $menssagem = '';
    if(isset($_GET['status'])){
        switch ($_GET['status']) {
        case 'success':
            $menssagem = '<div class="alert alert-success text-center">Ação executada com sucesso!</div>';
            break;
        
        case 'error':
            $menssagem = '<div class="alert alert-danger text-center">Ação não executada!</div>';
            break;
        }
    }
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Inter curso unifae</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
    
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center d-flex justify-content-between">
                    <img class="logo_unifae" src="assets/images/1625239632883-logo-unifae-2021.png" alt="">
                    <!-- profile info & task notification -->
                    <div>
                        <a href="register.php"><button class="btn-cadastrar btn mr-2">Cadastrar-se</button></a>
                        <a href="login.php"><button class="brn-entrar btn">Entrar</button></a>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.php">Home</a></li>
                                <li><span>Dashboard</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix p-5"></div>
                </div>
            </div>
        <?= $menssagem ?>