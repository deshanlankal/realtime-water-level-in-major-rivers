<?php
// Connect to your database
$servername = "localhost";
$username = "root"; // Replace with your username
$password = ""; // Replace with your password
$dbname = "try"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $river_basin = $conn->real_escape_string($_POST['river_basin']);
    $tributary = $conn->real_escape_string($_POST['tributary']);
    $station_name = $conn->real_escape_string($_POST['station_name']);
    $alert_level = $conn->real_escape_string($_POST['alert_level']);
    $minor_flood_level = $conn->real_escape_string($_POST['minor_flood_level']);
    $major_flood_level = $conn->real_escape_string($_POST['major_flood_level']);
    $current_gauge_level = $conn->real_escape_string($_POST['current_gauge_level']);
    $remarks = $conn->real_escape_string($_POST['remarks']);
    $gauge_collected_date = $conn->real_escape_string($_POST['gauge_collected_date']);
    $gauge_collected_time = $conn->real_escape_string($_POST['gauge_collected_time']);
    $gauge_collected_person_name = $conn->real_escape_string($_POST['gauge_collected_person_name']);
    $gauge_entered_person_name = $conn->real_escape_string($_POST['gauge_entered_person_name']);

    // Insert data into database
    $sql = "INSERT INTO gauge_data (river_basin, tributary, station_name, alert_level, minor_flood_level, major_flood_level, current_gauge_level, remarks, gauge_collected_date, gauge_collected_time, gauge_collected_person_name, gauge_entered_person_name)
    VALUES ('$river_basin', '$tributary', '$station_name', '$alert_level', '$minor_flood_level', '$major_flood_level', '$current_gauge_level', '$remarks', '$gauge_collected_date', '$gauge_collected_time', '$gauge_collected_person_name', '$gauge_entered_person_name')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
