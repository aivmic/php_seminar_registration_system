<?php
// Puslapio pradžia
session_start();

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: home.php");
    exit();
}

$servername = "localhost";
$username = "stud";
$password = "stud";
$dbname = "projektas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Tikriname prisijungimą tik jei yra prisijungęs prie duomenų bazės
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Patikriname, ar vartotojas prisijungęs
if (!isset($_SESSION['user_id'])) {
    header("Location: home.php"); // Jei ne, nukreipiame į prisijungimo puslapį
    exit();
}

// Patikriname vartotojo tipą (pvz., adminas arba vartotojas)
$user_id = $_SESSION['user_id'];
$sql = "SELECT tipas, vardas, pavarde FROM Naudotojai WHERE naudotojo_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['vardas'] = $row['vardas'];
    $_SESSION['pavarde'] = $row['pavarde'];
    $user_type = $row['tipas'];

    // Nurodykite, kurie vartotojai gali pasiekti šį puslapį
    if (($user_type !== 'lektor') && basename($_SERVER['PHP_SELF']) === 'lektor.php') {
        header("Location: start.php"); // Neleidžiame neadminams patekti į admino puslapį
        exit();
    }
} else {
    // Jei nepavyko gauti vartotojo tipo, atjungiame vartotoją
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

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
</style>
</head>

<body>

    <header>
        <h1>Lektoriaus darbastalis</h1>
        <nav>
            <a href="?logout=true">Atsijungti!</a>
        </nav>
    </header>
    <h2>Sveikas, <?php echo "{$_SESSION['vardas']} {$_SESSION['pavarde']}"; ?>! Gerų seminarų!</h2>

    <div>
        <h3 class="middle">Jūsu vedami seminarai</h3>
        <?php
        try {
            $stmt = $conn->prepare("SELECT * FROM Seminarai WHERE vedantis_lektorius = CONCAT('{$_SESSION['vardas']}', ' ', '{$_SESSION['pavarde']}')");
            $stmt->bind_param("ss", $_SESSION['vardas'], $_SESSION['pavarde']);
            $stmt->execute();
            $result = $stmt->get_result();
            //$result = $stmt->get_result();

            // Patikrinkime ar yra rezultatų
            if ($result->num_rows > 0) {
                // Atvaizduojame rezultatus
        ?>
                <table>
                    <tr>
                        <th>Seminaro id</th>
                        <th>Pavadinimas</th>
                        <th>Aprašymas</th>
                        <th>Laikas</th>
                        <th>Kaina eu.</th>
                        <th>Vietų skaičius</th>
                        <th>Vedėjas/Lektorius</th>
                    </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $row['seminaro_id'] ?></td>
                            <td><?= $row['pavadinimas'] ?></td>
                            <td><?= $row['aprasymas'] ?></td>
                            <td><?= $row['laikas'] ?></td>
                            <td><?= $row['kaina'] ?></td>
                            <td><?= $row['vietu_skaicius'] ?></td>
                            <td><?= $row['vedenatis_lektorius'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <table>
                    <tr>
                        <th>Seminaro id</th>
                        <th>Pavadinimas</th>
                        <th>Aprašymas</th>
                        <th>Laikas</th>
                        <th>Kaina eu.</th>
                        <th>Vietų skaičius</th>
                        <th>Vedėjas/Lektorius</th>
                    </tr>
                    
                    
                </table>
        <?php
            } else {
                echo '<p>Nėra seminarų</p>';
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            //$stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>

<?php include("footer.php") ?>
</html>