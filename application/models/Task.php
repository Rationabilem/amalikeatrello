<?php
  class Task {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getTasks(){
      $this->db->query('SELECT * FROM tasks');

      $results = $this->db->resultSet();
      return $results;
    }

    public function addTask($data){
      $this->db->query('INSERT INTO tasks (user_name, email, body) VALUES(:user_name, :email, :body)');
      $this->db->bind(':user_name', $data['user_name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':body', $data['body']);

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateTask($data){
      $this->db->query('UPDATE tasks SET user_name = :user_name, email = :email, body = :body, changed_by_admin = :changed_by_admin WHERE id = :id');
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':user_name', $data['user_name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':body', $data['body']);
      $this->db->bind(':changed_by_admin', $data['changed_by_admin']);
      
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function completeTask($id){
      $task = $this->getTaskById($id);
      $this->db->query('UPDATE tasks SET completed = :completed WHERE id = :id');
      $this->db->bind(':id', $id);
      $this->db->bind(':completed', ($task->completed == 1 ? 0 : 1));

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getTaskById($id){
      $this->db->query('SELECT * FROM tasks WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function deleteTask($id){
      $this->db->query('DELETE FROM tasks WHERE id = :id');
      $this->db->bind(':id', $id);

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }