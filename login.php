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

    @media screen and (max-width: 600px) {
        div {
            width: 100%;
        }
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prisijungimo puslapis</title>
</head>

<body>

    <header>
        <h1>Prisijungimas</h1>
        <nav>
            <a href="home.php">Pagrindinis</a>
            <a href="router.php?action=register">Registruotis</a>
        </nav>
    </header>

    <div>
        <!-- Prisijungimo forma -->
        <form action="process_login.php" method="post">
            <label for="username">Vartotojo vardas:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Slaptažodis:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Prisijungti</button>
        </form>

        <?php if (isset($_GET['login']) && $_GET['login'] === 'error') : ?>
            <p style="color: red;">Tokio vartotojo nėra. Patikrinkite įvestus duomenis.</p>
        <?php endif; ?>

    </div>

</body>

</html>