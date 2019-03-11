<?php
include "includes/header.php";

// Check if user submitted form
if(isset($_POST['submit'])){
  //receive data
  $name = sanitize($_POST['name']);
  $birthday = sanitize($_POST['birthday']);
  $color = sanitize($_POST['color']);
  $class = sanitize($_POST['class']);
  if(isset($_POST['bio'])){
    $bio = sanitize($_POST['bio']);
  }
  $user_priv = 1;
  $unknown_photo = "images/blank-profile.png";
  $user_id = $_SESSION['user_id'];

  //Create prepared statement to submit to db
  if(!($submit_user = $conn->prepare("INSERT INTO dnd_users (login_id,user_alias,user_image,user_description,user_priveleges,user_color,user_class,user_birthday) VALUES (?,?,?,?,?,?,?,?)"))){
    echo "SQL Prepare failed: (" . $conn->errno . ") " . $conn->error;
  } else {
    if(!($submit_user->bind_param("isssisss",$user_id,$name,$unknown_photo,$bio,$user_priv,$color,$class,$birthday))){
      echo "Failed to Bind SQL Prepare: (" . $submit_user->errno . ") " . $submit_user->error;
    } else {
      if(!($submit_user->execute())){
        echo "Query execution failed: (" . $submit_user->errno . ")" . $submit_user->error;
      } else {
        $_SESSION['new_user'] = False;
        header("Location:account.php");
      }
    }
  }
}


if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE && isset($_SESSION['new_user']) && $_SESSION['new_user'] == True){
?>
<!DOCTYPE html>
<html>
  <head>
  <?php include "includes/head.html"; ?>
  <link rel="stylesheet" type="text/css" href="css/account.css">
  </head>
  <body class = "grid header-three-sections-small">
    <div class = "col-1-3 banner flex apart flex-center-vertical p-left-10 m-bottom-10">
      <h1 class = "primary-font banner-title"> D&D Tools </h1>
    </div>
    <div id = "account" class = "flex column p-10">
      <h2 class = "primary-font m-5 "> Welcome! </h1>
      <p class = "secondary-font m-5"> Thanks for trying D&D Tools! If you don't mind, tell us about yourself. </p>
      <br/>
      <form method = "POST" class = "flex column" action = "new_account.php">
        <div class = "margin-center flex column" id = "text-info">
          <label for = "name" class = "secondary-font" required> Your name? </label>
          <input class = "account-input" name = "name" placeholder = "Adventurer" type = "text">
          <br/>
          <label for = "birthday" class = "secondary-font"> Birthday </label>
          <input class = "account-input" type = "date" name = "birthday">
          <br/>
          <label for = "color" class = "secondary-font"> Favorite Color? </label>
          <select class = "account-input" name = "color">
            <option value = "Red"> Red </option>
            <option value = "Blue"> Blue </option>
            <option value = "Green"> Green </option>
            <option value = "Gold"> Gold </option>
            <option value = "Purple"> Purple </option>
            <option value = "Pink"> Pink </option>
            <option value = "Orange"> Orange </option>
          </select>
          <br/>
          <label for = "class" class = "secondary-font"> Favorite Class? </label>
          <select class = "account-input" name = "class">
            <option value = "Barbarian"> Barbarian </option>
            <option value = "Bard"> Bard </option>
            <option value = "Cleric"> Cleric </option>
            <option value = "Druid"> Druid </option>
            <option value = "Fighter"> Fighter </option>
            <option value = "Monk"> Monk </option>
            <option value = "Paladin"> Paladin </option>
            <option value = "Ranger"> Ranger </option>
            <option value = "Rogue"> Rogue </option>
            <option value = "Sorcerer"> Sorcerer </option>
            <option value = "Warlock"> Warlock </option>
            <option value = "Wizard"> Wizard </option>
          </select>
          <br/>
          <label for = "bio" class = "secondary-font"> Describe yourself </label>
          <textarea name = "bio" rows = "5">
          </textarea>
          <br/>
          <br/>
          <input name = "submit" class = "btn primary-font bg-red m-bottom-10" type = "submit" value = "Continue"/>
        </div>
      </form>
    </div>
  </body>
</html>

<?php
}
?>
