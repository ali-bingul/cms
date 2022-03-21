<?php $this->layout('layouts/main'); ?>
<?php

use app\core\Application;
use app\services\CommentService;
use app\services\FavoritesService;
use app\services\MemberService;

$favoritesService = new FavoritesService();
$memberService = new MemberService();
$commentService = new CommentService();

if (isset($_GET['isActive'])) {
    if ($_GET['isActive'] === "true") {
        $favoritesService->addFavorite($_SESSION['member'], $content->id);
        header('Location: /post/' . $content->id);
    } elseif($_GET['isActive'] === "false") {
        header('Location: /post/' . $content->id);
        $favoritesService->deleteFavorite("WHERE member_id = " .$_SESSION['member'] .  " AND post_id = " . $content->id);
    }
}

?>
<link rel="stylesheet" href="<?php echo PUBLIC_PATH ?>/css/mainswitch.css">
<!-- s-content
    ================================================== -->
<section class="s-content s-content--narrow s-content--no-padding-bottom">
    <article class="row format-gallery">
        <div class="s-content__header col-full">
            <h1 class="s-content__header-title">
                <?php echo $content->title ?>
            </h1>
            <ul class="s-content__header-meta">
                <li class="date"><?php echo $content->updated_at ?></li>
                <li class="cat">
                    In
                    <a href="/categories/<?php echo $content->category_id ?>"><?php echo $content->category ?></a>
                </li>
            </ul>
        </div> <!-- end s-content__header -->
        <div class="s-content__media col-full">
            <img src="/uploads/<?php echo $content->image ?>" alt="">
        </div> <!-- end s-content__media -->
        <div class="col-full s-content__main">
            <?php echo html_entity_decode($content->content) ?>
            <?php if (!Application::isGuest()) : ?>
                <i class="fa fa-heart" style="color: red;"></i>
                <label class="switch switch-default switch-danger mr-2">
                    <input id="switch" type="checkbox" class="switch-input" <?php if ($favoritesService->isFavorite(" WHERE member_id = " . $_SESSION['member'] . " AND post_id = " . $content->id)) {
                                                                                echo "checked";
                                                                            } else {
                                                                                echo "";
                                                                            } ?>>
                    <span class="switch-label"></span>
                    <span class="switch-handle"></span>
                </label>
            <?php endif; ?>
            <hr>
            <div class="s-content__author" style="padding: 0px; margin: 0px;">
                <div class="s-content__author-about">
                    <h4 class="s-content__author-name">
                        <a href="/about">Author : Ali Bingül</a>
                    </h4>
                    <ul class="s-content__author-social">
                        <li><a href="https://www.linkedin.com/in/alibingul/" target="_blank">Linkedin</a></li>
                    </ul>
                </div>
            </div>
        </div> <!-- end s-content__main -->
    </article>
    <!-- COMMENTS -->
    <!-- comments
        ================================================== -->
    <div class="comments-wrap">
        <div id="comments" class="row">
            <div class="col-full">
                <h3 class="h2"><?php echo $commentsCount ?> Comments</h3>
                <?php foreach ($comments as $comment) : ?>
                    <!-- COMMENTLIST -->
                    <ol class="commentlist">
                        <li class="thread-alt depth-1 comment" style="padding: 0px;">
                            <div class="comment__content">
                                <div class="comment__info">
                                    <cite><?php echo $memberService->getMember(['id' => $comment['member_id']])->username ?></cite>
                                    <div class="comment__meta">
                                        <time class="comment__time"><?php echo $comment['created_at'] ?></time>
                                    </div>
                                </div>
                                <div class="comment__text">
                                    <p style="margin: 0px;"><?php echo $comment['content'] ?></p>
                                </div>
                            </div>
                            <?php if ($commentService->hasReply(['comment_id' => $comment['id']])) : ?>
                                <?php foreach ($commentService->getReplies(" WHERE comment_id = " . $comment['id']) as $reply) : ?>
                                    <ul class="children">
                                        <li class="depth-2 comment">
                                            <div class="comment__content">
                                                <div class="comment__info">
                                                    <cite style="color: #365CAD;">Ali Bingül (Admin)</cite>
                                                    <div class="comment__meta">
                                                        <time class="comment__time"><?php echo $reply['created_at'] ?></time>
                                                    </div>
                                                </div>
                                                <div class="comment__text">
                                                    <p><?php echo $reply['content'] ?></p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </li> <!-- end comment level 1 -->
                    </ol> <!-- end commentlist -->
                    <!-- END COMMENT LIST -->
                    <hr>
                <?php endforeach; ?>
                <?php if (!Application::isGuest()) : ?>
                    <!-- ADD COMMENT -->
                    <div class="respond">
                        <h3 class="h2">Add Comment</h3>
                        <form name="contactForm" id="contactForm" method="post" action="">
                            <fieldset>
                                <div class="message form-field">
                                    <textarea name="content" id="cMessage" class="full-width" placeholder="Your Message"></textarea>
                                </div>
                                <button type="submit" id="comment-submit" class="submit btn--primary btn--large full-width">Submit</button>
                            </fieldset>
                        </form> <!-- end form -->
                    </div> <!-- end respond -->
                    <!-- END ADD COMMENT -->
                <?php else : ?>
                    <!-- ADD COMMENT -->
                    <div class="respond">
                        <h3 class="h2">To Add Comment Login Or Register</h3>
                        <form name="contactForm" id="contactForm" method="post" action="">
                            <fieldset>
                                <div class="message form-field">
                                    <textarea disabled name="content" id="cMessage" class="full-width" placeholder="Only Members Can Write Comment"></textarea>
                                </div>
                                <button disabled type="submit" id="comment-submit" class="submit btn--primary btn--large full-width">Submit</button>
                            </fieldset>
                        </form> <!-- end form -->
                    </div> <!-- end respond -->
                    <!-- END ADD COMMENT -->
                <?php endif; ?>
            </div> <!-- end col-full -->
        </div> <!-- end row comments -->
    </div> <!-- end comments-wrap -->
</section> <!-- s-content -->
<script>
    let switchFavorite = document.getElementById("switch");
    function switchToggle(e) {
        console.log("switch clicked");
        let isActive = e.target.checked;
        window.location.href = location.pathname + `/?isActive=${isActive}`;
        console.log(isActive);
    }
    switchFavorite.addEventListener("click", switchToggle);
</script>