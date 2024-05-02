<!-- view_hourly_report.php -->
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

    // Get parameters from the form
    $date = $_GET['date'];
    $start_hour = $_GET['start_hour'];
    $end_hour = $_GET['end_hour'];
    $station_name = $_GET['station_name'];

    // Construct the SQL query
    $sql = "SELECT * FROM gauge_data WHERE 
            gauge_collected_date = '$date' AND 
            gauge_collected_time >= '$start_hour:00:00' AND 
            gauge_collected_time <= '$end_hour:59:59' AND 
            station_name = '$station_name'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Output data in a table
        echo "<table border='1'>";
        echo "<tr><th>Gauge ID</th><th>River Basin</th><th>Tributary</th><th>Station Name</th><th>Alert Level</th><th>Minor Flood Level</th><th>Major Flood Level</th><th>Current Gauge Level</th><th>Remarks</th><th>Gauge Collected Date</th><th>Gauge Collected Time</th><th>Gauge Collected Person</th><th>Gauge Entered Person</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["gauge_id"]."</td>";
            echo "<td>".$row["river_basin"]."</td>";
            echo "<td>".$row["tributary"]."</td>";
            echo "<td>".$row["station_name"]."</td>";
            echo "<td>".$row["alert_level"]."</td>";
            echo "<td>".$row["minor_flood_level"]."</td>";
            echo "<td>".$row["major_flood_level"]."</td>";
            echo "<td>".$row["current_gauge_level"]."</td>";
            echo "<td>".$row["remarks"]."</td>";
            echo "<td>".$row["gauge_collected_date"]."</td>";
            echo "<td>".$row["gauge_collected_time"]."</td>";
            echo "<td>".$row["gauge_collected_person_name"]."</td>";
            echo "<td>".$row["gauge_entered_person_name"]."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No data found for the selected parameters.";
    }

    // Close connection
    $conn->close();
?>
