<?php $this->layout('layouts/main'); ?>
<?php

$limit = 15;
if (isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = 0;
}
if ($start % $limit !== 0) {
    header('Location: /');
}

$whereQuery = " WHERE active = 1";
$orderBy = " ORDER BY id DESC";
$limitQuery = " LIMIT " . $start . "," . $limit . ' ';

?>

<!-- s-content
    ================================================== -->
<section class="s-content">
    <div class="row masonry-wrap">
        <div class="masonry">
            <div class="grid-sizer"></div>
            <?php foreach ($contents as $content) : ?>
                <?php /*if ($content['active']) :*/ ?>
                <article class="masonry__brick entry format-standard" data-aos="fade-up">
                    <div class="entry__thumb">
                        <a href="/post/<?php echo $content['id'] ?>" class="entry__thumb-link">
                            <img src="/uploads/<?php echo $content['image'] ?>">
                        </a>
                    </div>
                    <div class="entry__text">
                        <div class="entry__header">
                            <div class="entry__date">
                                <a href="/post/<?php echo $content['id'] ?>"><?php echo $content['updated_at'] ?></a>
                            </div>
                            <h1 class="entry__title"><a href="/post/<?php echo $content['id'] ?>"><?php echo $content['title'] ?></a></h1>
                        </div>
                        <div class="entry__meta">
                            <span class="entry__meta-links">
                                <a href="/categories/<?php echo $content['category_id'] ?>"><?php echo $content['category'] ?></a>
                            </span>
                        </div>
                    </div>
                </article> <!-- end article -->
                <?php /*endif;*/ ?>
            <?php endforeach; ?>
        </div> <!-- end masonry -->
    </div> <!-- end masonry-wrap -->
    <div class="row">
        <div class="col-full">
            <nav class="pgn">
                <ul>
                    <?php if ($start > 0) : ?>
                        <li><a class="pgn__prev" href="/?start= <?php echo ($start - $limit) ?>">Prev</a></li>
                    <?php endif; ?>
                    <?php if ($activeContentCount > ($start + $limit)) : ?>
                        <li><a class="pgn__next" href="/?start=<?php echo ($start + $limit) ?>">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</section> <!-- s-content -->