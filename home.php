<?php
    @include("dbconnect.php");
    session_start();

    if (isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
        $sql = "SELECT Name from users WHERE USERID = $userid";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $name = $row["Name"]; 
    } else {
        $name = false;
    }

?>

<!DOCTYPE html>
<html lang="en">
<body>

    <head>

        <meta charset="UTF-8">
        <meta name="author" content="RafatNazmulRamimRafayed">
        <meta name="description" content="Hotel Booking Website Project for Database Course">

        <title>HotelBooker</title>

        <link rel="icon" href="">
        <link rel="stylesheet" href="home.css">

    </head>

    <main>
        <header>
            <section class="top">

                <h1><a href="home.php">HotelBooker</a></h1>

                <?php
                if ($name) {
                    ?>
                    <a href="dashboard.php"><button class="but1" type="">
                    <?php echo $name; ?>
                    </button></a>
                    <?php
                } else {
                    ?><p>
                    <a href="login.php"><button type="">Login</button></a>
                    <a href="signup.php"><button type="">Register</button></a>
                    </p>
                    <?php
                }
                ?>
        
            </section>

            <hr>

            <nav class="primNav">
                <table>
                    <tr>
                        <th><a href="hotels.php">Hotels</a></th>
                        <th>
                            <?php
                             if ($name) {
                                echo '<a href="all_bookings.php">Bookings</a>';
                             } else {
                                echo '<a href="login.php">Bookings</a>';
                             } ?>
                        </th>
<!--                         <th>
                            <?php
                             if ($name) {
                                echo '<a href="reviews.php">Reviews</a>';
                             } else {
                                echo '<a href="login.php">Reviews</a>';
                             } ?>
                        </th> -->
                    </tr>
                </table>
            </nav>

            <hr>
        </header>

        <section>

            <h1>
                Explore the World comfortably with Hotel Booker
            </h1>

            <img class="img1" src="img/big.jpg" alt="Great Wall of China" title="Great Wall of China" width="800" height="400"><br>

        </section>
        <hr>
        <section>
            <h2>Check out our most popular hotels below!</h2>
            <div class="imgrid">

                <img src="img/01.jpg" alt="Hotel #1" title="Hotel#1" width="265" height="265">
                <img src="img/02.jpg" alt="Hotel #2" title="Hotel#2" width="265" height="265">
                <img src="img/03.jpg" alt="Hotel #3" title="Hotel#3" width="265" height="265">
                <img src="img/04.jpg" alt="Hotel #4" title="Hotel#4" width="265" height="265">
                <img src="img/05.jpg" alt="Hotel #5" title="Hotel#5" width="265" height="265">
                <img src="img/06.jpg" alt="Hotel #6" title="Hotel#6" width="265" height="265">
                <img src="img/07.jpg" alt="Hotel #7" title="Hotel#7" width="265" height="265">
                <img src="img/08.jpg" alt="Hotel #8" title="Hotel#8" width="265" height="265">
                <img src="img/09.jpg" alt="Hotel #9" title="Hotel#9" width="265" height="265">
                <img src="img/10.jpg" alt="Hotel #10" title="Hotel#10" width="265" height="265">

            </div>
        </section>
    </main>

    <footer>
        <hr>
        Copyright &copy; HotelBooker 2024
        <p class="sticky"><a href="#top"><button>Back to Top</button></a></p>
    </footer>
</body>
</html>