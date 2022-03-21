<?php

/**
 * @var $model \app\model\Subscriber
 */

use app\core\Application;
use app\core\form\Form;
use app\core\form\SubscribeField;
use app\model\Subscriber;
use app\services\CategoryService;
use app\services\MemberService;

$categoryService = new CategoryService();
$memberService = new MemberService();
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Philosophy</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="<?= PUBLIC_PATH ?>/philosophy/css/base.css">
    <link rel="stylesheet" href="<?= PUBLIC_PATH ?>/philosophy/css/vendor.css">
    <link rel="stylesheet" href="<?= PUBLIC_PATH ?>/philosophy/css/main.css">

    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- script
    ================================================== -->
    <script src="<?= PUBLIC_PATH ?>/philosophy/js/modernizr.js"></script>
    <script src="<?= PUBLIC_PATH ?>/philosophy/js/pace.min.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="<?= PUBLIC_PATH ?>/philosophy/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= PUBLIC_PATH ?>/philosophy/favicon.ico" type="image/x-icon">

    <!-- Bootstrap css -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"> -->

    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <style>
        .s-pageheader--home {
            min-height: 170px;
        }
    </style>

</head>
<body id="top">
    <!-- pageheader
    ================================================== -->
    <section class="s-pageheader s-pageheader--home">
        <header class="header">
            <div class="header__content row">
                <div class="header__logo">
                    <a class="logo" href="/">
                        <img src="<?= PUBLIC_PATH ?>/philosophy/images/logo.svg" alt="Homepage">
                    </a>
                </div> <!-- end header__logo -->
                <ul class="header__social">
                    <li>
                        <a href="https://www.linkedin.com/in/alibingul/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    </li>
                </ul> <!-- end header__social -->
                <?php if (Application::isGuest()) : ?>
                    <div style="display:flex; justify-content:flex-end;">
                        <a href="/login" style="color: white;">Login</a>
                    </div>
                    <div style="display:flex; justify-content:flex-end;">
                        <a href="/register" style="color: white;">Register</a>
                    </div>
                <?php else : ?>
                    <div style="display:flex; justify-content:flex-end;">
                        <a href="/logout" style="color: white;"><?php echo /*Application::$app->member->getDisplayName();*/ $memberService->getMember(['id' => $_SESSION['member']])->username ?>
                            (Logout)
                        </a>
                    </div>
                <?php endif; ?>
                </div> <!-- end header__search -->
                <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>
                <nav class="header__nav-wrap">
                    <h2 class="header__nav-heading h6">Site Navigation</h2>
                    <ul class="header__nav">
                        <li><a href="/" title="">Home</a></li>
                        <li class="has-children">
                            <a href="#0" title="">Categories</a>
                            <ul class="sub-menu">
                                <?php foreach ($categoryService->getCategories() as $key => $value) : ?>
                                    <li><a href="/categories/<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li><a href="/about" title="">About</a></li>
                        <li><a href="/contact" title="">Contact</a></li>
                        <?php if (!Application::isGuest()) : ?>
                            <li class=""><a href="/favorites" title="">Favorites</a></li>
                            <li><a href="/account" title="">Account</a></li>
                        <?php endif; ?>
                    </ul> <!-- end header__nav -->
                    <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>
                </nav> <!-- end header__nav-wrap -->
            </div> <!-- header-content -->
        </header> <!-- header -->
    </section> <!-- end s-pageheader -->
    <?php echo $this->section('content'); ?>
    <!-- s-footer
    ================================================== -->
    <footer class="s-footer">
        <div class="s-footer__main">
            <div class="row">
                <div class="col-two md-four mob-full s-footer__sitelinks">
                    <h4>Quick Links</h4>
                    <ul class="s-footer__linklist">
                        <li><a href="/">Home</a></li>
                        <li><a href="/categories">Categories</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/contact">Contact</a></li>
                        <?php if (!Application::isGuest()) : ?>
                            <li><a href="/favorites">Favorites</a></li>
                            <li><a href="/account">Account</a></li>
                        <?php endif; ?>
                    </ul>
                </div> <!-- end s-footer__sitelinks -->
                <div class="col-two md-four mob-full s-footer__social">
                    <h4>Social</h4>
                    <ul class="s-footer__linklist">
                        <li><a href="https://www.linkedin.com/in/alibingul/" target="_blank">LinkedIn</a></li>
                    </ul>
                </div> <!-- end s-footer__social -->
                <?php if ($_SERVER['REQUEST_URI'] === "/") : ?>
                    <!-- SUBSCRIBE ME -->
                    <div class="col-five md-full end s-footer__subscribe">
                        <h4>Subscribe Me</h4>
                        <?php if (Application::$app->session->getFlash('success')) : ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">You Subscribed!</h4>
                                <p><?php echo Application::$app->session->getFlash('success') ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="subscribe-form" style="color: white;">
                            <?php Form::begin('', 'post') ?>
                            <!-- <form method="post" action=""> -->
                            <?php echo new SubscribeField(new Subscriber(), 'email') ?>
                            <input type="submit" name="subscribe" value="Subscribe" style="background: black; color: white;">
                            </form>
                            <?php /*Form::end()*/ ?>
                        </div>
                    </div> <!-- end s-footer__subscribe -->
                    <!-- END SUBSCRIBE ME -->
                <?php endif; ?>
            </div>
        </div> <!-- end s-footer__main -->
        <div class="s-footer__bottom">
            <div class="row">
                <div class="col-full">
                    <div class="s-footer__copyright">
                        <span>© Copyright Philosophy 2018</span>
                        <span>Site Template by <a href="https://colorlib.com/">Colorlib</a></span>
                    </div>

                    <div class="go-top">
                        <a class="smoothscroll" title="Back to Top" href="#top"></a>
                    </div>
                </div>
            </div>
        </div> <!-- end s-footer__bottom -->
    </footer> <!-- end s-footer -->

    <!-- Java Script
    ================================================== -->
    <script src="<?= PUBLIC_PATH ?>/philosophy/js/jquery-3.2.1.min.js"></script>
    <script src="<?= PUBLIC_PATH ?>/philosophy/js/plugins.js"></script>
    <script src="<?= PUBLIC_PATH ?>/philosophy/js/main.js"></script>

    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/js/all.min.js" integrity="sha512-Cvxz1E4gCrYKQfz6Ne+VoDiiLrbFBvc6BPh4iyKo2/ICdIodfgc5Q9cBjRivfQNUXBCEnQWcEInSXsvlNHY/ZQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>