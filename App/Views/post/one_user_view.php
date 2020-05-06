<?php
\Core\View::render('parts/header.php', ['title' => 'post']);
?>
<!-- Main jumbotron for a primary marketing message or call to action -->



<div class="container" style="padding-top: 10rem;">
    <?php foreach ($posts as $post) {?>
        <div class="well">
            <div class="media">
                <?php if ($post['image'] != ''): ?>
                    <img class="media-object" src="<?php echo ASSETS_URI . $post['image']; ?>" style="max-width: 400px;">
                <?php endif; ?>
                <div class="media-body">
                    <h4 class="media-heading" style="padding: 10px;"><?php echo $post['title']; ?></h4>
                    <p class="text-right">By <strong><a href="/posts/user/<?php echo $user_id; ?>/view"><?php echo $user_name; ?></a></strong></p>
                    <p style="padding: 10px;"><?php echo $post['content']; ?></p>
                    <ul class="list-inline list-unstyled" style="padding: 10px;">
                        <li><span><i class="glyphicon glyphicon-calendar"></i> <?php echo $post['create_at'];?> </span></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php if (\Helpers\SessionHelpers::getUserId() == $post['user_id']): ?>
        <div class="float-right">
            <a class="btn btn-warning" href="/post/<?php echo $post['id']?>/edit" role="button">Изменить</a>
            <a class="btn btn-danger" href="/post/<?php echo $post['id']?>/delete" role="button">Удалить</a>
        </div>
        <?php endif; ?>
        <hr>
    <?php }; ?>
</div>



<?php
\Core\View::render('parts/footer.php');
?>
