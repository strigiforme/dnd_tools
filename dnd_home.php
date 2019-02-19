<?php
include "includes/header.php";

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = TRUE){
?>

<!DOCTYPE html>
<html>
  <?php include "includes/head.html"; ?>
  <body class = "grid header-three-sections">
    <div class = "col-1-3 banner flex flex-center-vertical p-left-10 m-bottom-10">
      <h1 class = "primary-font banner-title"> D&D Tools </h1>
    </div>
    <div id = "content-panel" class = "flex column p-10">
      <div id = "characters">
        <p class =  "bubble-title">  Characters: </p>
        <div class = "bubble">
          <p class = "bubble-data"> No Characters yet! </p>
        </div>
      </div>
      <div id = "campaigns">
        <p class = "bubble-title">  Campaigns: </p>
        <div class = "bubble">
          <p class = "bubble-data"> No Campaigns yet! </p>
        </div>
      </div>
      <div id = "homebrew">
        <p class = "bubble-title"> Homebrew: </p>
        <div class = "bubble">
          <p class = "bubble-data"> No Homebrew yet! </p>
        </div>
      </div>
      <div id = "users">
        <p class = "bubble-title"> Users: </p>
        <?php
        // make query to get all Users
        $userQuery = "SELECT login_username, login_id from dnd_login";
        $userQueryResult = $conn->query($userQuery);

        if($userQueryResult){
          while($row = $userQueryResult->fetch_assoc()){
              echo "<div class = 'bubble'>";
              echo "<p class = 'bubble-data'>" . $row['login_username'] . "</p>";
              echo "</div>";
          }
        }
        ?>
      </div>
    </div>
    <div class = "col-2-3 m-left-10 home p-10">
      <h2 class = "mainbody-header"> Notifications </h2>
      <hr/>
    </div>
  </body>
</html>

<?php
}
?>
