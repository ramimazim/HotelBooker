<?php
require_once 'dbconnect.php';
session_start();

$uid = $_SESSION["userid"];
$username = $conn->query("SELECT name FROM users WHERE userid = $uid")->fetch_assoc()['name'];
$user_mail = $conn->query("SELECT email FROM users WHERE userid = $uid")->fetch_assoc()['email'];
if (isset($_GET['hid'])) {
    // Retrieve the hotel ID from the GET request
    $hotel_id = $_GET['hid'];
}
if (isset($_POST['hid'])) {
    // Retrieve the hotel ID from the POST request
    $hotel_id = $_POST['hid'];
}

$sql = "SELECT name, city, country, single, dbl, suite FROM hotels where HOTELID = $hotel_id";
$result=mysqli_query($conn,$sql);
$arr = mysqli_fetch_assoc($result);
$hotelName = $arr['name'];
$hotelCountry = $arr['country'];
$hotelCity = $arr['city'];
$single_price = $arr['single'];
$double_price = $arr['dbl'];
$suite_price = $arr['suite'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $room_type = $_POST['hotel'];
    $room_count = $_POST['option']; // Ensure it's an integer
    $userid = $_SESSION['userid']; // Assuming you have a session with the user ID
    // $single_price = 15;
    // $double_price = 20;
    // $suite_price = 30;
    $room_price = null;

    switch ($room_type) {
        case 'single':
            $room_price = $single_price;
            break;
        case 'double':
            $room_price = $double_price;
            break;
        case 'suite':
            $room_price = $suite_price;
            break;
        default:
            $room_price = 0; // Fallback in case of an unknown room type
            break;
    }



    $check_in_date = new DateTime($check_in);
    $check_out_date = new DateTime($check_out);
    $interval = $check_in_date->diff($check_out_date);
    $days_stayed = $interval->days;
    $total_cost = $room_count * $days_stayed * $room_price;


    $insert_sql = "INSERT INTO bookings (start, end, uid, hid, room_type, room_count, total_cost) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("ssiisii", $check_in, $check_out, $uid, $hotel_id, $room_type, $room_count, $total_cost);


        // Execute the statement
        if ($stmt->execute()) {
            echo "Booking successfully created!";
            
        } else {
            echo "Error: " . $stmt->error;
        }


    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings Page</title>
    <link rel="stylesheet" type="text/css" href="pending_bookings.css">
</head>
<body>
    <div class="hoteldata">
        <h1>Thank You for choosing <?= "{$hotelName}!" ?></h1><br><br>
        <h3>User info:</h3>
        <p>Username: <span class="user_span"><?="{$username}"?></span></p>
        <p>E-mail: <span class="mail_span"><?="{$user_mail}"?></span></p>
        <h3>Hotel info:</h3>
        <p>Hotel Name: <span class="name_span"><?="{$hotelName}"?></span></p>
        <p>Hotel City: <span class="city_span"><?="{$hotelCity}"?></span></p>
        <p>Hotel Country: <span class="country_span"><?="{$hotelCountry}"?></span></p><br><br><br>
    </div>

    <div class="booking-form-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <h2>Booking options:</h2>
            <label id="roomtype">Check-In:</label>
            <input type="date" name="check_in" id="check_in">
            <label id="roomtype">Check-Out:</label>
            <input type="date" name="check_out" id="check_out">

            <label id="roomtype">Room Type:</label>
            <div class="room-types">
                <input type="radio" name="hotel" id="room_single" value="single" checked>
                <label for="room_single">Single</label>
                <input type="radio" name="hotel" id="room_double" value="double">
                <label for="room_double">Double</label>
                <input type="radio" name="hotel" id="room_suite" value="suite">
                <label for="room_suite">Suite</label>
            </div>

            <label for="option">No of Rooms:</label>
            <select id="option" name="option" class="styled_select">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

            <p>*Maximum hotel rooms in a single booking is limited to five</p>

            <div class="booking-info">
                <input type="hidden" name="hid" value="<?php echo $hotel_id; ?>">
                <!-- <input type="submit" name="b_submit" id="submit_booking" value="Submit"> -->
                <button type="submit" name="hid" value="<?php echo $hotel_id; ?>">Confirm</button>
            </div>
        </form>
        <form action="all_bookings.php"  method="GET">
            <div class="booking-info">
                <button type="submit" name="hid" value="<?php echo $row['HOTELID']?>">All Bookings</button>
            </div>
        </form>
    </div>
</body>
</html>
