<?php
    @include("dbconnect.php");
    session_start();

    $userid = $_SESSION['userid'];

    $res = "";

    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        if ((isset($_POST["action"])) && $_POST["action"]== "submit") {
            $name = htmlspecialchars($_POST['Name']);
            $age = intval($_POST['Age']);
            $nationality = htmlspecialchars($_POST['Nationality']);
            $gender = htmlspecialchars($_POST['Gender']);
            $email = filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL);
            $phone = htmlspecialchars($_POST['Phone']);

            $sql = "UPDATE users SET Name='$name', Age=$age, Nationality='$nationality', Gender='$gender', Email='$email', Phone='$phone' WHERE USERID=$userid";

            if (mysqli_query($conn, $sql)) {
                $res = "Information Updated Successfully!";
            } else {
                $res = "No Changes Made.";
            }
        } elseif (isset($_POST["action"]) && $_POST["action"] == "delete") {
            // Deleting bookings, reviews, payment
            $sql = "DELETE FROM bookings where uid = $userid";
            mysqli_query($conn,$sql);
            $sql = "DELETE FROM reviews where uid = $userid";
            mysqli_query($conn,$sql);
            $sql = "DELETE FROM payment where uid = $userid";
            mysqli_query($conn,$sql);

            $name = "";
            $age = "";
            $nationality = "";
            $gender = "";
            $email = "";
            $phone = "";

            // Deleting user
            $sql = "DELETE FROM users where USERID = $userid";
            if (mysqli_query($conn,$sql)) {
                $res = "User Deleted Succesfully";
                header("Location: home.php");
                exit();
            } else {
                $res = "Error on deleting user.";
            }
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
        <nav class="primNav">
                <table>
                    <tr>
                        <th><a href="hotels.php">Hotels</a></th>
                        <th><a href="bookings.php">Bookings</a></th>
                        <!-- <th><a href="reviews.php">Reviews</a></th> -->
                    </tr>
                </table>
            </nav>
        <h2>Edit your info below</h2>
        <form method="POST" action="">
        <table>
        <?php 
            $sql = "SELECT * FROM users
            WHERE USERID = $userid";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                ?>
                <tr><th>User ID</th><td><?php echo $row["USERID"]; ?></td></tr>
                <tr>
                    <th>Name</th>
                    <td><input type="text" name="Name" value="<?php echo $row["Name"]; ?>"></td>
                </tr>
                
                <tr>
                    <th>Age</th>
                    <td><input type="text" name="Age" value="<?php echo $row["Age"]; ?>"></td>
                </tr>
                
                <tr>
                    <th>Nationality</th>
                    <td><input type="text" name="Nationality" value="<?php echo $row["Nationality"]; ?>"></td>
                </tr>
                
                <tr>
                    <th>Gender</th>
                    <td><input type="text" name="Gender" value="<?php echo $row["Gender"]; ?>"></td>
                </tr>
                
                <tr>
                    <th>Password</th>
                    <td><input type="text" name="Password" value="<?php echo $row["Password"]; ?>"></td>
                </tr>
                
                <tr>
                    <th>Email</th>
                    <td><input type="text" name="Email" value="<?php echo $row["Email"]; ?>"></td>
                </tr>
                
                <tr>
                    <th>Phone</th>
                    <td><input type="text" name="Phone" value="<?php echo $row["Phone"]; ?>"></td>
                </tr>
                
                <tr><th>E-Wallet_bal</th><td><?php echo $row["E-Wallet_bal"]; ?></td></tr>
                <tr>
                
                
                <?php
                }
            }
            ?>
        </table>
            <button type="submit" name="action" value="submit">Submit</button>
            <!-- <button type="submit" name="action" value="delete">Delete User</button> -->
        </form>
        <form action="" method="POST" onsubmit="return confirm('Are you sure you want delete your account and all associated information?')">
            <button type="submit" name="action" value="delete">Delete User</button>
        </form>

        <?php if ($res): ?>
        <p style="color: green; text-align: center; margin-top: 20px;"><?php echo $res; ?></p>
        <?php endif; ?>

        <?php $res = ""?>

    </body>

    <hr>
    
    <footer>
        <hr>
        Copyright &copy; HotelBooker 2024
        <p class="sticky"><a href="#top"><button>Back to Top</button></a></p>
    </footer>
