<?php
session_start();

// Patikriname, ar vartotojas yra prisijungęs
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Prijungiamės prie duomenų bazės
// Prijungiamės prie MySQL duomenų bazės
$servername = "localhost";
$username = "stud";
$password = "stud";
$dbname = "projektas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Tikriname prisijungimą tik jei yra prisijungęs prie duomenų bazės
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Tikriname, ar forma buvo pateikta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gauname ir saugome formos duomenis
    $seminaro_id = $_POST['seminaro_id'];
    $naudotojo_id = $_SESSION['user_id'];

    // Įrašome duomenis į duomenų bazę
    $sql = "INSERT INTO Uzsiregistravimas (seminaro_id, naudotojo_id, uzsiregistravimo_data) VALUES ('$seminaro_id', '$naudotojo_id', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="success">Sėkmingai užsiregistravote!</div>';
        echo '<div class="success-message">Sėkmingai užsiregistravote į seminarą!</div>';
    } else {
        echo 'Klaida: ' . $conn->error;
    }
}

// Uždarome duomenų bazės ryšį
$conn->close();
