<?php
    require_once('dbconnect.php');
    session_start();
    $result=null;
    if(isset($_GET['submit'])){
        $hname=$_GET['hotel_name'];
        $sql="SELECT * from hotels where Name like '%$hname%' order by stars desc";
        $result=mysqli_query($conn,$sql);
    }
    if(isset($_GET['submi'])){
        $hcity=$_GET['cit'];
        $hcountry=$_GET['countr'];
        $minp=$_GET['price_range-min'];
        $maxp=$_GET['price_range-max'];
        if($minp==null){
            $minp=0;
        }
        if ($maxp==null){
            $maxp=PHP_INT_MAX;
        }
        $sql="SELECT * from hotels where city like '%$hcity%' and country like '%$hcountry%' and single>='$minp' and suite<='$maxp' order by stars desc";
        $result=mysqli_query($conn,$sql);
    }
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="hotels.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <title>HotelBooker</title>
</head>
<body>
    <div class="overlay"></div>
    <a href="home.php">
        <h1>HotelBooker</h1>
    </a>
    <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <form action="hotels.php" method="GET">
        <section class="search-bar">
            <input type="text" name="hotel_name" placeholder="Search for hotels...">
            <button type="submit" name="submit">Search</button>
        </section>
        <section class="filters">
            <h2>Filters</h2>
            <input type="text" name="cit" placeholder="Enter City" class="filter-input">
            <input type="text" name="countr" placeholder="Enter Country" class="filter-input">
            <input type="text" name="price_range-min" class="price-range-min" placeholder="Min Price">
            <input type="text" name="price_range-max" class="price-range-min" placeholder="Max Price">
            <button type="submit" name="submi">Filter</button>
        </section>
    </form>
        <section class="hotel-listings">
            <?php
            if($result==null){
                $sql="SELECT * from hotels order by stars desc";
                $result=mysqli_query($conn,$sql);
            }
                while($row=mysqli_fetch_assoc($result)){
            ?>
            <div class="hotel-card">
                <div class="hotel-info">
                    <h3>Hotel Name: <?php echo $row['Name']?></h3>
                    <p>City: <?php echo $row['city']?></p>
                    <p>Country: <?php echo $row['country']?></p>
                    <p>Rating: <?php echo $row['stars']?></p>
                    <p style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Prices per night</p>
                    <p>Single: $<?php echo $row['single']?></p>
                    <p>Double: $<?php echo $row['dbl']?></p>
                    <p>Suite: $<?php echo $row['suite']?></p>
                </div>
                <form action="pending_bookings.php"  method="GET">
                    <div class="booking-info">
                        <input type="hidden" name="hid" value="<?php echo $row['HOTELID']?>">
                        <button type="submit" name="hid" value="<?php echo $row['HOTELID']?>">Book Now</button>
                    </div>
                </form>
            </div>
            <?php
                } 
            ?>
        </section>
    </main>

    <footer>
        <p>Follow us on social media</p>
        <p>Contact us at: mohammad.hoque1000@gmail.com</p>
    </footer>
</body>