<?php
$account= $_REQUEST['account'];
$transportation = $_REQUEST['transportation'];
$food= $_REQUEST['food'];
$shop= $_REQUEST['shopping'];
$currentvalue= $_REQUEST['currentvalue'];
$previousvalue= $_REQUEST['previousvalue'];
$balance= $_REQUEST['balance'];
$loan= $_REQUEST['loan'];

echo "Account is : $account <br/> And Total Transportation Cost is : {$transportation} <br/> Total Food Cost is : {$food} <br/> Total Shopping Cost is : {$shop} <br/>Current Value is : {$currentvalue} <br/>Previous Value is : {$previousvalue} <br/>Balance is : {$balance} <br/>Loan is : {$loan} <br/>";
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
    $account= $_REQUEST['account'];
    $transportation = $_REQUEST['transportation'];
    $food= $_REQUEST['food'];
    $shop= $_REQUEST['shopping'];
    $totalcost= $_REQUEST['totalcost'];
    $currentvalue= $_REQUEST['currentvalue'];
    $previousvalue= $_REQUEST['previousvalue'];
    $balance= $_REQUEST['balance'];
    $loan= $_REQUEST['loan'];

    
    if (empty($account) || empty($transportaion)|| empty($food)|| empty($shop)|| empty($totalcost)|| empty($currentvalue)|| empty($previousvalue)|| empty($balance)|| empty($loan)){
        $error = "ID and Username are required.";
    } else {
        if (checkBorrowing($account, $transportaion,$food,$shop,$totalcost,$currentvalue,$previousvalue,$balance,$loan)) {
            $message = "Please wait 7 days before borrowing again with the same ID and username.";
        } else {
            setBorrowCookie($account, $transportaion,$food,$shop,$totalcost,$currentvalue,$previousvalue,$balance,$loan);
            $message = "Account Cost Details!";
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
