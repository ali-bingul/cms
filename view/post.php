<?php

use app\controller\CommentController;
use app\controller\ContentController;
use app\controller\FavoritesController;
use app\controller\MemberController;
use app\core\Application;

$contentController = new ContentController();
$commentController = new CommentController();
$memberController = new MemberController();
$favoritesController = new FavoritesController();

$title = substr($_SERVER['REQUEST_URI'], 5);
if (!empty($_GET)) {
    $position = strpos($title, '?');
    $title = substr($title, 0, $position);
}
// if (isset($_GET['isActive'])) {
//     $position = strpos($title, '?');
//     $title = substr($title, 0, $position);
// }
$thePost = [];

foreach ($contentController->getContents() as $content) {
    if (html_entity_decode(Application::slugify($content['title'])) === $title) {
        $thePost = $content;
    }
}
if (isset($_GET['isActive'])) {
    if ($_GET['isActive'] === "true") {
        // var_dump("addFavorite");
        // exit;
        $favoritesController->addFavorite($_SESSION['member'], $thePost['id']);
        header('Location: /cms/' . Application::slugify($thePost['title']));
    } elseif($_GET['isActive'] === "false") {
        // var_dump("deleteFavorite");
        // exit;
        header('Location: /cms/' . Application::slugify($thePost['title']));
        $favoritesController->deleteFavorite("WHERE member_id = " .$_SESSION['member'] .  " AND post_id = " . $thePost['id']);
    }
}

$whereQuery = " WHERE post_title = " . "'" . Application::slugify($thePost['title']) . "'";
$orderBy = " ORDER BY created_at DESC";


$this->title = $thePost['title']; // this should be post title

?>
<link rel="stylesheet" href="<?php echo PUBLIC_PATH ?>/css/mainswitch.css">

<!-- s-content
    ================================================== -->
<section class="s-content s-content--narrow s-content--no-padding-bottom">

    <article class="row format-gallery">

        <div class="s-content__header col-full">
            <h1 class="s-content__header-title">
                <?php echo $thePost['title'] ?>
            </h1>
            <ul class="s-content__header-meta">
                <li class="date"><?php echo $thePost['updated_at'] ?></li>
                <li class="cat">
                    In
                    <a href="/cms/categories/<?php echo strtolower(html_entity_decode(Application::slugify($thePost['category']))) ?>"><?php echo $thePost['category'] ?></a>
                </li>
            </ul>
        </div> <!-- end s-content__header -->

        <div class="s-content__media col-full">

            <img src="<?php echo PUBLIC_PATH ?>/uploads/<?php echo $thePost['image'] ?>" alt="">
        </div> <!-- end s-content__media -->

        <div class="col-full s-content__main">

            <?php echo html_entity_decode($thePost['content']) ?>
            <!-- <button type="button" class="btn" style="background: red; color: white; border-radius: 1rem; width: 100%;">
                <i class="fa fa-heart" style="color: white;"></i>&nbsp; Add To Favorites</button> -->

            <?php if (!Application::isGuest()) : ?>
                <i class="fa fa-heart" style="color: red;"></i>
                <label class="switch switch-default switch-danger mr-2">
                    <input id="switch" type="checkbox" class="switch-input" <?php if ($favoritesController->isFavorite(" WHERE member_id = " . $_SESSION['member'] . " AND post_id = " . $thePost['id'])) {
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
                <!-- <img src="images/avatars/user-03.jpg" alt=""> -->

                <div class="s-content__author-about">
                    <h4 class="s-content__author-name">
                        <a href="/cms/about">Author : Ali Bingül</a>
                    </h4>

                    <ul class="s-content__author-social">
                        <li><a href="https://www.linkedin.com/in/alibingul/" target="_blank">Linkedin</a></li>
                    </ul>
                </div>
            </div>

            <!-- <div class="s-content__pagenav">
                <div class="s-content__nav">
                    <div class="s-content__prev">
                        <a href="#0" rel="prev">
                            <span>Previous Post</span>
                            Tips on Minimalist Design
                        </a>
                    </div>
                    <div class="s-content__next">
                        <a href="#0" rel="next">
                            <span>Next Post</span>
                            Less Is More
                        </a>
                    </div>
                </div>
            </div>  -->
            <!-- end s-content__pagenav -->

        </div> <!-- end s-content__main -->

    </article>


    <!-- COMMENTS -->
    <!-- comments
        ================================================== -->
    <div class="comments-wrap">

        <div id="comments" class="row">
            <div class="col-full">
                <h3 class="h2"><?php echo count($commentController->getComments($whereQuery, $orderBy)) ?> Comments</h3>


                <?php foreach ($commentController->getComments($whereQuery, $orderBy) as $comment) : ?>
                    <!-- COMMENTLIST -->
                    <ol class="commentlist">
                        <li class="thread-alt depth-1 comment" style="padding: 0px;">
                            <div class="comment__content">
                                <div class="comment__info">
                                    <cite><?php echo $memberController->getMember(['id' => $comment['member_id']])->username ?></cite>
                                    <div class="comment__meta">
                                        <time class="comment__time"><?php echo $comment['created_at'] ?></time>
                                    </div>
                                </div>
                                <div class="comment__text">
                                    <p style="margin: 0px;"><?php echo $comment['content'] ?></p>
                                </div>
                            </div>
                            <?php if ($commentController->hasReply(['comment_id' => $comment['id']])) : ?>
                                <?php foreach ($commentController->getReplies(" WHERE comment_id = " . $comment['id']) as $reply) : ?>
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

<!-- <script>
    let commentSubmitButton = document.getElementById("contactForm");

    function commentSubmitClicked(e) {
        if (e.target.id === "comment-submit") {
            console.log("submit clicked");
            let content = $(this).closest("div").find("textarea[id='cMessage']").html();
            $.get('post', {
                'content': content
            });
            // window.location.reload();
        }
    }


    commentSubmitButton.addEventListener("click", commentSubmitClicked);
</script> -->

<?php
// if (isset($_GET['content'])) {
//     $commentController->addComment($_GET['content']);
// }
?>

<script>
    let switchFavorite = document.getElementById("switch");

    function switchToggle(e) {
        console.log("switch clicked");
        let isActive = e.target.checked;
        // $.get(
        //     {
        //         'isActive': isActive
        //     });
        window.location.href = location.pathname.substr(5).concat(`?isActive=${isActive}`);
        console.log(isActive);
    }

    switchFavorite.addEventListener("click", switchToggle);

    // function switchToggle(e) {
    //     if (e.target.id === "switch") {
    //         console.log("switch clicked");
    //         let title = $(this).closest("div").find("a[id='title']").html();
    //         let isActive = e.target.checked;
    //         if (isActive) {
    //             isActive = 1;
    //         } else {
    //             isActive = 0;
    //         }
    //         console.log(isActive);
    //         if (confirm(`Do you want to delete content which title : ${title}`)) {
    //             $.get('contents', {
    //                 'title': title,
    //                 'isActive': isActive
    //             });
    //         }
    //     }
    //     if (e.target.id === "delete") {
    //         console.log("delete clicked");
    //         let title = $(this).closest("div").find("a[id='title']").html();
    //         if (confirm(`Do you want to delete content which title : ${title}`)) {
    //             $.get('contents', {
    //                 'title': title,
    //                 'deleteClicked': true
    //             });
    //             window.location.reload();
    //         }
    //     }
    // }
    // for (let i = 0; i < switch3d.length; i++) {
    //     switch3d[i].addEventListener("click", switchToggle);
    // }
</script>