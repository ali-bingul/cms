<?php

use app\core\Application;
use app\core\form\Form;
$this->title = "Login";
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
    <title>Login</title>

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

    <style>
        .page-wrapper {
            background: black;
        }

        .page-content--bge5 {
            background: black;
        }
    </style>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content" style="background: black;">
                        <div class="login-logo">
                            <a href="#">
                            <img src="<?= PUBLIC_PATH ?>/philosophy/images/logo.svg" alt="Homepage" style="width: 15rem">
                            </a>
                        </div>
                        <div class="login-form" style="color: white; background: black;">
                            <!-- ALERT MESSAGE FOR REGISTRATION -->
                            <?php if (Application::$app->session->getFlash('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">Welcome!</h4>
                                    <p><?php echo Application::$app->session->getFlash('success') ?></p>
                                </div>
                            <?php endif; ?>
                            <!-- ALERT MESSAGE FOR REGISTRATION -->
                            <?php $form = Form::begin('', "post") ?>
                            <?php echo $form->field($model, 'email') ?>
                            <?php echo $form->field($model, 'password')->passwordField() ?>


                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="register">Sign Up Here</a>
                                </p>
                            </div>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                            <?php echo Form::end() ?>
                            <!--<form action="" method="post">
                                 <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="forgotpassword">Forgotten Password?</a>
                                    </label>
                                </div> -->
                            <!-- <div class="social-login-content">
                                    <div class="social-button">
                                        <button class="au-btn au-btn--block au-btn--blue m-b-20">sign in with facebook</button>
                                        <button class="au-btn au-btn--block au-btn--blue2">sign in with twitter</button>
                                    </div>
                                </div> 
                            </form>-->

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="<?php echo PUBLIC_PATH ?>/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?php echo PUBLIC_PATH ?>/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?php echo PUBLIC_PATH ?>/vendor/bootstrap-4.1/bootstrap.min.js"></script>
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
    <script src="<?php echo PUBLIC_PATH ?>/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="<?php echo PUBLIC_PATH ?>/js/main.js"></script>

</body>

</html>
<!-- end document-->