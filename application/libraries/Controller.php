<?php
  class Controller{
    public function model($model){
      require_once '../application/models/'.$model.'.php';
      return new $model();
    }

    public function view($view, $data = []){
      if(file_exists('../application/views/'.$view.'.php')){
        require_once '../application/views/'.$view.'.php';
      } else {
        die('Представление не найдено');
      }
    }
  }