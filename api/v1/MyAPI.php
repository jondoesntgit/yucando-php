<?php
require_once 'API.class.php';
require_once 'Models.php';
require_once '../../db/Db_conn.class.php';
class MyAPI extends API
{
    protected $User;
    protected $conn;

    public function __construct($request, $origin) {
        parent::__construct($request);

        // Abstracted out for example
        $APIKey = new Models\APIKey();
        $User = new Models\User($this->request['apiKey']);
	
        if (!array_key_exists('apiKey', $this->request)) {
            throw new Exception('No API Key provided');
        } else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
            throw new Exception('Invalid API Key');
        } else if (array_key_exists('token', $this->request) &&
             !$User->get('token', $this->request['token'])) {

            throw new Exception('Invalid User Token');
        }
        
        $this->conn = new Db_conn();
        $this->User = $User;
    }

    /**
     * Example of an Endpoint
     */
     protected function example() {
        if ($this->method == 'GET') {
            return "Your name is " . $this->User->name;
        } else {
            return "Only accepts GET requests";
        }
     }
     
     protected function user() {
       if ($this->method == 'GET') {
         return $this->conn->get_users();
       } else {
         return Array();
       }
     }
     
     protected function punch_in() {
       if ($this->method == 'POST') {
         $task_id = isset($this->args[0]) ? $this->args[0] : 0; // TODO Sanitization
         return $this->conn->insert_start_punch($task_id);
       } else {
         return Array();
       }
     }
     
     protected function punch_out() {
       if ($this->method == 'POST') {
         $task_id = isset($this->args[0]) ? $this->args[0] : 0; // TODO Sanitization
         return $this->conn->insert_stop_punch($task_id);
       } else {
         return Array();
       }
     }
     
     protected function task() {
       
       if ($this->method == 'POST') {
         $title = isset($this->request['title']) ? $this->request['title'] : "New Task";
         $this->conn->insert_task($title);
         return Array("title" => $title);
       } elseif ($this->method == 'GET') {
         $results = $this->conn->get_tasks();
         return $results;
       } else {
         return Array();
       }
     }
     
     protected function punch() {
       if ($this->method == 'GET') {
           return $this->conn->get_punches(3);
       } else {
           return array();
       }
     }
     
     protected function complete_task() {
       if ($this->method == 'POST') {
         $task_id = isset($this->args[0]) ? $this->args[0] : 0; // TODO Sanitization
         return $this->conn->complete_task($task_id);
       } else {
         return Array();
       }
     }
}
?>
