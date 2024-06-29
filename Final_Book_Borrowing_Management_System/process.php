<?php
$id = $_REQUEST['student'];
$name = $_REQUEST['name'];

echo "My id is $id <br/> And My name is {$name}";


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
    $id = $_POST['student'];
    $username = $_POST['name'];

    
    if (empty($id) || empty($username)) {
        $error = "ID and Username are required.";
    } else {
        if (checkBorrowing($id, $username)) {
            $message = "Please wait 7 days before borrowing again with the same ID and username.";
        } else {
            setBorrowCookie($id, $username);
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
