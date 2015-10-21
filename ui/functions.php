<?php 
require_once(dirname(__FIlE__) . '/../db/Db_conn.class.php');
function listPunches($punches,$task_id) {
  //if (empty($punches)) return "punch in here" ;
  $returnString = '';
  foreach ($punches as $punch) {
    if (empty($punch['punch_in'])) {
      $returnString .= "<a href=# onclick = \"punch_in({$task_id})\">Punch in</a>";
      break;
    }
    $secondString = empty($punch['punch_out']) ? " -- <a href='#' onclick = \"punch_out({$task_id}) \">Punch out</a><br/>" : " -- " . $punch['punch_out'] . "<br/>";
    $returnString .= $punch['punch_in'] . $secondString;
  }
        $returnString .= "<a href=# onclick = \"punch_in({$task_id})\">Punch in</a>";
  return $returnString;
}

function makePunchTable() {
  $table = '';
  $conn = new Db_conn();
  $tasks = $conn->get_tasks();
  $table .=  "<table border=1>\n";
  $table .= "<tr><th>Name</th><th>Punches</th><th>Complete</th></tr>\n";
  foreach ($tasks as $task) {
      if (empty($task['completed_at'])) {
      $punches = $conn->get_punches($task['id']);
      $table .= "<tr>
        <td>" . $task['title'] . "</td>
        <td>" . listPunches($punches, $task['id']) . "</td>
        <td><a href='#' onclick = \"complete({$task['id']})\">Complete</a></td>
      </tr>\n"; 
    }
  }
  $table .= "</table>";
  return $table;
}

?>
