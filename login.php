<?php
    session_start();
?>

<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
        <title>HotelBooker</title>
    </head>
    <body>
        <div class="overlay"></div>
            <a href="home.php">
                <h1>HotelBooker</h1>
            </a>
            <h2 style="text-align: center;font-size:65px;color:white;">Login</h2>
            <form class="form-container" action="login.php" method="POST" style="text-align: center;">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Insert email" required>
                    </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Insert Password" required>
                </div>

                <input type="submit" value="Login">
            </form>
    </body>
</html>

<?php
require('dbconnect.php');

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql= "SELECT * from users where Email= '$email' and Password= '$password'";
    $result = mysqli_query($conn, $sql);
    $resultsesh=mysqli_fetch_assoc($result);
    $_SESSION["userid"] = $resultsesh["USERID"];

    if (mysqli_num_rows($result)==1){
        header("Location: dashboard.php");
        exit();
    }
    else{
        echo "<p style='color: red; text-align: center;'>Incorrect Password or Email. Please try again.</p>"; 
    }
}
    
?>