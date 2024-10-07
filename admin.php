<?php
// admin.php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "gourmet_garage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

try {
    $stmt = $conn ->prepare("SELECT * FROM reservations");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['persons'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['time'] . "</td>";
        echo "<td>" . $row['message'] . "</td>";
        echo "</tr>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$conn->close();
    $conn->close();
 else {
    // Redirect to the reservation form if accessed directly
    header("Location: index.html");
    exit;
}
?>