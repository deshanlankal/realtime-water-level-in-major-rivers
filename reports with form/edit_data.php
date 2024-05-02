<!-- edit_data.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gauge Data</title>
</head>
<body>
    <h2>Edit Gauge Data</h2>
    <?php
    // Check if ID parameter is set
    if (isset($_GET['id'])) {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "try";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch gauge data based on ID
        $id = $_GET['id'];
        $sql = "SELECT * FROM gauge_data WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            $row = $result->fetch_assoc();
            ?>
            <form action="update_data.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="river_basin">River Basin:</label>
                <input type="text" id="river_basin" name="river_basin" value="<?php echo $row['river_basin']; ?>" required>
                <!-- Other form fields for editing the gauge data -->
                <input type="submit" value="Update">
            </form>
            <?php
        } else {
            echo "No gauge data found for ID: " . $id;
        }

        // Close connection
        $conn->close();
    } else {
        // If ID parameter is not set, display an error message
        echo "ID parameter is missing.";
    }
    ?>
</body>
</html>
