<?php
    @include("dbconnect.php");
    session_start();

    $userid = $_SESSION['userid'];
    $sql = "SELECT Name from users WHERE USERID = $userid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $name = $row["Name"]; 

    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        if ((isset($_POST["action"])) && $_POST["action"]== "logout") {
            session_destroy();
            header("Location: home.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="dashboard.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
        <title>HotelBooker</title>
    </head>
    <body>
        <a href="home.php">
            <h1>HotelBooker</h1>
        </a>
        <h2><?php echo "Welcome ". $name; ?></h2>

        <nav class="primNav">
                <table>
                    <tr>
                        <th><a href="hotels.php">Hotels</a></th>
                        <th><a href="all_bookings.php">Bookings</a></th>
                        <!-- <th><a href="reviews.php">Reviews</a></th> -->
                    </tr>
                </table>
            </nav>

        <table>
        <?php 
            $sql = "SELECT * FROM users
            WHERE USERID = $userid";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                ?>
                <tr>
                    <th>User ID</th><td><?php echo $row["USERID"]; ?></td>
                    <th>Name</th><td><?php echo $row["Name"]; ?></td>
                </tr>
                <tr>
                    <th>Age</th><td><?php echo $row["Age"]; ?></td>
                    <th>Nationality</th><td><?php echo $row["Nationality"]; ?></td>
                <tr>
                    <th>Gender</th><td><?php echo $row["Gender"]; ?></td>
                    <th>Password</th><td><?php echo $row["Password"]; ?></td>
                </tr>
                <tr>
                    <th>Email</th><td><?php echo $row["Email"]; ?></td>
                    <th>Phone</th><td><?php echo $row["Phone"]; ?></td>
                </tr>
                <tr>
                    <th>E-Wallet_bal</th><td><?php echo $row["E-Wallet_bal"]; ?></td>
                    <th>
                    <form action="" method="POST" onsubmit="return confirm('Are you sure you want to log out?')">
                    <button type="submit" name="action" value="logout">LogOut</button>
                    </form></th><td><a href="edit.php"><button>Edit</button></a></td>
                </tr>
                <?php
                }
            }
            ?>
        </table>

        
        <div class="tabs">
            <input type="radio" class="tabs_radio" name="tabs_name" id="bookings_history" checked>
            <label for="bookings_history" class="tabs_label">Bookings History</label>
            <div class="tabs_content">
            <?php 
            $sql = "SELECT b.BOOKINGID, b.start, b.end, b.status, b.total_cost, b.room_count, b.room_type, 
            h.HOTELID, h.name AS hotel_name
            FROM bookings b
            JOIN hotels h ON b.hid = h.HOTELID
            WHERE b.uid = $userid";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                ?>
                <table>
                <tr><th>Booking ID</th><td><?php echo $row["BOOKINGID"]; ?></td></tr>
                <tr><th>Hotel Name</th><td><?php echo $row["hotel_name"]; ?></td></tr>
                <tr><th>Start</th><td><?php echo $row["start"]; ?></td></tr>
                <tr><th>End</th><td><?php echo $row["end"]; ?></td></tr>
                <tr><th>Status</th><td><?php echo $row["status"]; ?></td></tr>
                <tr><th>Cost</th><td><?php echo $row["total_cost"]; ?></td></tr>
                <tr><th>Room Count</th><td><?php echo $row["room_count"]; ?></td></tr>
                <tr><th>Room Type</th><td><?php echo $row["room_type"]; ?></td></tr>
                </table>
                <?php
                }
                } else {
                echo "No bookings made.";
                }
                ?>
                </div>
                <input type="radio" class="tabs_radio" name="tabs_name" id="reviews_history">
                <label for="reviews_history" class="tabs_label">Review History</label>
                <div class="tabs_content">
                        <?php 
                        $sql = "SELECT r.REVIEWID, r.stars, r.text, h.name AS hotel_name
                        FROM reviews r
                        JOIN hotels h ON r.hid = h.HOTELID
                        WHERE r.uid = $userid";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                        ?>
                        <table>
                        <tr><th>Review ID</th><td><?php echo $row["REVIEWID"]; ?></td></tr>
                        <tr><th>Hotel Name</th><td><?php echo $row["hotel_name"]; ?></td></tr>
                        <tr><th>Stars</th><td><?php echo $row["stars"]; ?></td></tr>
                        <tr><th>Text</th><td><?php echo $row["text"]; ?></td></tr>
                        </table>
                        <?php
                            }
                        } else {
                            echo "No reviews given.";
                        }
                        ?>
                </div>
            </div>
    </body>

    <footer>
        <hr>
        Copyright &copy; HotelBooker 2024
        <p class="sticky"><a href="#top"><button>Back to Top</button></a></p>
    </footer>
