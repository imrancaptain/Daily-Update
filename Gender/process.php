<!DOCTYPE html>
<html lang="en">
<head>
    <title>gender</title>
</head>
<body>
    <?php
        // COOKIE
        $cookie_name = "gender";

             if (isset($_POST['submit'])){   
            $cookie_value = $_POST['gender'];
            setcookie($cookie_name, $cookie_value, time() + 10);
                header("Location:http://localhost/Gender/process.php");
        
        }
          
          
             if (isset($_COOKIE[$cookie_name])) {
            if (count($_COOKIE) > 0) {  
                echo "Gender set to <br> <p style=\"color:red\">".$_COOKIE[$cookie_name]."</p>";
            }
        }
    ?>

    <?php
        // SESSION
        session_start();
        if (isset($_POST['submit'])){
        $_SESSION['uname'] = $_POST['username'];
        } 
        if (count($_SESSION)>0) {
          
            echo "<br>Hello <br> <p style=\"color:red\"> ".$_SESSION['uname']."</p>";
        
    }

    ?>
        <br>
        <a href="http://localhost/Gender/process.php">REFRESH </a>
        <br>
        <a href="http://localhost/Gender/logout.php">LOGOUT</a>
</body>
</html>