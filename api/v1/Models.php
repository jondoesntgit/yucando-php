<?php

namespace Models;

require_once(dirname(__FILE__) . '/../../db/Db_conn.class.php');

class APIKey {
    public function __construct() {
	// TODO Constructor here
    }

    public function verifyKey($apiKey, $origin) {
      return true;
	// TODO verifyTheKey
    }
}

class User {
    public $id;
    public $firstName;
    public $lastName;
    
    public function __construct($apiKey = '') {
    $conn = new \Db_conn();
    $user = $conn->get_user_by_apiKey($apiKey);
    if (!empty ($user)) {
        $user = $user[0];
        $this->id = $user['id'];
        $this->firstName = $user['first_name'];
        $this->lastName = $user['last_name'];
        $this->name = $this->firstName . " " . $this->lastName;
    } else {
      $this->name = null;
    }
	// TODO Constructor here
    }
}
?>
