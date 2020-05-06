<?php
\Core\View::render('parts/header.php', ['title' => 'Home Page']);
?>
<!-- Main jumbotron for a primary marketing message or call to action -->


<div class="container" style="padding: 6rem;">
    <!-- Example row of columns -->
    <div class="row">
        <?php if ($data):
            foreach ($data as $post){ ?>
            <div class="col-md-4">
                <h2><?php echo $post['title']; ?></h2>
                <p><?php echo substr($post['content'], 0, 250); ?></p>
                <p><a class="btn btn-secondary" href="/post/<?php echo $post['id']; ?>/view" role="button">Читать &raquo;</a></p>
            </div>
            <?php }
        endif; ?>
    </div>

</div> <!-- /container -->

<?php
\Core\View::render('parts/footer.php');
?>
