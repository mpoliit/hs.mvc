<?php
\Core\View::render('parts/header.php', ['title' => 'Edit User']);
?>
<!-- Main jumbotron for a primary marketing message or call to action -->

<div class="container" style="padding: 6rem;">
    <div class="row">
        <div class="col-sm">
        </div>
        <div class="col-sm">
            <form method="post" action="/user/edit/">
                <div class="form-group">
                    <label for="first_name">Имя</label>
                    <input type="text"
                           class="form-control"
                           id="first_name"
                           name="first_name"
                           value="<?php echo $data['first_name']; ?>"
                    >
                    <?php if(!empty($first_name_error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $first_name_error; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="last_name">Фамилия</label>
                    <input type="text"
                           class="form-control"
                           id="last_name"
                           name="last_name"
                           value="<?php echo $data['last_name']; ?>"
                    >
                    <?php if(!empty($last_name_error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $last_name_error; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="birthday">День рождения</label>
                    <input type="date"
                           class="form-control"
                           id="birthday"
                           name="birthday"
                           value="<?php echo $data['birthday']; ?>"
                    >
                    <?php if(!empty($birthday_error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $birthday_error; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email"
                           class="form-control"
                           id="email"
                           name="email"
                           value="<?php echo $data['email']; ?>"
                    >
                    <?php if(!empty($email_error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $email_error; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="old_pass">Старый пароль</label>
                    <input type="password"
                           class="form-control"
                           id="old_pass"
                           name="old_pass">
                    <?php if(!empty($old_pass_error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $old_pass_error; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="new_pass">Новый пароль</label>
                    <input type="password"
                           class="form-control"
                           id="new_pass"
                           name="new_pass">
                    <?php if(!empty($new_pass_error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $new_pass_error; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">Изменить данные</button>
            </form>
        </div>
        <div class="col-sm">
        </div>
    </div>
</div>

<?php
\Core\View::render('parts/footer.php');
?>
