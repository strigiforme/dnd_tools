<?php

function sanitize ($sanitizeThisThing) {
  $sanitizedThing = trim($sanitizeThisThing);
  $sanitizedThing = stripslashes($sanitizedThing);
  $sanitizedThing = htmlspecialchars($sanitizedThing);

  return $sanitizedThing;
}

function submit_user($user,$pass,$email,$conn){
  //clean up inputs to avoid injection
  $username = sanitize($user);
  $password = sanitize($pass);
  $user_email = sanitize($email);
  //hash Password
  $password = password_hash($password,PASSWORD_DEFAULT);
  //generate salt
  $salt = rand();
  //submit info to database
  if(!($submit_user = $conn->prepare("INSERT INTO dnd_login (login_username,login_password,login_email,login_random_salt) VALUES (?,?,?,?)"))){
    return "SQL Prepare failed: (" . $conn->errno . ") " . $conn->error;
  } else {
    if(!($submit_user->bind_param("sssi",$username,$password,$user_email,$salt))){
      return "Failed to Bind SQL Prepare: (" . $submit_user->errno . ") " . $submit_user->error;
    } else {
      if(!($submit_user->execute())){
        return "Query execution failed: (" . $submit_user->errno . ")" . $submit_user->error;
      } else {
        return "You're all signed up!";
      }
    }
  }
}

function login_user($user,$pass,$conn){
  //clean inputs
  $username = sanitize($user);
  $password = sanitize($pass);
  //check if user exists
  if(!($check_username = $conn->prepare("SELECT * FROM dnd_login WHERE login_username = (?)"))){
    return "SQL Prepare failed: (" . $conn->errno . ") " . $conn->error;
  } else {
    if(!($check_username->bind_param("s",$username))){
      return "Failed to Bind SQL Prepare: (" . $check_username->errno . ") " . $check_username->error;
    } else {
      if(!($check_username->execute())){
        return "Query execution failed: (" . $check_username->errno . ")" . $check_username->error;
      } else {
        $result = $check_username->get_result();
        if($result->num_rows > 0){
          //check if password matches
          while($row = $result->fetch_assoc()){
            $db_password = $row['login_password'];
            if(password_verify($password,$db_password)){
              $_SESSION['loggedin'] = TRUE;
              $_SESSION['user_id'] = $row['login_id'];
              $_SESSION['last_login'] = getdate();
              header("Location:dnd_home.php");
            } else {
              return "<p class = 'text-red secondary-font'> Email / Password incorrect. </p>";
            }
          }
        } else {
          return "<p class = 'text-red secondary-font'> Email / Password incorrect. </p>";
        }
      }
    }
  }
}

?>
