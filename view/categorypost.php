<?php

use app\controller\CategoryController;
use app\core\Application;
use app\controller\ContentController;


$contentController = new ContentController();

$categoryController = new CategoryController();
$categorySlug = substr($_SERVER['REQUEST_URI'], 16);
if(isset($_GET['start'])){
    $position = strpos($categorySlug, '?');
    $categorySlug = substr($categorySlug, 0, $position);

}
$theCategory = [];
foreach ($categoryController->getCategories() as $category) {
    if ($category['slug'] === $categorySlug) {
        $theCategory = $category;
    }
}
$this->title = $theCategory['name'];

$limit = 15;
if (isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = 0;
}
if ($start % $limit !== 0) {
    header('Location: /cms/categories/' . $theCategory['slug']);
}

$whereQuery = " WHERE active = 1 AND category = '" . $theCategory['name'] . "'";
$orderBy = " ORDER BY id DESC";
$limitQuery = " LIMIT " . $start . "," . $limit . ' ';
?>

<!-- s-content
    ================================================== -->
<section class="s-content">

    <div class="row narrow">
        <div class="col-full s-content__header" data-aos="fade-up">
            <h1>Category: <?php echo $theCategory['name'] ?></h1>

            <!-- <p class="lead">Dolor similique vitae. Exercitationem quidem occaecati iusto. Id non vitae enim quas error dolor maiores ut. Exercitationem earum ut repudiandae optio veritatis animi nulla qui dolores.</p> -->
        </div>
    </div>

    <div class="row masonry-wrap">
        <div class="masonry">
            <div class="grid-sizer"></div>
            <?php foreach ($contentController->getContents($whereQuery, $orderBy, $limitQuery) as $content) : ?>
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
            <?php endforeach; ?>
        </div> <!-- end masonry -->
    </div> <!-- end masonry-wrap -->

    <!-- <div class="row">
        <div class="col-full">
            <nav class="pgn">
                <ul>
                    <li><a class="pgn__prev" href="#0">Prev</a></li>
                    <li><a class="pgn__num" href="#0">1</a></li>
                    <li><span class="pgn__num current">2</span></li>
                    <li><a class="pgn__num" href="#0">3</a></li>
                    <li><a class="pgn__num" href="#0">4</a></li>
                    <li><a class="pgn__num" href="#0">5</a></li>
                    <li><span class="pgn__num dots">…</span></li>
                    <li><a class="pgn__num" href="#0">8</a></li>
                    <li><a class="pgn__next" href="#0">Next</a></li>
                </ul>
            </nav>
        </div>
    </div> -->
    <div class="row">
        <div class="col-full">
            <nav class="pgn">
                <ul>
                    <?php if ($start > 0) : ?>
                        <li><a class="pgn__prev" href="/cms/categories/<?php echo $theCategory['slug'] ?>?start= <?php echo ($start - $limit) ?>">Prev</a></li>
                    <?php endif; ?>
                    <?php if (count($contentController->getContents($whereQuery)) > ($start + $limit)) : ?>
                        <li><a class="pgn__next" href="/cms/categories/<?php echo $theCategory['slug'] ?>?start=<?php echo ($start + $limit) ?>">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>

</section> <!-- s-content -->