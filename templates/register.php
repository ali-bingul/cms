<?php $this->layout('layouts/auth'); ?>
<?php
use app\core\form\Form;
$this->title = "Register";
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
    <title>Register</title>

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
            margin: 1px;
        }

        .form-group {
            margin-bottom: 0.5rem;
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
                        <div class="login-form" style="color: white;">
                            <?php $form = Form::begin('', "post") ?>
                            <?php echo $form->field($model, 'username') ?>
                            <?php echo $form->field($model, 'email') ?>
                            <?php echo $form->field($model, 'password')->passwordField() ?>
                            <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
                            <div class="register-link">
                                <p>
                                    Already have account?
                                    <a href="login">Sign In</a>
                                </p>
                            </div>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
                            <?php echo Form::end() ?>
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