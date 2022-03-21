<?php $this->layout('layouts/main'); ?>
<?php
$this->title = "Contact";
use app\core\Application;
?>
<!-- s-content
    ================================================== -->
<section class="s-content s-content--narrow">
    <div class="row">
        <div class="s-content__header col-full">
            <h1 class="s-content__header-title">
                Feel Free To Contact Me.
            </h1>
        </div> <!-- end s-content__header -->
        <?php if (Application::$app->session->getFlash('success')) : ?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Thank You!</h4>
                <p><?php echo Application::$app->session->getFlash('success') ?></p>
            </div>
        <?php endif; ?>
        <div class="col-full s-content__main">
            <h3>Say Hello.</h3>
            <form name="cForm" id="cForm" method="post" action="">
                <fieldset>
                    <div class="form-field">
                        <input name="name" type="text" id="subject" class="full-width" placeholder="Your Name" value="">
                    </div>
                    <div class="form-field">
                        <input name="email" type="email" id="email" class="full-width" placeholder="Your Email" value="">
                    </div>
                    <div class="form-field">
                        <input name="website" type="text" id="website" class="full-width" placeholder="Your Website" value="">
                    </div>
                    <div class="message form-field">
                        <textarea name="body" id="body" class="full-width" placeholder="Your Message"></textarea>
                    </div>
                    <button type="submit" class="submit btn btn--primary full-width">Send</button>
                </fieldset>
            </form> <!-- end form -->
        </div> <!-- end s-content__main -->
    </div> <!-- end row -->
</section> <!-- s-content -->