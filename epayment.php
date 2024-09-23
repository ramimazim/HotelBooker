<?php
require('dbconnect.php');
session_start();
$userid = $_SESSION['userid'];
$initialsql = "SELECT * FROM `users` WHERE `USERID` = '$userid'";
$result = mysqli_query($conn, $initialsql);
$data1 = $_GET['bid']??'';
$data2 = $_GET['cost']??'';
$bookingid=htmlspecialchars($data1);
$cost=htmlspecialchars($data2);
$pmethod = "E";
if(isset($_POST['cost'])){
    $cost=$_POST['cost'];
}

if ($result === false) {
    exit("Error: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$ewallbal= $row["E-Wallet_bal"];
$button_label = 'Proceed with Payment';
$error_message='';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date_paid = $_POST['date'];
    $bookingid=$_POST['bid'];
    $cost=$_POST['cost'];
    $sufficiency= $ewallbal>=$cost;
    if (!$sufficiency) {
        $error_message = 'Insufficient balance. Please increase your e-wallet balance.';
    } else {

        $sql = "INSERT INTO payment (`date_paid`, `pmethod`, `credit_card`, `cost`, `uid`, `bid`) 
        VALUES ('$date_paid', '$pmethod', 'NULL', '$cost', '$userid', '$bookingid')";
        $result =mysqli_query($conn,$sql);
        if ($result=== TRUE) {
            $upd="UPDATE `bookings` SET `status` = 'Completed' WHERE `bookings`.`BOOKINGID` = '$bookingid'";
            $res=mysqli_query($conn,$upd);
            header("Location: ereceipt.php?cost=$cost");
            exit();
        }
    };

}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="ecpayment.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <title>HotelBooker</title>
</head>
<body>
    <div class="overlay"></div>
    <a href="home.php">
        <h1>HotelBooker</h1>
    </a>
    <h2 style="text-align: center;font-size:65px;color:white;">E-Payment</h2>
    <form class="form-container" action="epayment.php" method="POST" style="text-align: center;">

        <div class="form-group">
            <label for="date">Date Paid:</label>
            <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" readonly required>
        </div>

        <div class="form-group">
            <label for="cost">Booking ID</label>
            <input type="text" id="cost" name="bid" value="<?php echo $bookingid; ?>" readonly required>
        </div>

        <div class="form-group">
            <label for="cost">Cost</label>
            <input type="text" id="cost" name="cost" value="<?php echo $cost; ?>" readonly required>
        </div>
        
        <?php if ($error_message): ?>
            <?php header("Location: increase.php?bid=$bookingid&cost=$cost")?>
        <?php endif; ?>

        <input type="submit" value="<?php echo $button_label; ?>">

    </form>
</body>
</html>

