<?php
\Core\View::render('parts/header.php', ['title' => 'post']);
?>
<!-- Main jumbotron for a primary marketing message or call to action -->



<div class="container" style="padding-top: 10rem;">
    <div class="well">
        <div class="media">
            <?php if ($image != ''): ?>
                <img class="media-object" src="<?php echo ASSETS_URI . $image; ?>" style="max-width: 400px;">
            <?php endif; ?>
            <div class="media-body">
                <h4 class="media-heading" style="padding: 10px;"><?php echo $title; ?></h4>
                <p class="text-right">By <strong><a href="/posts/user/<?php echo $user_id; ?>/view"><?php echo $author_name; ?></a></strong></p>
                <p style="padding: 10px;"><?php echo $content; ?></p>
                <ul class="list-inline list-unstyled" style="padding: 10px;">
                    <li><span><i class="glyphicon glyphicon-calendar"></i> <?php echo $create_at;?> </span></li>
                </ul>
            </div>
        </div>
    </div>
    <?php if (\Helpers\SessionHelpers::getUserId() == $user_id): ?>
    <div class="float-right">
        <a class="btn btn-warning" href="/post/<?php echo $id?>/edit" role="button">Изменить</a>
        <a class="btn btn-danger" href="/post/<?php echo $id?>/delete" role="button">Удалить</a>
    </div>
    <?php endif; ?>
</div>



<?php
\Core\View::render('parts/footer.php');
?>
