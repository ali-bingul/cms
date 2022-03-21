<?php $this->layout('layouts/admin'); ?>
<?php
$this->title = "Admin Account";
use app\core\Application;
?>
<div class="page-wrapper">
    <div class="page-content--bge5" style="background: #FCA311;">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="/images/icon/logo.png" alt="CoolAdmin">
                        </a>
                    </div>
                    <div class="login-form">
                        <!-- ALERT MESSAGE FOR REGISTRATION -->
                        <?php if (Application::$app->session->getFlash('success')) : ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Updated!</h4>
                                <p><?php echo Application::$app->session->getFlash('success') ?></p>
                            </div>
                        <?php endif; ?>
                        <!-- ALERT MESSAGE FOR REGISTRATION -->
                        <form method="post" action="">
                            <label for="username">Username</label>
                            <input id="username" name="username" type="text" class="au-input au-input--full form-control" value="<?php echo $admin->username?>">
                            <label for="oldpassword">Old Password</label>
                            <input id="oldpassword" name="oldpassword" type="password" class="au-input au-input--full form-control">
                            <label for="password">New Password</label>
                            <input id="password" name="password" type="password" class="au-input au-input--full form-control">
                            <label for="confirmPassword">Confirm Password</label>
                            <input id="confirmPassword" name="confirmPassword" type="password" class="au-input au-input--full form-control">
                            <button class="au-btn au-btn--block au-btn--green m-b-20" style="margin-top: 1rem;" type="submit">Update Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>