<?php 

function getLoginForm() {
  $loginForm = '
  <form method="POST" action="#" ><br/>
  Please log in.
  Username: <input type="text" name="username" /><br/>
  Password: <input type="password" name="password" /><br/>
  <input type="submit" value="login">
  </form>
  ';
  return $loginForm;  
}

?>
