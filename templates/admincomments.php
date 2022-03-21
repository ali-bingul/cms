<?php $this->layout('layouts/admin'); ?>
<?php

use app\services\CommentService;
use app\controller\MemberController;

$memberController = new MemberController();
$commentService = new CommentService();
$this->title = "Comments";

if (isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = 0;
}
$limit = 10;
if ($start % $limit !== 0) {
    header('Location: /admin/members');
}

$limitQuery = " LIMIT " . $start . "," . $limit . ' ';
$orderBy = " ORDER BY id DESC";
?>

<!-- DATA TABLE -->
<h3 class="title-5 m-b-35" style="padding-top: 1rem; margin-bottom: 0px;">comments | <?php echo count($commentService->getComments()) ?></h3>
<h3 class="title-5 m-b-35" style="padding-top: 1rem;">replies | <?php echo count($commentService->getReplies('')) ?></h3>
<div class="table-responsive table-responsive-data2">
    <table class="table table-data2">
        <thead>
            <tr>
                <th>id</th>
                <th>member_id</th>
                <th>content</th>
                <th>post_id</th>
                <th>created_at</th>
                <th>replies from admin</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comments as $key => $value) : ?>
                <tr class="tr-shadow">
                    <td id="idRow"><?= $value['id'] ?></td>
                    <td><?= $value['member_id'] ?></td>
                    <td><textarea disabled cols="30"><?= $value['content'] ?></textarea></td>
                    <td><a href="/post/<?php echo $value['post_id'] ?>" target="blank"><?= $value['post_id'] ?></a></td>
                    <td>
                        <span class="block-email"><?= $value['created_at'] ?></span>
                    </td>
                    <td id="reply">
                        <?php if ($commentService->hasReply(['comment_id' => $value['id']])) : ?>
                            <?php foreach ($commentService->getReplies(" WHERE comment_id = " . $value['id']) as $reply) : ?>
                                <textarea disabled name="cid" cols="30"?><?php echo $reply['content'] ?></textarea>
                                <button id="delete_reply" name="<?php echo $reply['id']?>">delete</button>
                                
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="table-data-feature">
                            <div class="dropdown">
                                <button class="item btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" title="Reply" id="reply" type="button" aria-expanded="false">
                                    <i class="zmdi zmdi-mail-reply" id="reply"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="reply" style="background: #393939; margin: 1rem; padding: 1rem; color: white;">
                                    <form action="" method="post">
                                        <label for="">Comment Id</label>
                                        <input type="text" id="comment_id" class="comment_id" name="comment_id" style="color: black;">
                                        <label for="#content">Your Reply</label>
                                        <textarea name="content" id="content" cols="30" rows="5"></textarea>
                                        <button class="btn btn-secondary" type="submit">Reply</button>
                                    </form>
                                </ul>
                            </div>
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" id="delete" type="button">
                                <i class="zmdi zmdi-delete" id="delete"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr class="spacer"></tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- END DATA TABLE -->
<div id="menu-outer">
    <div class="table">
        <ul id="horizontal-list">
            <?php if ($start > 0) : ?>
                <li><a class="pgn__prev" href="/admin/comments?start= <?php echo ($start - $limit) ?>">Previous</a></li>
            <?php endif; ?>
            <?php if ($memberCount > ($start + $limit)) : ?>
                <li><a class="pgn__next" href="/admin/comments?start=<?php echo ($start + $limit) ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<script>
    let comment = document.getElementsByClassName("tr-shadow");
    function commentClicked(e) {
        if (e.target.id === "delete") {
            console.log("delete clicked");
            let id = $(this).closest("tr").find("td[id='idRow']").html();
            if (confirm(`Do you want to delete comment which id : ${id}`)) {
                $.get('comments', {
                    'id': id
                });
                window.location.reload();
                // instead reload we can remove the row
            }
            console.log(id);
        }
        if (e.target.id === "reply") {
            let id = $(this).closest("tr").find("td[id='idRow']").html();
            document.getElementsByName("comment_id").forEach(function(e) {
                e.value = id;
            });
        }
        if(e.target.id === "delete_reply"){
            console.log("delete reply clicked");
            let replyId = e.target.name;
            if(confirm(`Do you want to delete reply which id: ${replyId}`)){
                $.get('comments', {
                    'replyId': replyId
                });
            }
            window.location.reload();
            console.log(replyId);
        }
    }

    for (let i = 0; i < comment.length; i++) {
        comment[i].addEventListener("click", commentClicked);
    }
</script>

<?php
if (isset($_GET['id'])) {
    $commentService->deleteComment(['id' => $_GET['id']]);
}
if (isset($_GET['replyId'])) {
    $commentService->deleteReply(['id' => $_GET['replyId']]);
}
?>