<?php
use app\core\Application;
use app\controller\MemberController;

$memberController = new MemberController();
$this->title = "Members";

if (isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = 0;
}
$limit = 17;
if ($start % $limit !== 0) {
    header('Location: /cms/admin/members');
}

$limitQuery = " LIMIT " . $start . "," . $limit . ' ';
$orderBy = " ORDER BY id DESC";
?>


<!-- DATA TABLE -->
<h3 class="title-5 m-b-35" style="padding-top: 1rem;">members | <?php echo count($memberController->getMembers()) ?></h3>
<!-- <div class="table-data__tool">
    <div class="table-data__tool-right">
        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
            <i class="zmdi zmdi-plus"></i><a href="/cms/admin/members/add-member" style="color: white; text-decoration: none;">add member</a></button>
    </div>
</div> -->
<?php if (Application::$app->session->getFlash('success')) : ?>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Sended!</h4>
        <p><?php echo Application::$app->session->getFlash('success') ?></p>
    </div>
<?php endif; ?>
<div class="table-responsive table-responsive-data2">
    <table class="table table-data2">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($memberController->getMembers($orderBy, $limitQuery) as $key => $value) : ?>
                <tr class="tr-shadow">
                    <td id="idRow"><?= $value['id'] ?></td>
                    <td><?= $value['username'] ?></td>
                    <td>
                        <span class="block-email"><?= $value['email'] ?></span>
                    </td>
                    <td>
                        <div class="table-data-feature">
                            <!-- <button class="item" data-toggle="tooltip" data-placement="top" title="Send" id="send" type="button">
                                <i class="zmdi zmdi-mail-send" id="send"></i>
                            </button> -->
                            <div class="dropdown">
                                <button class="item btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" title="Send Email" id="send" type="button" aria-expanded="false">
                                    <i class="zmdi zmdi-mail-send" id="send"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="reply" style="background: #393939; margin: 1rem; padding: 1rem; color: white;">
                                    <form action="" method="post">
                                        <label for="">Member Id</label>
                                        <input type="text" id="comment_id" class="id" name="id" style="color: black;">
                                        <label for="#content">Subject</label>
                                        <textarea name="subject" id="content" cols="30" rows="1"></textarea>
                                        <label for="#content">Body</label>
                                        <textarea name="body" id="content" cols="30" rows="5"></textarea>
                                        <button class="btn btn-secondary" type="submit">Send Email</button>
                                    </form>
                                    <!-- <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li> -->
                                    <!-- <li><a class="dropdown-item" href="#"></a></li>  -->
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
                <li><a class="pgn__prev" href="/cms/admin/members?start= <?php echo ($start - $limit) ?>">Previous</a></li>
            <?php endif; ?>
            <?php if (count($memberController->getMembers()) > ($start + $limit)) : ?>
                <li><a class="pgn__next" href="/cms/admin/members?start=<?php echo ($start + $limit) ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<script>
    let member = document.getElementsByClassName("tr-shadow");

    function memberClicked(e) {
        if (e.target.id === "delete") {
            // console.log("delete clicked");
            let id = $(this).closest("tr").find("td[id='idRow']").html();
            if (confirm(`Do you want to delete member which id : ${id}`)) {
                $.get('members', {
                    'id': id
                });
                window.location.reload();
                // instead reload we can remove the row
            }
        }
        if (e.target.id === "send") {
            console.log("send clicked");
            let id = $(this).closest("tr").find("td[id='idRow']").html();
            document.getElementsByName("id").forEach(function(e){
                e.value = id;
            });
            console.log(id);

        }
    }

    for (let i = 0; i < member.length; i++) {
        member[i].addEventListener("click", memberClicked);
    }
</script>

<?php
if (isset($_GET['id'])) {
    $memberController->deleteMember(['id' => $_GET['id']]);
}
?>