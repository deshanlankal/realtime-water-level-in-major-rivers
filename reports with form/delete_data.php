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

    // ID parameter is set
    $id = $_GET['id'];

    // Perform delete operation
    $sql = "DELETE FROM gauge_data WHERE `gauge_data`.`gauge_id` = $id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['message' => 'Row deleted successfully.']);
    } else {
        echo json_encode(['error' => 'Error deleting row: ' . $conn->error]);
    }

    // Close connection
    $conn->close();
} else {
    // If ID parameter is not set, respond with an error message
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'ID parameter is missing.']);
}
?>
