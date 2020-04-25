<?php require APP_ROOT . '/views/includes/header.php'; ?>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
        <?php flash('login_success'); ?>
        <?php flash('task_message'); ?>
        <h2>Вход</h2>
        <p>Заполните форму, чтобы авторизироваться</p>
        <form action="<?php echo URL_ROOT; ?>/users/login" method="post">
          <div class="form-group">
            <label for="login">Логин: <sup>*</sup></label>
            <input type="login" name="login" class="form-control form-control-lg <?php echo (!empty($data['login_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['login']; ?>">
            <span class="invalid-feedback"><?php echo $data['login_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="password">Пароль: <sup>*</sup></label>
            <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
          </div>
          <div class="row">
            <div class="col">
              <input type="submit" value="Login" class="btn btn-success btn-block">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php require APP_ROOT . '/views/includes/footer.php'; ?>