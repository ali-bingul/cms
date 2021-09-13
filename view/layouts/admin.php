<?php

use app\controller\MemberController;
use app\core\Application;

$memberController = new MemberController();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title><?php echo Application::$app->view->title ?></title>

    <!-- Fontfaces CSS-->
    <link href="<?php echo PUBLIC_PATH ?>/css/font-face.css" rel="stylesheet" media="all">
    <link href="<?php echo PUBLIC_PATH ?>/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?php echo PUBLIC_PATH ?>/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?php echo PUBLIC_PATH ?>/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?php echo PUBLIC_PATH ?>/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="<?php echo PUBLIC_PATH ?>/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?php echo PUBLIC_PATH ?>/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="<?php echo PUBLIC_PATH ?>/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?php echo PUBLIC_PATH ?>/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?php echo PUBLIC_PATH ?>/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="<?php echo PUBLIC_PATH ?>/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?php echo PUBLIC_PATH ?>/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?php echo PUBLIC_PATH ?>/css/theme.css" rel="stylesheet" media="all">

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <!-- bootstrap css -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"> -->


    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <style>
        .page-wrapper {
            background: #FCA311;
            /* background: #aed2dc; */
        }

        .page-content--bgf7 {
            background: #FCA311;
            /* background: #aed2dc; */
        }

        #menu-outer {
            height: 84px;
            /* background: url(images/bar-bg.jpg) repeat-x; */
        }

        .table {
            display: table;
            /* Allow the centering to work */
            margin: 0 auto;
        }

        ul#horizontal-list {
            min-width: 696px;
            list-style: none;
            padding-top: 20px;
            display: flex;
            justify-content: center;
        }

        ul#horizontal-list li {
            display: inline;
            padding: 1rem;
            margin: 1rem;
            /* background: #365CAD; */
            background: black;
            border-radius: 4rem;
            height: 4rem;
            width: 6rem;
        }

        ul#horizontal-list li a {
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <a href="/cms/admin">
                            <img src="<?php echo PUBLIC_PATH ?>/images/icon/logo-white.png" alt="CoolAdmin" />
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            <li>
                                <a href="/cms/admin">
                                    <i class="fas fa-home"></i>
                                    <span class="bot-line"></span>Dashboard</a>
                            </li>
                            <li>
                                <a href="/cms/admin/contents">
                                    <i class="fas fa-list"></i>
                                    <span class="bot-line"></span>Contents</a>
                            </li>
                            <li>
                                <a href="/cms/admin/comments">
                                    <i class="fas fa-comments"></i>
                                    <span class="bot-line"></span>Comments</a>
                            </li>
                            <li>
                                <a href="/cms/admin/members">
                                    <i class="fas fa-users"></i>
                                    <span class="bot-line"></span>Members</a>
                            </li>
                            <li>
                                <a href="/cms/admin/subscribers">
                                    <i class="fas fa-thumbs-up"></i>
                                    <span class="bot-line"></span>Subscribers</a>
                            </li>
                        </ul>
                    </div>
                    <div class="header__tool">
                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                                <div class="content">
                                    <a class="js-acc-btn" href="#">Ali Bingül</a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="/cms/admin/account">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <a href="/cms/admin/logout">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->
        <!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="/cms/admin">
                            <img src="<?php echo PUBLIC_PATH ?>/images/icon/logo-white.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="/cms/admin">
                                <i class="fas fa-home"></i>
                                <span class="bot-line"></span>Dashboard</a>
                        </li>
                        <li>
                            <a href="/cms/admin/contents">
                                <i class="fas fa-list"></i>
                                <span class="bot-line"></span>Contents</a>
                        </li>
                        <li>
                            <a href="/cms/admin/comments">
                                <i class="fas fa-comment"></i>
                                <span class="bot-line"></span>Comments</a>
                        </li>
                        <li>
                            <a href="/cms/admin/members">
                                <i class="fas fa-user"></i>
                                <span class="bot-line"></span>Members</a>
                        </li>
                        <li>
                            <a href="/cms/admin/account">
                                <i class="fas fa-thumbs-up"></i>
                                <span class="bot-line"></span>Account</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="sub-header-mobile-2 d-block d-lg-none" style="background: #FCA311;">
            <div class="header__tool">
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="content">
                            <a class="js-acc-btn" href="#">Admin</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <a href="/cms/admin/account">
                                        <i class="zmdi zmdi-account"></i>Account</a>
                                </div>
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="/cms/admin/logout">
                                    <i class="zmdi zmdi-power"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END HEADER MOBILE -->
        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">

            <div class="container">
                {{content}}
            </div>


            <footer>
                <section class="p-t-60 p-b-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- END COPYRIGHT-->
            </footer>
            <!-- COPYRIGHT-->
        </div>
    </div>
    <!-- Jquery JS-->
    <script src="<?php echo PUBLIC_PATH ?>/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <!-- <script src="<?php /*echo PUBLIC_PATH*/ ?>/vendor/bootstrap-4.1/popper.min.js"></script> -->
    <!-- <script src="<?php /*echo PUBLIC_PATH*/ ?>/vendor/bootstrap-4.1/bootstrap.min.js"></script> -->
    <!-- Vendor JS       -->
    <script src="<?php echo PUBLIC_PATH ?>/vendor/slick/slick.min.js">
    </script>
    <script src="<?php echo PUBLIC_PATH ?>/vendor/wow/wow.min.js"></script>
    <script src="<?php echo PUBLIC_PATH ?>/vendor/animsition/animsition.min.js"></script>
    <script src="<?php echo PUBLIC_PATH ?>/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="<?php echo PUBLIC_PATH ?>/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?php echo PUBLIC_PATH ?>/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="<?php echo PUBLIC_PATH ?>/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="<?php echo PUBLIC_PATH ?>/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo PUBLIC_PATH ?>/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?php echo PUBLIC_PATH ?>/vendor/select2/select2.min.js"></script>
    <!-- Main JS-->
    <script src="<?php echo PUBLIC_PATH ?>/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




</body>

</html>
<!-- end document-->