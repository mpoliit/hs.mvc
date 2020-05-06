<?php
\Core\View::render('parts/header.php', ['title' => 'Home Page']);
?>
<!-- Main jumbotron for a primary marketing message or call to action -->


<div class="container" style="padding: 6rem;">
    <div class="row">
        <div class="col-1">
        </div>
        <div class="col-10">
            <form method="post" action="/post/store/" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Название</label>
                    <input type="text"
                           class="form-control"
                           id="title"
                           name="title"
                           value="<?php echo !empty($data['title']) ? $data['title'] : ''; ?>"
                    >
                    <?php if(!empty($title_error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $title_error; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="content">Содержание</label>
                    <textarea type="text"
                           class="form-control"
                           id="content"
                           name="content"><?php echo !empty($data['content']) ? $data['content'] : ''; ?></textarea>
                    <?php if(!empty($content_error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $content_error; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="image">Картинка</label>
                    <input type="file"
                           class="form-control"
                           id="image"
                           name="image"
                           value="<?php echo !empty($data['image']) ? $data['image'] : ''; ?>"
                    >
                    <?php if(!empty($image_error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $image_error; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary">Создать</button>
            </form>
        </div>
        <div class="col-1">
        </div>
    </div>
</div>

<?php
\Core\View::render('parts/footer.php');
?>
