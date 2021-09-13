<?php
$this->title = "Admin Contents";

use app\controller\ContentController;
use app\core\Application;

$contentController = new ContentController();

$limit = 10;

if (isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = 0;
}
if ($start % $limit !== 0) {
    header('Location: /cms/admin/contents');
}

$limitQuery = " LIMIT " . $start . "," . $limit . ' ';
$orderBy = " ORDER BY id DESC";
$where = " WHERE active = 1";
?>
<!-- <div style="display: flex; justify-content:flex-start; padding: 1rem;">
    <h1 class="display-6">Contents</h1>
</div> -->
<h3 class="title-5 m-b-35" style="padding-top: 1rem; margin-bottom: 0px; padding-left: 1rem;">contents | <?php echo count($contentController->getContents()) ?></h3>
<h3 class="title-5 m-b-35" style="padding-left: 1rem;"><?php echo count($contentController->getContents($where)) ?> Active & <?php echo (count($contentController->getContents())) - (count($contentController->getContents($where))) ?> Passive</h3>
<h1><?php /*print_r($_FILES)*/ ?></h1>
<?php if (Application::$app->session->getFlash('success')) : ?>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Uploaded!</h4>
        <p><?php echo Application::$app->session->getFlash('success') ?></p>
    </div>
<?php endif; ?>
<!-- <div>
    <a href="/cms/admin/contents/new">New Content</a>
</div> -->
<!-- <form action="/cms/admin/contents/new">
    <input type="submit" value="New Content" />
</form> -->
<div style="display: flex; justify-content: flex-start; padding-left: 1rem;">
    <button onclick="location.href='/cms/admin/contents/new'" type="button" class="btn btn-dark">New Content</button>
</div>


<?php ?>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <?php foreach ($contentController->getContents($orderBy, $limitQuery) as $key => $value) : ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="<?php echo PUBLIC_PATH ?>/uploads/<?php echo $value['image'] ?>" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-3"><a href="/cms/<?php echo Application::slugify($value['title'])?>" target="_blank" style="text-decoration: none; color: black;" id="contentId"><?php echo $value['id'] ?></a></h4>
                                <h4 class="card-title mb-3"><a href="/cms/<?php echo Application::slugify($value['title'])?>" target="_blank" style="text-decoration: none; color: black;" id="title">Title : <?php echo $value['title'] ?></a></h4>
                                <label class="switch switch-3d switch-primary mr-3">
                                    <input type="checkbox" id="switch" class="switch-input" <?php if ($value['active'] == true) {
                                                                                                echo "checked";
                                                                                            } ?>>
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                                <button class="btn btn-primary" id="edit" style="border-radius: 2rem;">Edit</button>
                                <button class="btn btn-danger" id="delete" style="border-radius: 2rem;">Delete</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<div id="menu-outer">
    <div class="table">
        <ul id="horizontal-list">
            <?php if ($start > 0) : ?>
                <li><a class="pgn__prev" href="/cms/admin/contents?start= <?php echo ($start - $limit) ?>">Previous</a></li>
            <?php endif; ?>
            <?php if (count($contentController->getContents()) > ($start + $limit)) : ?>
                <li><a class="pgn__next" href="/cms/admin/contents?start=<?php echo ($start + $limit) ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<script>
    let switch3d = document.getElementsByClassName("card-body");

    function switchToggle(e) {
        if (e.target.id === "switch") {
            console.log("switch clicked");
            let id = $(this).closest("div").find("a[id='contentId']").html();
            let isActive = e.target.checked;
            if (isActive) {
                isActive = 1;
            } else {
                isActive = 0;
            }
            console.log(id);
            if (confirm(`Do you want to set active content which id : ${id}`)) {
                // $.get('contents', {
                //     'id': id,
                //     'isActive': isActive
                // });
                window.location.href = `/cms/admin/contents?id=${id}&isActive=${isActive}`;
            }
        }
        if (e.target.id === "delete") {
            let id = $(this).closest("div").find("a[id='contentId']").html();
            if (confirm(`Do you want to delete content which id : ${id}`)) {
                // $.get('contents', {
                //     'title': title,
                //     'deleteClicked': true
                // });
                // window.location.reload();
                window.location.href = `/cms/admin/contents?id=${id}&deleteClicked=${true}`;
            }
        }
        if (e.target.id === "edit") {
            console.log("edit clicked");
            let id = $(this).closest("div").find("a[id='contentId']").html();
            if (confirm(`Do you want to edit content which id : ${id}`)) {
                // $.get('contents', {
                //     'title': title,
                //     'editClicked': true
                // });
                window.location.href = `/cms/admin/contents/edit?title=${id}`;
            }
            console.log(title);

        }
    }
    for (let i = 0; i < switch3d.length; i++) {
        switch3d[i].addEventListener("click", switchToggle);
    }
</script>

<?php

// var_dump($_GET);
// exit;
if (isset($_GET['id']) && isset($_GET['isActive'])) {
    $contentController->updateActive(['id' => $_GET['id']], $_GET['isActive']);
    header('Location: /cms/admin/contents');
} elseif (isset($_GET['id']) && $_GET['deleteClicked']) {
    $contentController->deleteContent(['id' => $_GET['id']]);
    header('Location: /cms/admin/contents');
}
?>