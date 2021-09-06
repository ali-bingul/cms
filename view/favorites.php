<?php

use app\controller\ContentController;
use app\controller\FavoritesController;
use app\core\Application;

$this->title = "Favorites";
$contentController = new ContentController();
$favoritesController = new FavoritesController();
$limit = 15;
if (isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = 0;
}
if ($start % $limit !== 0) {
    header('Location: /cms/favorites');
}

$whereQuery = " WHERE active = 1";
$orderBy = " ORDER BY id DESC";
$limitQuery = " LIMIT " . $start . "," . $limit . ' ';

?>

<!-- s-content
    ================================================== -->
<section class="s-content">
    <div class="row narrow">
        <div class="col-full s-content__header" data-aos="fade-up">
            <h1>Favorites : <?php echo count($favoritesController->getFavorites(" WHERE member_id = " . $_SESSION['member']))?></h1>

            <!-- <p class="lead">Dolor similique vitae. Exercitationem quidem occaecati iusto. Id non vitae enim quas error dolor maiores ut. Exercitationem earum ut repudiandae optio veritatis animi nulla qui dolores.</p> -->
        </div>
    </div>
    <div class="row masonry-wrap">
        <div class="masonry">
            <div class="grid-sizer"></div>
            <?php foreach ($favoritesController->getFavorites() as $favorite) : ?>
                <?php foreach ($contentController->getContents($whereQuery . " AND id = " . $favorite['post_id'], $orderBy, $limitQuery) as $content) : ?>
                    <?php if ($favorite['member_id'] === $_SESSION['member']) : ?>
                        <article class="masonry__brick entry format-standard" data-aos="fade-up">

                            <div class="entry__thumb">
                                <a href="/cms/<?php echo html_entity_decode(Application::slugify($content['title']), ENT_HTML5) ?>" class="entry__thumb-link">
                                    <img src="<?= PUBLIC_PATH ?>/uploads/<?php echo $content['image'] ?>">
                                </a>
                            </div>

                            <div class="entry__text">
                                <div class="entry__header">

                                    <div class="entry__date">
                                        <a href="/cms/<?php echo html_entity_decode(Application::slugify($content['title']), ENT_HTML5) ?>"><?php echo $content['updated_at'] ?></a>
                                    </div>
                                    <h1 class="entry__title"><a href="/cms/<?php echo html_entity_decode(Application::slugify($content['title']), ENT_HTML5) ?>"><?php echo $content['title'] ?></a></h1>

                                </div>
                                <!-- <div class="entry__excerpt"> -->
                                <?php /*echo html_entity_decode($content['content'], ENT_HTML5)*/ ?>

                                <!-- </div> -->
                                <div class="entry__meta">
                                    <span class="entry__meta-links">
                                        <a href="/cms/categories/<?php echo strtolower(Application::slugify($content['category'])) ?>"><?php echo $content['category'] ?></a>
                                    </span>
                                </div>
                            </div>

                        </article> <!-- end article -->
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div> <!-- end masonry -->
    </div> <!-- end masonry-wrap -->

    <div class="row">
        <div class="col-full">
            <nav class="pgn">
                <ul>
                    <?php if ($start > 0) : ?>
                        <li><a class="pgn__prev" href="/cms/?start= <?php echo ($start - $limit) ?>">Prev</a></li>
                    <?php endif; ?>
                    <?php if (count($contentController->getContents($whereQuery)) > ($start + $limit)) : ?>
                        <li><a class="pgn__next" href="/cms/?start=<?php echo ($start + $limit) ?>">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>

</section> <!-- s-content -->


<!-- <script>
    // let contentWrappers = document.getElementsByClassName("entry__excerpt");

    let prev = document.getElementById("prev");
    let next = document.getElementById("next");

    prev.addEventListener('click', prevClicked);
    next.addEventListener('click', nextClicked);

    function prevClicked(e) {
        console.log("prev clicked");
        $.get('/cms/', {
            'start': 10
        });
    }

    function nextClicked(e) {
        console.log("next clicked");
    }
</script> -->

<?php
// if (isset($_GET['start'])) {
//     echo '<h1>' . $_GET['start'] . '</h1>';
// }
?>