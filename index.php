<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


  <!-- Latest compiled JavaScript -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
  <!-- Allow touch zooming in mobile devices via bootstrap -->
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  
  <link rel="stylesheet" href="custom.css">
  
  <script>
  
  function reloadTable() {
    $.get('ui/getTable.php',function(data){
          $(" #table ").html(data)
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

<body>
  <div class="container">
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Yucando</a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Page 1</a></li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>
      </ul>
    </div>
  </div>
</nav>
</div>
  
  <div class = "container">

    <div class = "row border-between">
      <div class = "col-md-3">
        <h2>Projects Pane
      </div> <!-- /col-md-6 -->
      <div class = "col-md-6">
        <h2>Tasks Pane</h2>
  <?php

  include_once('header.php');
  require_once('db/Db_conn.class.php');
  require_once('ui/functions.php');
  require_once('ui/login.php');

  if (isset($_POST['username']) && isset($_POST['password'])) {
    $db = new Db_conn();
    $user_id = $db->attempt_login($_POST['username'], $_POST['password']);
    if($user_id) {
      echo "User id = " . $user_id;
      $_SESSION['user_id'] = $user_id; 
    } else {
      echo "Invalid login credentials";
    }
  }

  if (isset($_SESSION['user_id'])) {
    if (!isset($db)) {
      $db = new Db_conn();
    }
    $user_array = $db->get_user_by_id($_SESSION['user_id']);
    echo "Welcome " . $user_array['first_name'] ." ". $user_array['last_name'];
  } else {
    echo getLoginForm();
  }

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
</div> <!-- /column -->
<div class = "col-md-3">
  <h2>Social Pane</h2>
</div>
</div> <!-- /row -->
</div> <!-- /contaier -->

<footer>
    <div class="navbar navbar-inverse navbar-fixed-bottom">
        <div class="container">
            <div class="navbar-collapse collapse" id="footer-body">
                <ul class="nav navbar-nav">
                    <li><a href="#">Browse Our Library</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Our Partners</a></li>
                    <li><a href="#">User Review</a></li>
                    <li><a href="#">Terms &amp; Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
          	<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#footer-body">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <ul class="footer-bar-btns visible-xs">
                    <li><a href="#" class="btn" title="History"><i class="fa fa-2x fa-clock-o blue-text"></i></a></li>
                    <li><a href="#" class="btn" title="Favourites"><i class="fa fa-2x fa-star yellow-text"></i></a></li>
                    <li><a href="#" class="btn" title="Subscriptions"><i class="fa fa-2x fa-rss-square orange-text"></i></a></li>
                </ul>
            </div>

        </div>
    </div>
</footer>

</body>
