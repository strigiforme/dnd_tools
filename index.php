<?php
  include "includes/db_local.php";

  if(isset($_POST['submit'])){
    // Account creation requested
    if(isset($_POST['email'])){
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
            } else {
              //inform user email is already registered
            }
          }
        }
      }
    }
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <title> DND Tools </title>
    <meta charset = "utf-8" />

    <!-- Font and package imports -->
    <script src="https://threejs.org/build/three.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">

    <!-- CSS imports -->
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/color.css">
    <link rel="stylesheet" type="text/css" href="css/controls.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/text.css">

    <!-- Javascript -->
    <script src="js/scripts.js"></script>

</head>
  <body>
    <div class = "flex text-center flex-center column half-width main-container">
      <h1 class = "title block m-auto m-bottom-15"> Howard's 5e Tools </h1>
      <form method = "POST">
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
          <input id = "submit" name = "submit" class = "btn primary-font bg-red m-bottom-10" type = "submit" value = "Continue"/>
        </div>
      </form>
      <button id = "signup" class = "btn primary-font bg-lightblue" onclick = "login()"> Sign Up </button>
    </div>
  </body>
</html>
