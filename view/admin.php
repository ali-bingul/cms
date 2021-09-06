<?php

use app\controller\CommentController;
use app\controller\ContentController;
use app\controller\MemberController;
use app\controller\SubscriberController;
use app\core\Application;
    $this->title = "Dashboard";
    $memberController = new MemberController();
    $contentController = new ContentController();
    $subscriberController = new SubscriberController();
    $commentController = new CommentController();
?>
<!-- BREADCRUMB-->
<section class="au-breadcrumb2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="au-breadcrumb-content">
                    <!-- <div class="au-breadcrumb-left">
                        <span class="au-breadcrumb-span">You are here:</span>
                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                            <li class="list-inline-item active">
                                <a href="#">Home</a>
                            </li>
                            <li class="list-inline-item seprate">
                                <span>/</span>
                            </li>
                            <li class="list-inline-item">Dashboard</li>
                        </ul>
                    </div> -->
                    <!-- <form class="au-form-icon--sm" action="" method="post">
                        <input class="au-input--w300 au-input--style2" type="text" placeholder="Search for datas &amp; reports...">
                        <button class="au-btn--submit2" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END BREADCRUMB-->

<!-- WELCOME-->
<section class="welcome p-t-10">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title-4">Welcome back
                    <span>Ali Bingül!</span>
                </h1>
                <hr class="line-seprate">
            </div>
        </div>
    </div>
</section>
<!-- END WELCOME-->

<!-- STATISTIC-->
<section class="statistic statistic2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--green">
                    <h2 class="number"><?php echo count($memberController->getMembers())?></h2>
                    <span class="desc"><a href="/cms/admin/members" style="color: white;">members</a></span>
                    <div class="icon">
                        <i class="zmdi zmdi-account-o"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--orange">
                    <h2 class="number"><?php echo count($contentController->getContents())?></h2>
                    <span class="desc"><a href="/cms/admin/contents" style="color: white;">contents</a></span>
                    <div class="icon">
                        <i class="zmdi zmdi-content"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--blue">
                    <h2 class="number"><?php echo count($commentController->getComments())?></h2>
                    <span class="desc"><a href="/cms/admin/comments" style="color: white;">comments</a></span>
                    <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--red">
                    <h2 class="number"><?php echo count($subscriberController->getSubscribers())?></h2>
                    <span class="desc"><a href="/cms/admin/subscribers" style="color: white;">subscribers</a></span>
                    <div class="icon">
                        <i class="zmdi zmdi-subscriber"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END STATISTIC-->