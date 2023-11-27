

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seminarų registracijos sistema</title>
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

        .message {
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
        <h1>Seminarų registracijos sistema</h1>
        <nav>
            <a href="router.php?action=login">Prisijungti</a>
            <a href="router.php?action=register">Registruotis</a>

        </nav>
    </header>

    <div>
        <?php
        session_start();
        // Check if registration was successful
        if (isset($_SESSION['registration_success']) && $_SESSION['registration_success']) {
            echo '<div class="success">Registracija sėkminga. Galite prisjungti!</div>';
            // Reset the session variable to avoid displaying the message on subsequent visits
            unset($_SESSION['registration_success']);
        }
        ?>
        <?php include('seminar_table.php'); ?>

    </div>
        <?php include("footer.php") ?>
</body>

</html>