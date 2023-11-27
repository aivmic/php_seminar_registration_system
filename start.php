<?php
// start.php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: home.php");
    exit();
}

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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
        }

        nav {
            display: flex;
            justify-content: space-around;
            margin-top: 1em;
        }

        nav a {
            text-decoration: none;
            background-color: #333;
            color: #fff;
            font-size: 25px;
        }

        nav a:hover {
            background-color: #333;
            color: #00FF00;
            font-size: 25px;
        }

        .content {
            margin: 2em;
        }

        th,
        td {
            border: 1px solid #333;
        }

        .middle {
            margin-top: 1em;
            text-align: center;
        }

        .success {
            color: green;
            font-size: 35px;
            text-align: center;
        }

        .success-message {
            color: green;
            font-size: 20px;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Seminarai</h1>
        <nav>
            <a href="?logout=true">Atsijungti!</a>
        </nav>
    </header>
    <h2>Sveikas, <?php echo "{$_SESSION['vardas']} {$_SESSION['pavarde']}"; ?>! Gerų seminarų!</h2>
    <div>
        <div>
            <h3 class="middle">Užsiregistravimas</h3>
            <form action="start.php" method="post">
                <label for="seminaro_id">Įveskite seminaro ID:</label>
                <input type="number" name="seminaro_id" id="seminaro_id" required>
                <input type="submit" value="Užsiregistruoti">
            </form>
            <?php
            // Patikriname, ar buvo pateikta seminaro ID
            if (isset($_POST['seminaro_id'])) {
                $seminaro_id = $_POST['seminaro_id'];
                $naudotojo_id = $_SESSION['user_id'];

                // Tikriname, ar toks seminaras egzistuoja
                $check_sql = "SELECT * FROM Seminarai WHERE seminaro_id = '$seminaro_id'";
                $result = $conn->query($check_sql);

                if ($result === false) {
                    // Handle the query error, for example:
                    die('Error executing the query: ' . $conn->error);
                }

                if ($result->num_rows > 0) {
                    // Jei seminaras egzistuoja, įrašome užsiregistravimą
                    $sql = "INSERT INTO Uzsiregistravimas (seminaro_id, naudotojo_id, uzsiregistravimo_data) VALUES ('$seminaro_id', '$naudotojo_id', NOW())";

                    if ($conn->query($sql) === TRUE) {
                        echo '<div class="success-message">Sėkmingai užsiregistravote į seminarą!</div>';
                    } else {
                        // Handle the insert query error, for example:
                        echo 'Klaida užsiregistrant į seminarą: ' . $conn->error;
                    }
                } else {
                    // Jei seminaro ID neegzistuoja, išvedame pranešimą
                    echo '<div class="error">Klaida: Tokio seminaro ID neegzistuoja!</div>';
                }
            }
            ?>
        </div>

        <h4 class="middle">Seminarai</h4>
        <?php
        // Display seminar information using seminar_table.php
        // Assuming seminar_table.php defines a function or outputs HTML content
        include('seminar_table.php');
        ?>

    </div>
</body>

<?php include("footer.php") ?>
</html>