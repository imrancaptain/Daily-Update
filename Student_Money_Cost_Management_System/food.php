<?php
$date= $_REQUEST['date'];
$fooditem= $_REQUEST['fooditem'];

$price= $_REQUEST['price'];
$totalcost= $_REQUEST['totalcost'];
echo "Date  is : $date <br/>Food Item  is : $fooditem <br/> And Price is : {$price}  <br/> Total cost is : {$totalcost} <br/>";
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
    $date= $_POST['date'];
    $fooditem = $_POST['fooditem'];
    $price = $_POST['price'];
     $totalcost = $_POST['totalcost'];


    
    if (empty($date) ||empty($fooditem) ||  empty($price)|| empty($totalcost)) {
        $error = "ID and Username are required.";
    } else {
        if (checkBorrowing($date,$fooditem, $price,$totalcost)) {
            $message = "Please wait 7 days before borrowing again with the same ID and username.";
        } else {
            setBorrowCookie($date,$fooditem,$price,$totalcost);
            $message = "Food Cost Details!";
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
