<?php
require_once 'dbconnect.php';
session_start();

$uid = $_SESSION["userid"];
$username = $conn->query("SELECT name FROM users WHERE userid = $uid")->fetch_assoc()['name'];
$user_mail = $conn->query("SELECT email FROM users WHERE userid = $uid")->fetch_assoc()['email'];

if (isset($_GET['bid'])) {

    $booking_id = $_GET['bid'];
}

$sql1 = "select hid, room_type from bookings where bookingid = $booking_id";
$result1=mysqli_query($conn,$sql1);
$arr1 = mysqli_fetch_assoc($result1);
$hotel_id = $arr1['hid'];

$sql2 = "SELECT name FROM hotels where HOTELID = $hotel_id";
$result2=mysqli_query($conn,$sql2);
$arr2 = mysqli_fetch_assoc($result2);
$hotelName = $arr2['name'];


// echo $booking_id;
// //for All bookings page
// $sql2 = "SELECT users.userid, users.name, users.email, bookings.bookingid, bookings.start, bookings.end, bookings.status, bookings.total_cost, bookings.room_count, bookings.room_type, hotels.name, hotels.country, hotels.city FROM users INNER JOIN bookings ON users.userid = bookings.uid INNER JOIN hotels ON bookings.hid = hotels.hotelid WHERE users.userid = $uid";
// $result2 = $conn->query($sql2);






$message = '';  // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $stars_review = $_POST['option'];
    $user_review = $_POST['review'];

    $insert_sql = "INSERT INTO reviews (stars, text, uid, hid, bid) VALUES ('$stars_review', '$user_review', '$uid', '$hotel_id', '$booking_id')";

    if ($conn->query($insert_sql) === TRUE) {
        null;
    } else {
        echo "Error: " . $stmt->error;
    }
}




//     $check_in_date = new DateTime($check_in);
//     $check_out_date = new DateTime($check_out);
//     $interval = $check_in_date->diff($check_out_date);
//     $days_stayed = $interval->days;
//     $total_cost = $room_count * $days_stayed * $room_price * $hotel_multiplier;


    $insert_sql = "INSERT INTO bookings (start, end, uid, hid, room_type, room_count, total_cost) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("ssiisii", $check_in, $check_out, $uid, $hotel_id, $room_type, $room_count, $total_cost);


//         // Execute the statement
//         if ($stmt->execute()) {
//             echo "Booking successfully created!";
            
//         } else {
//             echo "Error: " . $stmt->error;
//         }


//     }



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link rel="stylesheet" href="reviews.css">
</head>
<body>
    
    <div class="card">
        <h1>Write Your review for <?= "{$hotelName}" ?></h1>
        <h2>Username: <?= "{$username}" ?></h2>
        <h2>Booking ID: <?= "{$booking_id}"?></h2>
        <form action="#" method="POST">
            <label for="option" name="option" >Star Rating: </label>
            <select id="option" name="option" class="styled_select">
                <option  value="1">★: Bad</option>
                <option  value="2">★★: Okayish</option>
                <option  value="3">★★★: Good</option>
                <option  value="4">★★★★: Great</option>
                <option  value="5">★★★★★: Perfect</option>
            </select><br>
            <label for="name">Your Review:</label>
            <input type="text" id="review" name="review" placeholder="Type your experience!">
            <button type="submit">Submit</button><br>
        </form>
        <a href="home.php"><button type="submit">Go Home</button></a>
    </div>
</body>
</html>