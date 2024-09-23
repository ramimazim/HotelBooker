<?php
require('dbconnect.php');
session_start();
$userid = $_SESSION['userid'];
$initialsql = "SELECT * FROM `users` WHERE `USERID` = '$userid'";
$result = mysqli_query($conn, $initialsql);
$bookingid = $_GET['bid'];
$cost= $_GET['cost'];



if ($result === false) {
    exit("Error: " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
$ewallbal= $row["E-Wallet_bal"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date_paid = $_POST['date'];
    $pmethod = $_POST['pmethod'];
    $bookingid = $_POST['bid'];
    $cost= $_POST['cost'];

    if ($pmethod == "E") {
        header("Location: epayment.php?bid=$bookingid&cost=$cost");
        exit();
    } elseif ($pmethod == "C") {
        header("Location: cpayment.php?bid=$bookingid&cost=$cost");
        exit();
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
    <h2 style="text-align: center;font-size:65px;color:white;">Payment</h2>
    <form class="form-container" action="payment.php" method="POST" style="text-align: center;">

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

        <div class="form-group">
            <label for="pmethod">Payment Method:</label>
            <select id="pmethod" name="pmethod" required>
                <option value="" disabled selected>Select Payment Method</option>
                <option value="E">E-Wallet</option>
                <option value="C">Credit Card</option>
            </select>
        </div>


        <input type="submit" value="Proceed to Payment">
    </form>
</body>
</html>



