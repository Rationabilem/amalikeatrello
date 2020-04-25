<?php
  class Users extends Controller {
    public function __construct(){
      $this->userModel = $this->model('User');
    }

    public function login(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data =[
          'login' => trim($_POST['login']),
          'password' => trim($_POST['password']),
          'login_err' => '',
          'password_err' => '',      
        ];

        if(empty($data['login'])){
          $data['login_err'] = 'Введите адрес электронной почты';
        }

        if(empty($data['password'])){
          $data['password_err'] = 'Введите пароль';
        }

        if($this->userModel->findUserByLogin($data['login'])){
        } else {
          $data['login_err'] = 'Неверный логин';
        }

        if(empty($data['login_err']) && empty($data['password_err'])){
          $loggedInUser = $this->userModel->login($data['login'], $data['password']);

          if($loggedInUser){
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_err'] = 'Неверный пароль';
            $this->view('users/login', $data);
          }
        } else {
          $this->view('users/login', $data);
        }


      } else {
        $data =[    
          'login' => '',
          'password' => '',
          'login_err' => '',
          'password_err' => '',        
        ];
        $this->view('users/login', $data);
      }
    }

    public function createUserSession($user){
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_login'] = $user->login;
      redirect('tasks');
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_login']);
      session_destroy();
      redirect('tasks');
    }
  }