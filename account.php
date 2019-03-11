<?php
include "includes/header.php";

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = TRUE){
?>

<!DOCTYPE html>
<html>
  <?php include "includes/head.html"; ?>
  <body class = "grid header-three-sections-inverse">
    <div class = "col-1-3 banner flex apart flex-center-vertical p-left-10 m-bottom-10">
      <h1 class = "primary-font banner-title"> D&D Tools </h1>
      <div class = "flex row flex-center-vertical">
        <div class = "login-status m-10">
          <p class = "text-light"> Logged in as <?php echo $_SESSION['username']; ?> </p>
        </div>
        <div class="hamburger" onclick = "shownav()">
          <i class="fas fa-bars fa-3x" style = "color:white;"></i>
        </div>
      </div>
    </div>
    <div id = "account" class = "flex column p-10">
      <div id = "profilePhoto">
        <img src="images/blank-profile.png" alt = "Profile photos not enabled yet">
      </div>
    </div>
    <div id = "info" class = "flex column p-10">
    </div>
    <?php include "includes/nav.php"; ?>
    </div>
  </body>
</html>

<?php
}
?>
