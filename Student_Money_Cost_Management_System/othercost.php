<?php
$itemname= $_REQUEST['itemname'];

$price = $_REQUEST['price'];
$totalcost = $_REQUEST['totalcost'];
echo "Item is : $itemname<br/> price is : {$price} <br/>Total cost is : {$totalcost} <br/>";
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
    $itemname= $_REQUEST['itemname'];

$price = $_REQUEST['price'];
$totalcost = $_REQUEST['totalcost'];

    
    if (empty($itemname) || empty($price)|| empty($totalcost)) {
        $error = "ID and Username are required.";
    } else {
        if (checkBorrowing($itemname, $price,$totalcost)) {
            $message = "Please wait 7 days before borrowing again with the same ID and username.";
        } else {
            setBorrowCookie($itemname, $price,$totalcost);
            $message = "You have successfully shopping cost details!";
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
