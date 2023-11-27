<?php
session_start();

$servername = "localhost";
$username = "stud";
$password = "stud";
$dbname = "projektas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT tipas FROM Naudotojai WHERE naudotojo_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_type = $row['tipas'];

    if ($user_type !== 'admin') {
        header("Location: start.php");
        exit();
    }
} else {
    header("Location: home.php");
    exit();
}

// Tikriname, ar yra perduotas seminaro ID
if (isset($_GET['seminaro_id'])) {
    $seminaro_id = $_GET['seminaro_id'];

    // Gaukime esamą registracija_uzdaryta reikšmę
    $sql_get_registration_status = "SELECT registracija_uzdaryta FROM Seminarai WHERE seminaro_id = ?";
    $stmt_get_registration_status = $conn->prepare($sql_get_registration_status);
    $stmt_get_registration_status->bind_param("i", $seminaro_id);
    $stmt_get_registration_status->execute();
    $stmt_get_registration_status->bind_result($current_status);

    if ($stmt_get_registration_status->fetch()) {
        // Atnaujiname registracijos laukelį
        $new_status = $current_status === 1 ? false : true;
        $stmt_get_registration_status->close(); // Close the result set before preparing the next statement

        $sql_update = "UPDATE Seminarai SET registracija_uzdaryta = ? WHERE seminaro_id = ?";
        $stmt_update = $conn->prepare($sql_update);

        if ($stmt_update) { // Check if the preparation was successful
            $stmt_update->bind_param("ii", $new_status, $seminaro_id);
            $stmt_update->execute();
            $stmt_update->close();
        } else {
            die("Error in prepared statement: " . $conn->error);
        }
        header("Location: admin.php");
    }
} else {
    // Jei neperduotas seminaro ID, nukreipiame į pradinį puslapį
    header("Location: admin.php");
    exit();
}
