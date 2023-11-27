<?php
session_start();

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

    if (($user_type !== 'admin') && basename($_SERVER['PHP_SELF']) === 'admin.php') {
        header("Location: start.php");
        exit();
    }
} else {
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

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
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

    div {
        max-width: 400px;
        margin: 30px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 16px;
        box-sizing: border-box;
    }

    input[type="date"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 16px;
        box-sizing: border-box;
    }

    button {
        background-color: #4caf50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    .success {
        color: green;
        font-size: 35px;
        text-align: center;
    }

    @media screen and (max-width: 600px) {
        div {
            width: 100%;
        }
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija</title>

</head>

<body>
    <header>
        <h1>Administracija</h1>
        <nav>
            <a href="?logout=true">Atsijungti!</a>
        </nav>
    </header>

    <h2>Sveikas, <?php echo "{$_SESSION['vardas']} {$_SESSION['pavarde']}"; ?>! Gerų seminarų!</h2>

    <div>
        <h2>Pridėti naują seminarą</h2>
        <form onsubmit="return validateForm()" action="admin.php" method="post">
            <label for="pavadinimas">Pavadinimas:</label>
            <input type="text" id="pavadinimas" name="pavadinimas" required>

            <label for="aprasymas">Aprašymas:</label>
            <textarea id="aprasymas" name="aprasymas" rows="4" required></textarea>

            <label for="laikas">Laikas:</label>
            <input type="datetime-local" id="laikas" name="laikas" required>

            <label for="kaina">Kaina:</label>
            <input type="number" id="kaina" name="kaina" required>

            <label for="vietu_skaicius">Vietų skaičius:</label>
            <input type="number" id="vietu_skaicius" name="vietu_skaicius" required>

            <label for="vedantis_lektorius">Vedantis lektorius:</label>
            <input type="text" id="vedantis_lektorius" name="vedantis_lektorius" required>

            <button type="submit">Pridėti seminarą</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $pavadinimas = $_POST['pavadinimas'];
        $aprasymas = $_POST['aprasymas'];
        $laikas = $_POST['laikas'];
        $kaina = $_POST['kaina'];
        $vietu_skaicius = $_POST['vietu_skaicius'];
        $vedantis_lektorius = $_POST['vedantis_lektorius'];

        // Perform basic server-side validation
        if (empty($pavadinimas) || empty($aprasymas) || empty($laikas) || empty($kaina) || empty($vietu_skaicius) || empty($vedantis_lektorius)) {
            echo "<span style='color: red;'>Užpildykite visus laukus.</span>";
        } elseif (!is_numeric($kaina) || !is_numeric($vietu_skaicius)) {
            echo "<span style='color: red;'>Kaina ir vietų skaičius turi būti skaičiai.</span>";
        } else {
            // Insert data into the "Seminarai" table
            $sql = "INSERT INTO Seminarai (pavadinimas, aprasymas, laikas, kaina, vietu_skaicius, vedantis_lektorius, perziuros, registracija_uzdaryta) VALUES (?, ?, ?, ?, ?, ?, 0, null)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("sssiis", $pavadinimas, $aprasymas, $laikas, $kaina, $vietu_skaicius, $vedantis_lektorius);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    echo "<span style='color: green; display: block; text-align: center; font-size: 24px;'>Seminaras sėkmingai pridėtas!</span>";
                } else {
                    echo "<span style='color: red; display: block; text-align: center; font-size: 24px;'>Nepavyko pridėti seminaro!/span>";
                }

                $stmt->close();
            } else {
                echo "<span style='color: red; display: block; text-align: center; font-size: 24px;'>Klaida paruošiant užklausą: " . $conn->error . "</span>";
            }
        }
    } ?>
    <header>
        Užsiregistravę naudotojai
    </header>

    <?php
    //uzsiregistravusiu info
    // Select visus užsiregistravusius naudotojus
    $sql_users = "SELECT Naudotojai.vardas, Naudotojai.pavarde, Uzsiregistravimas.uzsiregistravimo_data, Seminarai.pavadinimas AS seminaro_pavadinimas
FROM Uzsiregistravimas
INNER JOIN Naudotojai ON Uzsiregistravimas.naudotojo_id = Naudotojai.naudotojo_id
INNER JOIN Seminarai ON Uzsiregistravimas.seminaro_id = Seminarai.seminaro_id";
    $result_users = $conn->query($sql_users);

    if ($result_users->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Vardas</th><th>Pavardė</th><th>Užsiregistravimo data</th><th>Seminaro pavadinimas</th></tr>";

        while ($row_users = $result_users->fetch_assoc()) {
            echo "<tr><td>" . $row_users['vardas'] . "</td><td>" . $row_users['pavarde'] . "</td><td>" . $row_users['uzsiregistravimo_data'] . "</td><td>" . $row_users['seminaro_pavadinimas'] . "</td></tr>";
        }

        echo "</table>";
    } else {
        echo '<p style="color: red; text-align: center;">Nėra užsiregistravusių naudotojų.</p>';
    }



    include('admin_seminar_table.php');
    ?>

</body>

<?php echo '<br>';echo '<br>';echo '<br>'; include("footer.php") ?>
</html>

<script>
    function validateForm() {
        // Simple JavaScript validation
        var pavadinimas = document.getElementById('pavadinimas').value;
        var aprasymas = document.getElementById('aprasymas').value;
        var laikas = document.getElementById('laikas').value;
        var kaina = document.getElementById('kaina').value;
        var vietu_skaicius = document.getElementById('vietu_skaicius').value;
        var vedantis_lektorius = document.getElementById('vedantis_lektorius').value;

        if (pavadinimas === "" || aprasymas === "" || laikas === "" || kaina === "" || vietu_skaicius === "" || vedantis_lektorius === "") {
            alert("Užpildykite visus laukus.");
            return false;
        }

        // Additional validation for specific fields
        if (isNaN(kaina) || isNaN(vietu_skaicius)) {
            alert("Kaina ir vietų skaičius turi būti skaičiai.");
            return false;
        }

        // You can add more validation rules as needed

        return true;
    }
</script>