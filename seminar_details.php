<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seminaro informacija</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        h1 {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
            margin: 0;
        }

        p {
            margin: 10px 0;
        }

        .details-container {
            width: 90%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .back-btn {
            display: block;
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            background-color: #333;
            color: green;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-btn:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <h1>Seminaro informacija</h1>

    <div class="details-container">
        <?php
        // Database connection details
        $servername = "localhost";
        $username = "stud";
        $password = "stud";
        $dbname = "projektas";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get seminar ID from the form
        $seminaro_id = isset($_POST['seminaro_id']) ? $_POST['seminaro_id'] : null;

        if ($seminaro_id) {
            try {

                // Increment view count
                $updateStmt = $conn->prepare("UPDATE Seminarai SET perziuros = perziuros + 1 WHERE seminaro_id = ?");
                $updateStmt->bind_param("i", $seminaro_id);
                $updateStmt->execute();
                $updateStmt->close();
                $stmt = $conn->prepare("SELECT * FROM Seminarai WHERE seminaro_id = ?");
                $stmt->bind_param("i", $seminaro_id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Display detailed information about the seminar
                if ($result->num_rows > 0) {
                    $seminar = $result->fetch_assoc();
        ?>
                    <p><strong>Seminaro ID:</strong> <?= $seminar['seminaro_id'] ?></p>
                    <p><strong>Pavadinimas:</strong> <?= $seminar['pavadinimas'] ?></p>
                    <p><strong>Aprašymas:</strong> <?= $seminar['aprasymas'] ?></p>
                    <p><strong>Laikas:</strong> <?= $seminar['laikas'] ?></p>
                    <p><strong>Kaina:</strong> <?= $seminar['kaina'] ?> eu.</p>
                    <p><strong>Vietų skaičius:</strong> <?= $seminar['vietu_skaicius'] ?></p>
                    <p><strong>Vedėjas/Lektorius:</strong> <?= $seminar['vedantis_lektorius'] ?></p>
        <?php
                } else {
                    echo '<p>No information available for the selected seminar</p>';
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            } finally {
                $stmt->close();
                $conn->close();
            }
        } else {
            echo '<p>Invalid seminar ID</p>';
        }
        ?>
    </div>

    <a href="javascript:history.back()" class="back-btn">Grįzti atgal!</a>

</body>

</html>