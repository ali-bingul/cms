<?php

use app\core\Application;
use app\controller\MemberController;
use app\core\form\Form;

$this->title = "Account";
$memberController = new MemberController();
$member = $memberController->getMember(['id' => $_SESSION['member']]);

?>
<!-- <h1 style="color: white;">Account</h1> -->
<!-- 
<input type="text" value="username"> -->
<!-- <?php /*$form = Form::begin('', 'post')*/ ?>
    <input type="text" value="username">
    <input type="email" value="email">
    <input type="password" value="password">
<?php /*Form::end()*/ ?> -->

<!-- s-content
================================================== -->
<section class="s-content s-content--narrow">
    <?php if (Application::$app->session->getFlash('success')) : ?>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Updated!</h4>
            <p><?php echo Application::$app->session->getFlash('success') ?></p>
        </div>
    <?php endif; ?>
    <div class="row">

        <div class="s-content__header col-full">
            <h1 class="s-content__header-title">
                Account.
            </h1>
            <h1 class="s-content__header-title">
                Username : <?php echo $member->username ?>
            </h1>
            <h1 class="s-content__header-title">
                Email : <?php echo $member->email ?>
            </h1>
        </div> <!-- end s-content__header -->

        <div class="col-full s-content__main">
            <h3>Change Username & Password</h3>

            <form name="cForm" id="cForm" method="post" action="">
                <fieldset>

                    <div class="form-field">
                        <label for="username">Username</label>
                        <input name="username" type="text" id="username" class="full-width" placeholder="Username" value="<?php echo $member->username ?>">
                    </div>

                    <div class="form-field">
                        <!-- <label for="email">Email</label> -->
                        <input name="email" disabled type="email" id="email" class="full-width" placeholder="Email" value="<?php echo $member->email ?>">
                    </div>

                    <div class="form-field">
                        <label for="oldpassword">Old Password</label>
                        <input name="oldpassword" type="password" id="oldpassword" class="full-width" placeholder="Old Password" value="">
                    </div>
                    <div class="form-field">
                        <label for="password">New Password</label>
                        <input name="password" type="password" id="password" class="full-width" placeholder="New Password" value="">
                    </div>
                    <div class="form-field">
                        <label for="confirmPassword">Confirm Password</label>
                        <input name="confirmPassword" type="password" id="confirmPassword" class="full-width" placeholder="Confirm Password" value="">
                    </div>

                    <button type="submit" class="submit btn btn--primary full-width">Update</button>

                </fieldset>
            </form> <!-- end form -->


        </div> <!-- end s-content__main -->

    </div> <!-- end row -->

</section> <!-- s-content -->