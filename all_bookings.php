<?php
require_once 'dbconnect.php';
session_start();

$uid = $_SESSION["userid"];
$username = $conn->query("SELECT name FROM users WHERE userid = $uid")->fetch_assoc()['name'];
$user_mail = $conn->query("SELECT email FROM users WHERE userid = $uid")->fetch_assoc()['email'];
// if (isset($_GET['hid'])) {
//     // Retrieve the hotel ID from the GET request
//     $hotel_id = $_GET['hid'];
// }
// if (isset($_POST['hid'])) {
//     // Retrieve the hotel ID from the POST request
//     $hotel_id = $_POST['hid'];
// }

$sql2 = "SELECT users.userid, users.name as username, users.email, bookings.bookingid, bookings.start, bookings.end, bookings.status, bookings.total_cost, bookings.room_count, bookings.room_type, hotels.name as hotelname, hotels.country, hotels.city FROM users INNER JOIN bookings ON users.userid = bookings.uid INNER JOIN hotels ON bookings.hid = hotels.hotelid WHERE users.userid = $uid";
$result2 = $conn->query($sql2);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> Bookings page</title>
        <link rel="stylesheet" type ="text/css" href="all_bookings.css">
    </head>
    <body>
    <div class="content">
        <section class="bookings-listings">
            <?php
                while($row=mysqli_fetch_assoc($result2)){
            ?>
                <div class="booking-card">
                    <div class="booking-info">
                        <h3>Booking Id: <?php echo $row['bookingid']?></h3>
                        <p>User Id: <?php echo $row['userid']?></p>
                        <p>Name: <?php echo $row['username']?></p>
                        <p>Email: <?php echo $row['email']?></p>
                        <p>Hotel: <?php echo "{$row['hotelname']}, {$row['city']}, {$row['country']}"?></p>
                        <p>Check-In: <?php echo $row['start']?></p>
                        <p>Check-Out: <?php echo $row['end']?></p>
                        <p>Confirmation Status: <?php echo $row['status']?></p>
                        <p>Total Transaction amount: <?php echo $row['total_cost']?></p>
                        <p>Room Type: <?php echo $row['room_type']?></p>
                        <p>No of Rooms: <?php echo $row['room_count']?></p>

                        <!-- <p>Price:<?php echo $row['base_price']*$row['multiplier']?> per night</p> -->
                    </div>

                    <form action="payment.php" method="get">
                        <div class="booking-info">
                            <input type="hidden" name="bid" value="<?php echo $row['bookingid']?>">
                            <input type="hidden" name="cost" value="<?php echo $row['total_cost']?>">
                            <button type="submit">Complete Payment</button>
                    </div>
                    </form>
                    <form action="reviews.php" method="get" style="display:inline;">
                        <div class="booking-info">
                            <input type="hidden" name="bid" value="<?php echo $row['bookingid']?>">
                            <button type="submit">Submit Review</button>
                        </div>
                    </form>
                            
                </div>
            <?php
                } 
            ?>
        </section>

    </div>
</html>