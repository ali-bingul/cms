<?php $this->layout('layouts/main'); ?>
<?php

use app\core\Application;

$this->title = $category->name;

$limit = 14;
if (isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = 0;
}
if ($start % $limit !== 0) {
    header('Location: /categories/' . $category->id);
}
?>

<!-- s-content
    ================================================== -->
<section class="s-content">
    <div class="row narrow">
        <div class="col-full s-content__header" data-aos="fade-up">
            <h1>Category: <?php echo $category->name ?></h1>
        </div>
    </div>
    <div class="row masonry-wrap">
        <div class="masonry">
            <div class="grid-sizer"></div>
            <?php foreach ($contents as $content) : ?>
                <article class="masonry__brick entry format-standard" data-aos="fade-up">
                    <div class="entry__thumb">
                        <a href="/<?php echo html_entity_decode(Application::slugify($content['title']), ENT_HTML5) ?>" class="entry__thumb-link">
                            <img src="<?= PUBLIC_PATH ?>/uploads/<?php echo $content['image'] ?>">
                        </a>
                    </div>
                    <div class="entry__text">
                        <div class="entry__header">
                            <div class="entry__date">
                                <a href="/<?php echo html_entity_decode(Application::slugify($content['title']), ENT_HTML5) ?>"><?php echo $content['updated_at'] ?></a>
                            </div>
                            <h1 class="entry__title"><a href="/<?php echo html_entity_decode(Application::slugify($content['title']), ENT_HTML5) ?>"><?php echo $content['title'] ?></a></h1>
                        </div>
                        <div class="entry__meta">
                            <span class="entry__meta-links">
                                <a href="/categories/<?php echo strtolower(Application::slugify($content['category'])) ?>"><?php echo $content['category'] ?></a>
                            </span>
                        </div>
                    </div>
                </article> <!-- end article -->
            <?php endforeach; ?>
        </div> <!-- end masonry -->
    </div> <!-- end masonry-wrap -->
    <div class="row">
        <div class="col-full">
            <nav class="pgn">
                <ul>
                    <?php if ($start > 0) : ?>
                        <li><a class="pgn__prev" href="/categories/<?php echo $category->id ?>?start= <?php echo ($start - $limit) ?>">Prev</a></li>
                    <?php endif; ?>
                    <?php if ($contentCount > ($start + $limit)) : ?>
                        <li><a class="pgn__next" href="/categories/<?php echo $category->id ?>?start=<?php echo ($start + $limit) ?>">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</section> <!-- s-content -->