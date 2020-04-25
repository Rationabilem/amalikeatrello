<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
  <div class="container">
      <a class="navbar-brand" href="<?php echo URL_ROOT; ?>"><?php echo SITE_NAME; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URL_ROOT; ?>">Главная</a>
          </li>
        </ul>
        
        <ul class="navbar-nav ml-auto">
          <?php if(isset($_SESSION['user_id'])) : ?>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo URL_ROOT; ?>/users/logout">Выйти</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URL_ROOT; ?>/users/login">Войти</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>