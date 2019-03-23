<?php
  include "includes/header.php";

  if(isset($_POST['submit'])){
    // Account creation requested
    if(isset($_POST['email']) && $_POST['email'] != ""){
      //Check if account exists first
      if(!($check_login = $conn->prepare("SELECT * FROM dnd_login WHERE login_email = (?)"))){
        echo "SQL Prepare failed: (" . $conn->errno . ") " . $conn->error;
      } else {
        if(!($check_login->bind_param("s",$_POST['email']))){
          echo "Failed to Bind SQL Prepare: (" . $check_login->errno . ") " . $check_login->error;
        } else {
          if(!($check_login->execute())){
            echo "Query execution failed: (" . $check_login->errno . ")" . $check_login->error;
          } else {
            $result = $check_login->get_result();
            if($result->num_rows == 0){
              //create account, as email doesn't exist
              submit_user($_POST['username'],$_POST['password'],$_POST['email'],$conn);
            } else {
              $login_result = "<p class = 'text-red'> Email is already registered. </p>";
            }
          }
        }
      }
    } else {
      //log user in regularly
      $login_result = login_user($_POST['username'],$_POST['password'],$conn);
    }
  }

?>
<!DOCTYPE html>
<html>
  <?php include "includes/head.html"; ?>
  <body class = "grid three-sections">
    <div class = "col-2">
      <h1 class = "title block m-auto m-bottom-15"> Howard's 5e Tools </h1>
      <?php if(!isset($_SESSION['loggedin'])) { ?>
        <form action = "index.php" method = "POST">
          <div class = "input-container">
            <input name = "username" class = "form-input primary-font" type = "text" placeholder="Username"/> <br/>
          </div>
          <div class = "input-container">
            <input name = "password" class = "form-input primary-font" type = "password" placeholder="Password"/>
          </div>
          <div class = "input-container hidden m-bottom-10" >
            <input id = "email" class = "form-input primary-font" name = "email" type = "input" placeholder="Email"/>
          </div>
          <div>
            <input id = "submit" name = "submit" class = "btn secondary-font bg-red m-bottom-10" type = "submit" value = "Continue"/>
          </div>
        </form>
        <button id = "signup" class = "btn secondary-font bg-lightblue" onclick = "login()"> Sign Up </button>
        <div class = "flex flex-center">
            <?php if(isset($login_result)){echo $login_result;} ?>
        </div>
      </div>
      <div class = "col-3">
        <div>

        </div>
      </div>
    <?php } ?>
  </body>
</html>
