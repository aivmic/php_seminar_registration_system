<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seminarų sąrašas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
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

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e5e5e5;
        }

        p {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php

    // seminar_table.php

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

    // Gauti lektoriaus ID
    $lektor_id = $_SESSION['user_id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM Seminarai WHERE vedenatis_lektorius = ?");
        $stmt->execute();
        $result = $stmt->get_result();

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
    <?php
        } else {
            echo '<p>Nėra seminarų</p>';
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $stmt->close();
        $conn->close();
    }
    ?>


</body>

</html>