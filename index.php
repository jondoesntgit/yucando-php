<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="jquery.min.js"></script>
  <script>
  
  function reloadTable() {
    $.get('ui/getTable.php',function(data){
          $(" #table ").html(data)
          console.log("Hello")
    })}
    
    function punch_in(task_id) {
      postUrl = 'api/v1/punch_in/' + task_id;
      $.post(postUrl, {'apiKey' : 123 }, function(data){
      });
      reloadTable()
    }
      
    function punch_out(task_id) {
      postUrl = 'api/v1/punch_out/' + task_id;
      $.post(postUrl, {'apiKey' : 123 }, function(data){
      });
      reloadTable()
    }
    
    function complete(task_id) {
      postUrl = 'api/v1/complete_task/' + task_id;
      $.post(postUrl, {'apiKey' : 123 }, function(data){
      });
      reloadTable()
    }
    
    function create_task(title) {
      postUrl = 'api/v1/task/';
      $.post(postUrl, {'apiKey' : 123, 'title' : title}, function(data){
        console.log(data);
      });
      reloadTable()
    }
    
  $(document).ready(function(){
    $("#addTask").submit(function( event ) {
      create_task($("#title").val())
      reloadTable()
    });
  })
  
  $(document).ready(function(){
    $("#refresher").submit(function( event ) {
      reloadTable()
    });
  })
  
    
  </script>
</head>

<?php

include_once('header.php');
require_once('db/Db_conn.class.php');
require_once('ui/functions.php');
?>

<form id="addTask" action="#">
  <input type="text" id="title" />
  <input type="submit" value="Add Task" />
</form>

<form id="refresher" action="#">
  <input type="submit" value="Refresh" />
</form>

<div id=table>
<?php
  echo makePunchTable();
?>
</div>
