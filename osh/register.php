<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (isset($_POST['registerBtn'])) {
    // Register the new user with the necessary parameters
    $registerUser = registerNewUser(
        $pdo,
        $_POST['first_name'],  // hr_first_name
        $_POST['last_name'],   // hr_last_name
        $_POST['email'],       // hr_email
        $_POST['password']
    );

    if ($registerUser) {
        $_SESSION['message'] = "Registration successful! You can now log in.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['message'] = "Registration failed. Email may already be in use.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-pzjw8f+ua7Kw1TIq0hB1B10E2fKGrzQ1+KrZbE0FNVes3au/J9eD1X6HzM8EJXT1" crossorigin="anonymous">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }
        .form-container {
            max-width: 600px;
            margin: 80px auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #5A5A5A;
            font-weight: bold;
            margin-bottom: 30px;
            font-size: 32px; /* Increase font size of the header */
        }
        .form-group {
            margin-bottom: 20px; /* Add space between form fields */
        }
        .form-control {
            border-radius: 5px;
            box-shadow: none;
            font-size: 18px; /* Increase font size of input fields */
            padding: 12px; /* Increase padding for better text spacing */
        }
        .btn-primary {
            background-color: #0069D9;
            border-color: #0062cc;
            font-size: 18px; /* Increase font size of the button */
            padding: 12px 20px; /* Increase button padding */
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .alert-info {
            background-color: #e7f4ff;
            color: #31708f;
            border: 1px solid #bce8f1;
            font-size: 18px; /* Increase font size of alert message */
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 16px; /* Slightly larger font size for footer */
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center">Create an Account</h2>

            <!-- Display registration status message -->
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-info text-center">
                    <?php 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']); 
                    ?>
                </div>
            <?php endif; ?>

            <!-- Registration Form -->
            <form method="POST" action="">
                <div class="form-group">
                    <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="registerBtn" class="btn btn-primary btn-block">Register</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>© 2024 Gonzales' Online Game . All Rights Reserved.</p>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-ZvpUoO/+PpLfCz6bn2pS+dBBF0f7jbFF02pVez7ylFgB5g3r5pF9nXY66BhD9lym" crossorigin="anonymous"></script>
</body>
</html>