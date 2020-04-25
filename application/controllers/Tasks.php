<?php
  class Tasks extends Controller {
    public function __construct(){
      $this->taskModel = $this->model('Task');
    }

    public function index(){
      $tasks = $this->taskModel->getTasks();
      $data = [
        'tasks' => $tasks,
        'css' => [
          '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">'
        ],
        'js' => [
          '<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>'
        ]
      ];
      $this->view('tasks/index', $data);
    }

    public function add(){
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data = [
          'user_name' => trim($_POST['user_name']),
          'body' => trim($_POST['body']),
          'email' => trim($_POST['email']),
          'user_name_err' => '',
          'body_err' => '',
          'email_err' => '',
        ];

        if(empty($data['user_name'])){
          $data['user_name_err'] = 'Введите имя пользователя';
        }
        if(empty($data['body'])){
          $data['body_err'] = 'Введите описание задачи';
        }
        if(empty($data['email'])){
          $data['email_err'] = 'Введите email';
        } else {
          if (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false ) {
            $data['email_err'] = 'Некорректно заполнено поле email';
          }
        }

        if(empty($data['user_name_err']) && empty($data['body_err']) && empty($data['email_err'])){
          if($this->taskModel->addTask($data)){
            flash('task_message', 'Задача была добавлена');
            redirect('tasks');
          } else {
            die('Что-то пошло не так...');
          }
        } else {
          $this->view('tasks/add', $data);
        }

      } else {
        $data = [
          'user_name' => '',
          'body' => '',
          'email' => ''
        ];
  
        $this->view('tasks/add', $data);
      }
    }

    public function edit($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $prevVerTask = $this->taskModel->getTaskById($id);

        $data = [
          'id' => $id,
          'user_name' => trim($_POST['user_name']),
          'body' => trim($_POST['body']),
          'email' => trim($_POST['email']),
          'changed_by_admin' => $prevVerTask->changed_by_admin,
          'user_name_err' => '',
          'body_err' => '',
          'email_err' => ''
        ];

        if(!isLoggedIn()){
          flash('task_message', 'Ваша сессия истекла. Требуется авторизация.', 'alert alert-danger');
          redirect('users/login');
          return false;
        }

        if ($prevVerTask->body !== trim($_POST['body'])){
          $data['changed_by_admin'] = 1;
        }

        if(empty($data['user_name'])){
          $data['user_name_err'] = 'Введите имя пользователя';
        }
        if(empty($data['body'])){
          $data['body_err'] = 'Введите описание задачи';
        }
        if(empty($data['email'])){
          $data['email_err'] = 'Введите email';
        } else {
          if (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false ) {
            $data['email_err'] = 'Некорректно заполнено поле email';
          }
        }

        if(empty($data['user_name_err']) && empty($data['body_err']) && empty($data['email_err'])){
          if($this->taskModel->updateTask($data)){
            flash('task_message', 'Задача обновлена');
            redirect('tasks');
          } else {
            die('Что-то пошло не так...');
          }
        } else {
          $this->view('tasks/edit', $data);
        }
      } else {

        if(!isLoggedIn()){
          flash('task_message', 'Ваша сессия истекла. Требуется авторизация.', 'alert alert-danger');
          redirect('users/login');
          return false;
        }

        $task = $this->taskModel->getTaskById($id);

        $data = [
          'id' => $id,
          'user_name' => $task->user_name,
          'body' => $task->body,
          'email' => $task->email
        ];
  
        $this->view('tasks/edit', $data);
      }
    }

    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $post = $this->taskModel->getTaskById($id);
        
        if(!isLoggedIn()){
          flash('task_message', 'Ваша сессия истекла. Требуется авторизация.', 'alert alert-danger');
          redirect('users/login');
          return false;
        }

        if($this->taskModel->deleteTask($id)){
          flash('task_message', 'Задача удалена');
          redirect('tasks');
        } else {
          die('Что-то пошло не так...');
        }
      } else {
        redirect('tasks');
      }
    }

    public function complete($id){ 
      if(!isLoggedIn()){
        flash('task_message', 'Ваша сессия истекла. Требуется авторизация.', 'alert alert-danger');
        redirect('users/login');
        return false;
      }

      if($this->taskModel->completeTask($id)){
        flash('task_message', 'Задача обновлена');
        redirect('tasks');
      } else {
        die('Что-то пошло не так...');
      }
    }
  }