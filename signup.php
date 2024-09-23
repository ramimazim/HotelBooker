<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <title>HotelBooker</title>
</head>
<body>
    <div class="overlay"></div>
    <a href="home.php">
        <h1>HotelBooker</h1>
    </a>
    <h2 style="text-align: center;font-size:65px;color:white;">Sign Up</h2>
    <form class="form-container" action="signup.php" method="POST" style="text-align: center;">

        <div class="form-group">
            <label for="name">Name</label>
            
            <input type="text" id="name" name="name" placeholder="Insert full name" required>
        </div>

        <div class="form-group">
            <label for="age">Age</label>
            
            <input type="text" id="age" name="age" placeholder="Insert age" required>
        </div>  
        
        <div class="form-group">
            <label for="nation">Nationality</label>
            <input type="text" id="nation" name="nation" placeholder="Insert nationality" required>
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select id="gender" name="gender" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Insert email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Insert Password" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" placeholder="Insert phone number" required>
        </div>
        <input type="submit" value="Sign Up">
    </form>
</body>
</html>

<?php
require('dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $nation = $_POST['nation'];
    $gender = ($_POST['gender']);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];


    $sql = "INSERT INTO users (`Name`, `Age`, `Nationality`, `Gender`, `Email`, `Password`, `Phone`, `E-Wallet_bal`) 
        VALUES ('$name', '$age', '$nation', '$gender', '$email', '$password', '$phone', 0)";
    $result =mysqli_query($conn,$sql);

    if ($result=== TRUE) {
        header('Location: home.php');
    }
    else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

