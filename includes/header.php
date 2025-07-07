<?php
    require_once 'vendor/autoload.php';

    use \App\Entity\Usuario;

    $usuario = null;
    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
    }

    $menssagem = '';
    if(isset($_GET['status'])){
        switch ($_GET['status']) {
        case 'success':
            $menssagem = '<div class="alert alert-success text-center mt-5">'.$_SESSION['menssagem'].'</div>';
            break;
        
        case 'error':
            $menssagem = '<div class="alert alert-danger text-center mt-5">'.$_SESSION['menssagem'].'</div>';
            break;

        case 'warning':
            $menssagem = '<div class="alert alert-warning text-center mt-5">'.$_SESSION['menssagem'].'</div>';
            break;
        }
    }
?>

<!doctype html>
<html class="no-js" lang="pt-BR">

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
    <div class="page-container">
        <div class="main-content">
            <div class="header-area">
                <div class="row align-items-center d-flex justify-content-between">
                    <img class="logo_unifae" src="assets/images/1625239632883-logo-unifae-2021.png" alt="">
                    <?php if(!$usuario): ?>
                        <div>
                            <a href="login.php"><button class="btn-entrar btn mr-2">Entrar</button></a>
                            <a href="register.php"><button class="btn-cadastrar btn">Cadastrar-se</button></a>
                        </div>
                    <?php elseif($usuario): ?>
                        <div class="logado">
                            <?php if($usuario->tipo == "Organizador"): ?>
                                <a href="gestores.php" class="mr-3">Gestores</a>
                                <a href="modalidades.php" class="mr-3">Modalidades</a>
                                <a href="jogos.php" class="mr-3">Jogos</a>
                            <?php elseif($usuario->tipo == "gestor"): ?>
                                <a href="definir_atletas.php" class="mr-3">Definir atletas</a>
                                <a href="atletas.php" class="mr-3">Atletas do time</a>
                                <a href="times.php" class="mr-3">Meu time</a>
                            <?php endif; ?>

                            <a href="profile.php" class="user mr-3"><?= $usuario->nome ?></a>
                            <a href="logout.php">Sair</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
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
        <div class="container">
            <?= $menssagem ?>
        </div>