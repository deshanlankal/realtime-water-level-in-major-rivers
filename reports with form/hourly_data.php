<?php
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

    // Get parameters from the URL
    $stationName = $_GET['stationName'];
    $date = $_GET['date'];
    $startHour = $_GET['startHour'];
    $endHour = $_GET['endHour'];

    // Print received parameters for debugging
    echo "Station Name: " . $stationName . "<br>";
    echo "Date: " . $date . "<br>";
    echo "Start Hour: " . $startHour . "<br>";
    echo "End Hour: " . $endHour . "<br>";

    // Construct the SQL query
    $sql = "SELECT HOUR(gauge_collected_time) AS hour, AVG(current_gauge_level) AS gauge_level 
            FROM gauge_data 
            WHERE station_name = '$stationName' 
            AND DATE(gauge_collected_date) = '$date'
            AND HOUR(gauge_collected_time) BETWEEN $startHour AND $endHour
            GROUP BY HOUR(gauge_collected_time)";

    // Execute the query
    $result = $conn->query($sql);

    // Check for errors
    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    // Fetch data
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Close connection
    $conn->close();

    // Return data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
?>
