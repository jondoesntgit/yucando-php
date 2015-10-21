<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>
    function punch_in(task_id) {
      postUrl = 'api/v1/punch_in/' + task_id;
      $.post(postUrl, {'apiKey' : 123 }, function(data){
      });
      location.reload();
    }
      
    function punch_out(task_id) {
      postUrl = 'api/v1/punch_out/' + task_id;
      $.post(postUrl, {'apiKey' : 123 }, function(data){
      });
      location.reload();
    }
    
    function complete(task_id) {
      postUrl = 'api/v1/complete_task/' + task_id;
      $.post(postUrl, {'apiKey' : 123 }, function(data){
      });
      location.reload();
    }
    
    function create_task(title) {
      postUrl = 'api/v1/task/';
      $.post(postUrl, {'apiKey' : 123, 'title' : title}, function(data){
        console.log(data);
      });
      location.reload();
    }
    
  $(document).ready(function(){
    $("#addTask").submit(function( event ) {
      create_task($("#title").val())
      location.reload();
    });
  })
  
    
  </script>
</head>

<?php
include_once('header.php');
require_once('db/Db_conn.class.php');
?>

<form id="addTask" action="#">
  <input type="text" id="title" />
  <input type="submit" value="Add Task" />
</form>

<?php
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


$conn = new Db_conn();

$tasks = $conn->get_tasks();
echo "<table border=1>\n";
echo "<tr><th>Name</th><th>Punches</th><th>Complete</th></tr>\n";
foreach ($tasks as $task) {
    if (empty($task['completed_at'])) {
    $punches = $conn->get_punches($task['id']);
    echo "<tr>
      <td>" . $task['title'] . "</td>
      <td>" . listPunches($punches, $task['id']) . "</td>
      <td><a href='#' onclick = \"complete({$task['id']})\">Complete</a></td>
    </tr>\n"; 
  }
}


echo "</table>";
?>
