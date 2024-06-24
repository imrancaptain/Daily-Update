<?php
$id = $_REQUEST['userid'];
$username = $_REQUEST['username'];
$bookname = $_REQUEST['bookname'];
echo "Id is : $id <br/> And Username is : {$username} <br/> Book Name :{$bookname} <br/>";

function validateEmail($id) {
  
    return filter_var($id, FILTER_VALIDATE_EMAIL);
}

function validateUsername($username) {
    // Custom validation for username: alphanumeric characters and underscores, length between 3 and 20 characters
    return preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username);
}

// Example usage:
$id = "example@email.com";
$username = "user_name123";

if (validateEmail($id)) {
    echo "Id is valid.<br>";
} else {
    echo "Id is invalid.<br>";
}

if (validateUsername($username)) {
    echo "Username is valid.<br>";
} else {
    echo "Username is invalid.<br>";
}



?>