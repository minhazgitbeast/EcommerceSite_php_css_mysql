<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>

    <!-- Embedded CSS for improved design -->
    <style>
        /* Reset default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #ff7eb3, #ff758c, #f7a8a9);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: linear-gradient(135deg, #ffffff, #f3f4f6);
            width: 100%;
            max-width: 500px;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        header h1 {
            font-size: 36px;
            color: #444;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .options {
            margin-bottom: 30px;
        }

        .options p {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .btn {
            padding: 12px 30px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #fff;
            background: linear-gradient(135deg, #ff758c, #ff7eb3);
            text-decoration: none;
            border-radius: 25px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: inline-block;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        footer {
            font-size: 14px;
            color: #555;
            margin-top: 20px;
        }

        footer p {
            text-align: center;
        }

        /* Responsive design for smaller screens */
        @media screen and (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            header h1 {
                font-size: 28px;
            }

            .btn {
                font-size: 14px;
                padding: 10px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to Our Shop</h1>
        </header>

        <div class="options">
            <p>Please choose one of the options below:</p>
            <div class="buttons">
                <a href="login.php" class="btn">Login</a>
                <a href="register.php" class="btn">Register</a>
            </div>
        </div>

        <footer>
            <p>&copy; 2024 Our Shop</p>
        </footer>
    </div>
</body>
</html>