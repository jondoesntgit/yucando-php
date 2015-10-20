<?php
include_once('header.php');
require_once('db/Db_conn.class.php');

function listPunches($punches) {
  if (empty($punches)) return "No punches" ;
  return $punches[0]['punch_in'];
}

$conn = new Db_conn();

$tasks = $conn->get_tasks();
echo "<table border=1>\n";
echo "<tr><th>Name</th></tr>\n";
foreach ($tasks as $task) {
  $punches = $conn->get_punches($task['id']);
  echo "<tr><td>" . $task['title'] . "</td><td>" . listPunches($punches) . "</td></tr>\n"; 
  
}


echo "</table>";
?>
