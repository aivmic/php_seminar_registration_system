<?php

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

// Select visus seminarus
$sql_seminars = "SELECT * FROM Seminarai";
$result_seminars = $conn->query($sql_seminars);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <header>Administracija - Seminarų lentelė</header>

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

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
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
    </style>
</head>

<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Pavadinimas</th>
            <th>Aprašymas</th>
            <th>Laikas</th>
            <th>Kaina</th>
            <th>Vietų skaičius</th>
            <th>Vedantis lektorius</th>
            <th>Peržiūros</th>
            <th>Registracija uždaryta</th>
            <th>Pakeisti registracijos aktyvumą</th> <!-- Naujas stulpelis -->
        </tr>

        <?php
        if ($result_seminars->num_rows > 0) {
            while ($row_seminars = $result_seminars->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_seminars['seminaro_id'] . "</td>";
                echo "<td>" . $row_seminars['pavadinimas'] . "</td>";
                echo "<td>" . $row_seminars['aprasymas'] . "</td>";
                echo "<td>" . $row_seminars['laikas'] . "</td>";
                echo "<td>" . $row_seminars['kaina'] . "</td>";
                echo "<td>" . $row_seminars['vietu_skaicius'] . "</td>";
                echo "<td>" . $row_seminars['vedantis_lektorius'] . "</td>";
                echo "<td>" . $row_seminars['perziuros'] . "</td>";
                echo "<td>" . ($row_seminars['registracija_uzdaryta'] ? 'Taip' : 'Ne') . "</td>";
                echo "<td><a href='update_registration_status.php?seminaro_id=" . $row_seminars['seminaro_id'] . "'>Atnaujinti aktyvumą</a></td>";
                echo "</tr>";
            }
        } else {
            echo '<tr><td colspan="10" style="color: red; text-align: center;">Nėra seminarų</td></tr>';

        }
        ?>
    </table>
</body>
</html>
