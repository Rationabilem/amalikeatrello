<?php require APP_ROOT . '/views/includes/header.php'; ?>
  <?php flash('task_message'); ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Задачи</h1>
    </div>
    <div class="col-md-6">
      <a href="<?php echo URL_ROOT; ?>/tasks/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil"></i> Добавить задачу
      </a>
    </div>
  </div>
  <table id="tasks" class="display" style="width: 100%;">
    <thead>
      <tr>
        <th style="width: 13%;">Имя</th>
        <th style="width: 15%;">Email</th>
        <th>Описание</th>
        <th style="width: 30%;">Статус</th>
        <?php if(isLoggedIn()): ?>
        <th style="width: 40px;"></th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
    <?php foreach($data['tasks'] as $task) : ?>
      <tr>
        <td><?php echo $task->user_name;?></td>
        <td><?php echo $task->email;?></td>
        <td><?php echo $task->body;?></td>
        <td>
          <?php if($task->completed == true):?>
            <span class="badge badge-success">Выполнено</span>
          <?php endif; ?>
          <?php if($task->changed_by_admin == true):?>
            <span class="badge badge-primary">Отредактировано администратором</span>
          <?php endif; ?>
        </td>
        <?php if(isLoggedIn()): ?>
        <td>
          <a href="<?php echo URL_ROOT; ?>/tasks/complete/<?php echo $task->id; ?>" class="btn btn-link p-0">
            <i class="fa fa-check-square-o" aria-hidden="true"></i>
          </a>
          <a href="<?php echo URL_ROOT; ?>/tasks/edit/<?php echo $task->id; ?>" class="btn btn-link p-0">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          </a>
          <form class="pull-right" action="<?php echo URL_ROOT; ?>/tasks/delete/<?php echo $task->id; ?>" method="post">
            <button style="cursor: pointer;" class="btn btn-link p-0" type="submit"><i style="color: red;" class="fa fa-times" aria-hidden="true"></i></button>
          </form>
        </td>
        <?php endif; ?>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <div class="mb-3"></div>
  <script>
    $(document).ready(function(){
      $('#tasks').DataTable({
        <?php if(isLoggedIn()): ?>
        "aoColumnDefs": [
          { "bSortable": false, "aTargets": [4] }, 
        ],
        <?php endif; ?>
        "language": {
            responsive: true,
            "lengthMenu": "Показать _MENU_ записей на странице",
            "zeroRecords": "Ничего не найдо",
            "search": "Поиск:",
            "info": "Показана _PAGE_ страница из _PAGES_",
            "infoEmpty": "Нет доступных записей",
            "infoFiltered": "(отфильтровано из _MAX_ записей)",
            "paginate": {
              "first":      "Первая",
              "last":       "Последняя",
              "next":       "След.",
              "previous":   "Пред."
          },
        }
      });
    });
  </script>
<?php require APP_ROOT . '/views/includes/footer.php'; ?>