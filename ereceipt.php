<?php
require('dbconnect.php');
session_start();
$userid = $_SESSION['userid'];
$initialsql = "SELECT * FROM `users` WHERE `USERID` = '$userid'";
$result = mysqli_query($conn, $initialsql);
$cost= $_GET['cost'];

if ($result === false) {
    exit("Error: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$ewallbal= $row["E-Wallet_bal"];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date_paid = $_POST['date'];
    $ewallbal=$ewallbal-$cost;
    header('Location: home.php');

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
    <h2 style="text-align: center;font-size:65px;color:white;">Thank you for booking</h2>
    <form class="form-container" action="receipt.php" method="POST" style="text-align: center;">

        <div class="form-group">
            <label for="date">Date Paid:</label>
            <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" readonly required>
        </div>

        <div class="form-group">
            <label for="message">Your payment is successful!</label>
            
        </div>

        <div class="form-group">
            <label for="balance">Current balance:</label>
            <input type="text" id="cost" name="cost" value="<?php echo $ewallbal-$cost; ?>" readonly required>
        </div>

        <a href="home.php">Go Home</a>

    </form>
</body>
</html>
