<?php $this->layout('layouts/admin'); ?>
<?php
?>
<!-- BREADCRUMB-->
<section class="au-breadcrumb2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="au-breadcrumb-content">
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
                    <h2 class="number"><?php echo $memberCount?></h2>
                    <span class="desc"><a href="/admin/members" style="color: white;">members</a></span>
                    <div class="icon">
                        <i class="zmdi zmdi-account-o"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--orange">
                    <h2 class="number"><?php echo $contentCount?></h2>
                    <span class="desc"><a href="/admin/contents" style="color: white;">contents</a></span>
                    <div class="icon">
                        <i class="zmdi zmdi-content"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--blue">
                    <h2 class="number"><?php echo $commentCount?></h2>
                    <span class="desc"><a href="/admin/comments" style="color: white;">comments</a></span>
                    <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--red">
                    <h2 class="number"><?php echo $subscriberCount?></h2>
                    <span class="desc"><a href="/admin/subscribers" style="color: white;">subscribers</a></span>
                    <div class="icon">
                        <i class="zmdi zmdi-subscriber"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END STATISTIC-->