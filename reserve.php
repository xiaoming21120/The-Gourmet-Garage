<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $persons = htmlspecialchars(trim($_POST['persons']));
    $date = htmlspecialchars(trim($_POST['date']));
    $time = htmlspecialchars(trim($_POST['time']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate inputs (you can add more validation as needed)
    if (empty($name) || empty($phone) || empty($persons) || empty($date) || empty($time)) {
        echo "All fields are required!";
        exit;
    }

    // Database connection
    $servername = "localhost"; // Database server
    $username = "your_username"; // Database username
    $password = "your_password"; // Database password
    $dbname = "your_database"; // Database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert reservation into the database
    $stmt = $conn->prepare("INSERT INTO reservations (name, phone, persons, date, time, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $name, $phone, $persons, $date, $time, $message);

    if ($stmt->execute()) {
        echo "Reservation made successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect to the reservation form if accessed directly
    header("Location: index.php");
    exit;
}
?>
