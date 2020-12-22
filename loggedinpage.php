<?php

    session_start();
    // $diaryContent="";

    if (array_key_exists("id", $_COOKIE) && $_COOKIE ['id']) {
        
        $_SESSION['id'] = $_COOKIE['id'];
    }

    if (array_key_exists("id", $_SESSION)) {
              
      include("includes/connection.php");
      
      $query = "SELECT diary FROM `users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
      $row = mysqli_fetch_array(mysqli_query($link, $query));
      $diaryContent = $row['diary'];

      $query = "SELECT name FROM `users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
      $row = mysqli_fetch_array(mysqli_query($link, $query));
      $name = $row['name'];
      
    } else {

        header("Location: index.php");
    }

	include("includes/header.php");

?>

  <nav class="navbar navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#">Secret Diary</a>

      <div>
        <a href='index.php?logout=1'>
          <button class="btn btn-outline-success" type="submit">Logout</button></a>
      </div>
  </nav>

    <div class="container-fluid" id="containerLoggedInPage">
      <h4 class="text-center">Hey <?php echo htmlspecialchars($name); ?></h4>
      <p class="text-center diary-info">Don't worry about clicking 'save' anywhere - your diary contents will automatically save
        <span>
          <button class="btn btn-light hide">Hide</button>
        </span>
      </p>
      <textarea id="diary" class="form-control" ><?php echo htmlspecialchars($diaryContent); ?></textarea>
    </div>
    
<?php include("includes/footer.php"); ?>