<?php require APP_ROOT . '/views/includes/header.php'; ?>
  <a href="<?php echo URL_ROOT; ?>/tasks" class="btn btn-light"><i class="fa fa-long-arrow-left"></i> Назад</a>
  <div class="card card-body bg-light mt-5">
    <h2>Редактирование задачи</h2>
    <form action="<?php echo URL_ROOT; ?>/tasks/edit/<?php echo $data['id']; ?>" method="post">
      <div class="form-group">
        <label for="user_name">Имя пользователя: <sup>*</sup></label>
        <input type="text" name="user_name" class="form-control form-control-lg <?php echo (!empty($data['user_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['user_name']; ?>">
        <span class="invalid-feedback"><?php echo $data['user_name_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="email">Email: <sup>*</sup></label>
        <input type="text" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="body">Описание: <sup>*</sup></label>
        <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
        <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
      </div>
      <input type="submit" class="btn btn-success" value="Submit">
    </form>
  </div>
<?php require APP_ROOT . '/views/includes/footer.php'; ?>