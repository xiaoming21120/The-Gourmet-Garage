<?php
// Define database connection details
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "gourmet_garage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $persons = htmlspecialchars(trim($_POST['persons']));
    $date = htmlspecialchars(trim($_POST['date']));
    $time = htmlspecialchars(trim($_POST['time']));
    $message = htmlspecialchars(trim($_POST['message']));

    try {
        $stmt = $conn->prepare("INSERT INTO reservations (name, phone, persons, date, time, message) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisss", $name, $phone, $persons, $date, $time, $message);
        $stmt->execute();
        echo "Reservation made successfully!";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();

// admin_login.php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "gourmet_garage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($_POST['password'], $row['password'])) {
                echo "Login successful!";
            } else {
                echo "Invalid password!";
            }
        } else {
            echo "Invalid username!";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
?>