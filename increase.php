<?php
require('dbconnect.php');
session_start();
$userid = $_SESSION['userid'];
$initialsql = "SELECT * FROM `users` WHERE `USERID` = '$userid'";
$result = mysqli_query($conn, $initialsql);
$cost=$_GET['cost'];
$bookingid=$_GET['bid'];

if ($result === false) {
    exit("Error: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$ewallbal= $row["E-Wallet_bal"];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ccard=$_POST['ccard'];
    $increase = $_POST['increase'];
    $newbal=$ewallbal+$increase;
    $cost=$_POST['cost'];
    $bookingid=$_POST['bid'];

    $update= "UPDATE `users` SET `E-Wallet_bal` = $newbal WHERE `USERID` = $userid";
    $result = mysqli_query($conn, $update);
    
    if ($result===TRUE) {
        header("Location: epayment.php?bid=$bookingid&cost=$cost");
        exit();
    } else {
        exit("Error updating balance: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="payment.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <title>HotelBooker</title>
</head>
<body>
    <div class="overlay"></div>
    <a href="home.php">
        <h1>HotelBooker</h1>
    </a>
    <h2 style="text-align: center;font-size:65px;color:white;">E-Payment</h2>
    <form class="form-container" action="increase.php" method="POST" style="text-align: center;">
        <div class="form-group">
            <label for="ccard">Credit Card</label>
            <input type="text" id="ccard" name="ccard" required 
               pattern="\d{16}" title="Credit card must be exactly 16 digits" 
               minlength="16" maxlength="16">
               <div class="form-group">
            <label for="cost">Booking ID</label>
            <input type="text" id="cost" name="bid" value="<?php echo $bookingid; ?>" readonly required>
        </div>

        <div class="form-group">
            <label for="cost">Cost</label>
            <input type="text" id="cost" name="cost" value="<?php echo $cost; ?>" readonly required>
        </div>

        <div class="form-group">
            <label for="increase">Increase amount</label>
            <input type="int" id="increase" name="increase" placeholder="Insert amount" required>
        </div>

      <input type="submit" value="Go Back">

    </form>
</body>
</html>