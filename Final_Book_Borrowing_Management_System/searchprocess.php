<?php
$title = $_REQUEST['title'];
$author = $_REQUEST['author'];
$date = $_REQUEST['date'];
echo " Book title is {$title}<br/> And Author is {$author}<br/>  Borrowing date is {$date} ";


session_start();


function checkBorrowing($id, $username) {
    
    if (isset($_COOKIE['borrow_data'])) {
        $borrowData = json_decode($_COOKIE['borrow_data'], true);
        if ($borrowData['id'] === $id && $borrowData['username'] === $username) {
            $lastBorrowTime = $borrowData['timestamp'];
            $currentTime = time();
            $sevenDaysInSeconds = 7 * 24 * 60 * 60;
            
            if (($currentTime - $lastBorrowTime) < $sevenDaysInSeconds) {
                return true; 
            }
        }
    }
    return false; 
}
function setBorrowCookie($id, $username) {
    $borrowData = [
        'id' => $id,
        'username' => $username,
        'timestamp' => time()
    ];
    setcookie('borrow_data', json_encode($borrowData), time() + (7 * 24 * 60 * 60), "/"); 
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $date = $_POST['date'];


    
    if (empty($title) || empty($author) || empty($date)) {
        $error = "ID and Username are required.";
    } else {
        if (checkBorrowing($title, $author,$date)) {
            $message = "Please wait 7 days before borrowing again with the same ID and username.";
        } else {
            setBorrowCookie($title, $author,$date);
            $message = "You have successfully login!";
        }
    }
}
if (isset($error)) {
    echo "<p style='color: red;'>$error</p>";
}

if (isset($message)) {
    echo "<p style='color: red;'>$message</p>";
}

    
?>
