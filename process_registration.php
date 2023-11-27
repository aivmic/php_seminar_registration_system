<?php
$servername = "localhost"; // Your server name
$username = "stud"; // Your database username
$password = "stud"; // Your database password
$dbname = "projektas"; // Your database name

session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    //$registrationDate = $_POST["registration_date"];
    $userType = $_POST["user_type"];

    // You may want to hash the password for security purposes
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the registration query
    $stmt = $conn->prepare("INSERT INTO Naudotojai (slapyvardis, slaptazodis, vardas, pavarde, el_pastas, registracijos_data, tipas) VALUES (?, ?, ?, ?, ?, NOW(), ?)");

    // Check if the preparation was successful
    if ($stmt === false) {
        die('Error preparing the statement: ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssss", $username, $hashedPassword, $firstname, $lastname, $email, $userType);

    // Execute the statement
    if ($stmt->execute()) {
        // Registration successful
        $_SESSION['registration_success'] = true;
        header("Location: home.php");
        exit(); // Make sure to exit after a header redirect
    } else {
        // Registration failed
        echo '<div style="color: red;">Registracija nepavyko. Bandykite dar kartą.</div>';
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Nepavyko.";
}

// Close the connection
$conn->close();
?>
