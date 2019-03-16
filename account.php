<?php
include "includes/header.php";

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = TRUE){
  if(!isset($_GET['user_id'])){
    get_user_stats($_SESSION['user_id'],$conn);
  } else {
    get_user_stats($_GET['user_id'],$conn);
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <?php include "includes/head.html"; ?>
    <link rel="stylesheet" type="text/css" href="css/account.css">
  </head>
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
    <div id = "account-info" class = "flex column">
      <!-- Head information about player, picture, name, description, etc. -->
      <div id = "summary" class = "flex row">
        <div id = "profilePhoto" style = "background-color:<?= $_SESSION['user_color'];?>">
          <img src="images/blank-profile.png" alt = "Profile photos not enabled yet">
        </div>
        <div class = "flex column m-left-10 flex-grow rounded p-10">
          <div class = "flex column flex-grow">
            <div>
              <h3 class = "account-title primary-font m-0"> <?= $_SESSION['user_alias']; ?> <span class = "account-favorites primary-font m-0"> ( <?php echo $_SESSION['user_class']; ?> ) </span></h3>
            </div>
            <hr/>
            <p class = "m-0 secondary-font"> <?= $_SESSION['user_description']; ?></p>
          </div>
          <hr/>
        </div>
      </div>
      <!--  -->
      <div>

      </div>
    </div>
    <!-- Extra info should it be needed -->
    <div id = "friends" class = "flex column p-10 bg-gray">
    </div>
    <?php include "includes/nav.php"; ?>
    </div>
  </body>
</html>

<?php
}
?>
