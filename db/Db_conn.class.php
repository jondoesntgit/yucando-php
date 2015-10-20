<?php

class Db_conn {
  
  private $db;
  
  public function __construct() {
    // Get database configuration from configuration file.
    $config = parse_ini_file("config.ini");
    $username = $config['mysql_user'];
    $password = $config['mysql_pass'];
    $dbname = $config['mysql_db'];
    $host = $config['mysql_host'];

    // Initialize connection into PDO object
    $this->db = new PDO(
        "mysql:host={$host};dbname={$dbname};charset=utf8", 
        $username, 
        $password
      );
  }

  public function insert_user($username) {
    $stmt = $this->db->prepare("INSERT INTO users (`username`) VALUES (:username)");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
  }

  public function get_users() {
    $stmt = $this->db->query('SELECT * FROM users');
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  public function get_tasks() {
    $stmt = $this->db->query('SELECT * FROM tasks');
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }
  
  public function insert_task($title) {
    $stmt = $this->db->prepare("INSERT INTO tasks (`title`) VALUES (:title)");
    $stmt->bindParam(':title', $title);
    $stmt->execute();
  }
  
  public function insert_start_punch($task_id) {
    $punch_in = date("Y-m-d G:i:s");
    $stmt = $this->db->prepare("INSERT INTO timepunches (`task_id`,`punch_in`) VALUES (:task_id,:punch_in)");
    $stmt->bindParam(':task_id', $task_id);
    $stmt->bindParam(':punch_in', $punch_in);
    $stmt->execute();    
  }
  
  public function insert_stop_punch($task_id) {
    $punch_out = date("Y-m-d G:i:s");
    $stmt = $this->db->prepare("UPDATE timepunches SET `punch_out` = :punch_out WHERE `task_id` = :task_id");
    $stmt->bindParam(':task_id', $task_id);
    $stmt->bindParam(':punch_out', $punch_out);
    $stmt->execute();   
  }
  
  public function get_punches($task_id) {
    $stmt = $this->db->prepare('SELECT * FROM timepunches where `task_id` = :task_id');
    $stmt->bindParam(':task_id', $task_id);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }
  
}
?>
