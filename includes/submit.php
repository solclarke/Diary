<?php
    include("includes/connection.php");

    if (!$_POST['name'] AND $_POST['submit'] == "Sign Up!") {
        $error .= "A name is required<br>";
    } else {
        // if name isn't valid
        $name = $_POST["name"];
        if(!preg_match('/^[a-zA-Z\s]+$/', $name) AND $_POST['submit'] == "Sign Up!") {
            $error .= "Name must be letters and spaces only<br>";
        }
    }

    if (!$_POST['email']) {
        $error .= "An email address is required<br>";
    } else {
        $email = $_POST['email'];
    }

    if (!$_POST['password']) {
        $error .= "A password is required<br>";
    } else {
        $password = $_POST['password'];
    }

    if ($error != "") {
        $error = "<p>There were error(s) in your form:</p>".$error;
        
    } else {
        
        if ($_POST['signUp'] == '1') {
            
            $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) > 0) {
                $error = "That email address is taken.";

            } else {
                $query = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['name'])."', '".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";

                if (!mysqli_query($link, $query)) {
                    $error = "<p>Could not sign you up - please try again later.</p>";

                } else {

                    $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
                    $id = mysqli_insert_id($link);
                    mysqli_query($link, $query);
                    
                    $_SESSION['id'] = $id;

                    if ($_POST['stayLoggedIn'] == '1') {

                        setcookie("id", $id, time() + 60*60*24*365);
                    } 
                        
                    header("Location: loggedinpage.php");
                }
            } 
            
        } else {
                
                $query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
                $result = mysqli_query($link, $query);
                $row = mysqli_fetch_array($result);
            
                if (isset($row)) {
                    
                    $hashedPassword = md5(md5($row['id']).$_POST['password']);
                    
                    if ($hashedPassword == $row['password']) {
                        
                        $_SESSION['id'] = $row['id'];
                        
                        if (isset($_POST['stayLoggedIn']) AND $_POST['stayLoggedIn'] == '1') {

                            setcookie("id", $row['id'], time() + 60*60*24*365);
                        } 

                        header("Location: loggedinpage.php");
                            
                    } else {
                        $error = "That email/password combination could not be found.";
                    }
                } else {
                    $error = "That email/password combination could not be found.";
                }
            }
        }
?>