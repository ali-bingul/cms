<?php $this->layout('layouts/admin'); ?>
<?php

use app\services\SubscriberService;

$this->title = "Subscribers";

if(isset($_GET['start'])){
    $start = $_GET['start'];
}
else{
    $start = 0;
}
$limit = 3;

if($start % $limit !== 0){
    header('Location: /admin/subscribers');
}
?>


<!-- DATA TABLE -->
<h3 class="title-5 m-b-35" style="padding-top: 1rem;">subscribers | <?php echo $subscriberCount?></h3>
<div class="table-responsive table-responsive-data2">
    <table class="table table-data2">
        <thead>
            <tr>
                <th>id</th>
                <th>email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subscribers as $key => $value) : ?>
                <tr class="tr-shadow">
                    <td id="idRow"><?= $value['id'] ?></td>
                    <td>
                        <span class="block-email"><?= $value['email'] ?></span>
                    </td>
                    <td>
                        <div class="table-data-feature">
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
                <li><a class="pgn__prev" href="/admin/subscribers?start= <?php echo ($start - $limit) ?>">Previous</a></li>
            <?php endif; ?>
            <?php if ($subscriberCount > ($start + $limit)) : ?>
                <li><a class="pgn__next" href="/admin/subscribers?start=<?php echo ($start + $limit) ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<script>
    let member = document.getElementsByClassName("tr-shadow");

    function memberClicked(e) {
        if (e.target.id === "delete") {
            console.log("delete clicked");
            let id = $(this).closest("tr").find("td[id='idRow']").html();
            if (confirm(`Do you want to delete subscriber which id : ${id}`)) {
                $.get('subscribers', {
                    'id': id
                });
                window.location.reload();
                // instead reload we can remove the row
            }
        }
    }

    for (let i = 0; i < member.length; i++) {
        member[i].addEventListener("click", memberClicked);
    }
</script>

<?php
if (isset($_GET['id'])) {
    $subscriberService = new SubscriberService();
    $subscriberService->deleteSubscriber(['id' => $_GET['id']]);
}
?>