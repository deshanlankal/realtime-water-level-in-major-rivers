<?php
    

    include("connection.php");

    
    if(isset($_POST["submit"])){
        
       
        $username = $_POST["username"];
        $password = $_POST["password"];

        
        $read = "SELECT * FROM users_table WHERE username = '$username' && password = '$password'";
        $query = mysqli_query($conn, $read);

        
        if(mysqli_num_rows($query) === 1) {

            $data = mysqli_fetch_assoc($query);

            switch($data['work']) {
                case 'Director':
                    header("Location: /realtime-water-level-in-major-rivers/Dashboards/director_dashboard.php");
                    exit(); 
                case 'Engineer':
                    header("Location: engineer_dashboard.php");
                    break;
                case 'Hsa':
                    header("Location: hsa_dashboard.php");
                    break;
                case 'Hsha':
                    header("Location: hsha_dashboard.php");
                    break;
                case 'Helper':
                    header("Location: helper_dashboard.php");
                    break;
                case 'IT Department':
                    header("Location: it_department_dashboard.php");
                    break;
                default:
                    echo "";
            }
            exit();
        } else {
            echo "<script>alert('Invalid username or password');</script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Irrigation Department</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="logo.png" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrappre">
        
        <form action="" method="post">
            <h1>Login</h1>
            <div class="input-box">
                
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bxs-user-pin'></i>
            </div>
            <div class="input-box">
                
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember Me</label>
                <a href="#">Forgotten account?</a>
            </div>
            <button type="submit" name="submit" class="btn">Login</button>

            <div class="info">
                <p>Irrigation Department Open System</p>
            </div>
        </form>
    </div>
</body>
</html>
