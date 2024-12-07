<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if username or email already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    if ($stmt->rowCount() > 0) {
        $error_message = "Username or email already exists!";
    } else {
        // Insert into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);

        // Redirect to login page immediately after successful registration
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Embedded CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #ff7eb3, #ff758c);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .registration-container {
            background: linear-gradient(135deg, #ffffff, #f9f9f9);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        header {
            text-align: center;
            margin-bottom: 30px;
        }

        header h1 {
            font-size: 32px;
            color: #444;
            font-weight: bold;
        }

        .registration-form {
            display: flex;
            flex-direction: column;
        }

        .input-field {
            margin-bottom: 20px;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .input-field:focus {
            border-color: #ff758c;
            outline: none;
        }

        .submit-button {
            padding: 12px;
            background: linear-gradient(135deg, #ff758c, #ff7eb3);
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: center;
        }

        footer {
            text-align: center;
            margin-top: 20px;
        }

        .footer-text {
            font-size: 14px;
            color: #555;
        }

        .login-link {
            color: #ff758c;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        @media screen and (max-width: 768px) {
            .registration-container {
                width: 90%;
                padding: 20px;
            }

            header h1 {
                font-size: 24px;
            }

            .input-field {
                font-size: 14px;
                padding: 10px;
            }

            .submit-button {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <header>
            <h1>Register</h1>
        </header>

        <!-- Registration Form -->
        <form method="POST" class="registration-form">
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <input type="text" name="username" placeholder="Username" class="input-field" required>
            <input type="email" name="email" placeholder="Email" class="input-field" required>
            <input type="password" name="password" placeholder="Password" class="input-field" required>
            <button type="submit" class="submit-button">Register</button>
        </form>

        <footer>
            <p class="footer-text">Already have an account? <a href="login.php" class="login-link">Login here</a></p>
        </footer>
    </div>
</body>
</html>
