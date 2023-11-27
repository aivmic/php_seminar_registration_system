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
    <title>Registracijos puslapis</title>
</head>

<body>

    <header>
        <h1>Registracija</h1>
        <nav>
            <a href="router.php?action=home">Pagrindinis</a>
            <a href="router.php?action=login">Prisijungti</a>
        </nav>
    </header>

    <div>
        <form action="process_registration.php" method="post" onsubmit="return validateForm()">
            <!-- Registration form fields -->
            <label for="username">Slapyvardis:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Slaptažodis:</label>
            <input type="password" id="password" name="password" required>

            <label for="firstname">Vardas:</label>
            <input type="text" id="firstname" name="firstname" required>

            <label for="lastname">Pavardė:</label>
            <input type="text" id="lastname" name="lastname" required>

            <label for="email">Elektroninis paštas:</label>
            <input type="email" id="email" name="email" required>

            <label for="user_type">Naudotojo tipas:</label>
            <select id="user_type" name="user_type" required>
                <option value="listener">Klausytojas</option>
                <option value="lektor">Lektorius</option>
                <option value="admin">Administracija</option>
            </select>

            <!-- Add other registration fields as needed -->

            <button type="submit">Registruotis!</button>
        </form>
    </div>

    <script>
        function validateForm() {
            // Simple JavaScript validation
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            var firstname = document.getElementById('firstname').value;
            var lastname = document.getElementById('lastname').value;
            var email = document.getElementById('email').value;

            if (username === "" || password === "" || firstname === "" || lastname === "" || email === "") {
                alert("Užpildykite formą.");
                return false;
            }

            // You can add more validation rules as needed

            return true;
        }
    </script>

</body>

</html>