<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Login successful, set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect to product list page
        header("Location: product_list.php");
        exit;
    } else {
        // Incorrect credentials
        $error_message = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Embedded CSS -->
    <style>
        /* Reset default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Container for the login form */
        .login-container {
            background: linear-gradient(135deg, #ffffff, #f3f4f6);
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

        .login-form {
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
            border-color: #6a11cb;
            outline: none;
        }

        .submit-button {
            padding: 12px;
            background: linear-gradient(135deg, #2575fc, #6a11cb);
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

        .register-link {
            color: #6a11cb;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        /* Responsive design for smaller screens */
        @media screen and (max-width: 768px) {
            .login-container {
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
    <div class="login-container">
        <header>
            <h1>Login</h1>
        </header>

        <form method="POST" class="login-form">
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <input type="email" name="email" placeholder="Email" class="input-field" required><br>
            <input type="password" name="password" placeholder="Password" class="input-field" required><br>
            <button type="submit" class="submit-button">Login</button>
        </form>

        <footer>
            <p class="footer-text">Don't have an account? <a href="register.php" class="register-link">Register here</a></p>
        </footer>
    </div>
</body>
</html>
