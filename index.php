<?php

    session_start();

    $error = ""; 

    if (array_key_exists("logout", $_GET)) {
        
        unset($_SESSION);
        setcookie("id", "", time() - 60*60);
        $_COOKIE["id"] = "";  
        
        session_destroy();
        
    } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {
        
        header("Location: loggedinpage.php");
    }

    if (array_key_exists("submit", $_POST)) {

        include("includes/submit.php");
    }

?>

<?php include("includes/header.php"); ?>
      
<div class="container" id="homePageContainer">

    <h1>Secret Diary</h1>
    
    <p class="lead">Store your thoughts permanently and securely.</p>
          
    <div id="error"><?php if ($error!="") { 
    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
    } ?></div>

<form method="post" id = "signUpForm">
    
    <p class="info">Interested? Sign up now.</p>

    <fieldset class="form-group">
        <input class="form-control" type="text" name="name" placeholder="Your Name" value="<?php echo htmlspecialchars($name); ?>">
    </fieldset>

    <fieldset class="form-group">
        <input class="form-control" type="email" name="email" placeholder="Your Email" value="<?php echo htmlspecialchars($email); ?>">
    </fieldset>
    
    <fieldset class="form-group">
        <input class="form-control" type="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($password); ?>">
    </fieldset>
    
    <div class="checkbox">
        <label>
            <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in
        </label>
    </div>
    
    <fieldset class="form-group">
        <input type="hidden" name="signUp" value="1">
        <input class="btn btn-primary" type="submit" name="submit" value="Sign Up!">
    </fieldset>
    
    <p><a class="toggleForms btn btn-secondary">Log In</a></p>

</form>

<form method="post" id = "logInForm">
    
    <p class="info">Log in using your username and password.</p>

    <fieldset class="form-group">
        <input class="form-control" type="email" name="email" placeholder="Your Email">
    </fieldset>
    
    <fieldset class="form-group">
        <input class="form-control"type="password" name="password" placeholder="Password">
    </fieldset>
    
    <div class="checkbox">
        <label>
            <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in
        </label>
    </div>
        
        <input type="hidden" name="signUp" value="0">
    
    <fieldset class="form-group">
        <input class="btn btn-secondary" type="submit" name="submit" value="Log In">
    </fieldset>
    
    <p><a class="toggleForms btn btn-primary">Sign Up</a></p>

</form>
          
      </div>

<?php include("includes/footer.php"); ?>