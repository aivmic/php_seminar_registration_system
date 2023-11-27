<?php
// process_login.php
session_start();

// Connect to the MySQL database
$servername = "localhost";
$username = "stud";
$password = "stud";
$dbname = "projektas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database for the user
    $sql = "SELECT * FROM Naudotojai WHERE slapyvardis = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['slaptazodis'])) {
            // Password is correct, proceed with login
            $_SESSION['user_id'] = $row['naudotojo_id'];
            $_SESSION['username'] = $row['slapyvardis'];
            $_SESSION['vardas'] = $row['vardas']; // pridėti šią eilutę
            $_SESSION['pavarde'] = $row['pavarde']; // pridėti šią eilutę

            // Determine user type
            $user_type = $row['tipas'];

            // Redirect to the appropriate page based on user type
            switch ($user_type) {
                case 'listener':
                    header("Location: start.php");
                    break;
                case 'lektor':
                    header("Location: lektor.php");
                    break;
                case 'admin':
                    header("Location: admin.php");
                    break;
                default:
                    header("Location: home.php");
                    break;
            }

            // Close the statement
            $stmt->close();

            // Exit after header redirect
            exit();
        } else {
            // Incorrect password - redirect back to login page with an error message
            header("Location: login.php?login=error");
            exit();
        }
    } else {
        // User not found - redirect back to login page with an error message
        header("Location: login.php?login=error");
        exit();
    }
} else {
    // If trying to access this page without POST data, redirect to login page
    header("Location: login.php");
    $conn->close();
    exit();
}
