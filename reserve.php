<?php
// Start the session
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form data
  $name = htmlspecialchars(trim($_POST['name']));
  $phone = htmlspecialchars(trim($_POST['phone']));
  $persons = htmlspecialchars(trim($_POST['persons']));
  $date = htmlspecialchars(trim($_POST['date']));
  $time = htmlspecialchars(trim($_POST['time']));
  $message = htmlspecialchars(trim($_POST['message']));

  // Validate the form data
  if (empty($name) || empty($phone) || empty($persons) || empty($date) || empty($time)) {
    echo "All fields are required!";
    exit;
  }

  // Connect to the database
  $servername = "localhost"; // Database server
  $username = "root"; // Database username
  $password = "root"; // Database password
  $dbname = "gourmet_garage"; // Database name

  // Create a connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check the connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Insert the form data into the database
  $stmt = $conn->prepare("INSERT INTO reservations (name, phone, persons, date, time, message) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssisss", $name, $phone, $persons, $date, $time, $message);

  // Execute the query
  if ($stmt->execute()) {
    echo '<link rel="stylesheet" href="style.css">';
    echo '<h1>Reservation made successfully!</h1>';
    echo '<p>Thank you for making a reservation at The Gourmet Garage.</p>';
    echo '<p>We will contact you shortly to confirm your reservation.</p>';
    echo '<p><a href="index.html">Return to the homepage</a></p>';
  } else {
    echo "Error: " . $stmt->error;
  }

  // Close the statement and connection
  $stmt->close();
  $conn->close();
} else {
  // Redirect to the reservation form if accessed directly
  header("Location: index.html");
  exit;
}
?>