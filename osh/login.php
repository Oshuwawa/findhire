<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (isset($_POST['loginBtn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Check the user's credentials (email and password)
    if (checkUserCredentials($pdo, $email, $password)) {
        $_SESSION['email'] = $email;  // Store the email in session for future reference
        header("Location: index.php");  // Redirect to index page after successful login
        exit();
    } else {
        $_SESSION['message'] = "Invalid email or password!";  // Display error message if credentials are wrong
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        body {
            font-size: 18px;
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            font-size: 16px;
        }
        .btn-lg {
            padding: 12px 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <!-- Login Form Container -->
    <div class="login-container">
        <!-- Display any session messages -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <h2 class="text-center">Admin Login</h2>

        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="form-group text-center">
                <button type="submit" name="loginBtn" class="btn btn-primary btn-lg w-100">Login</button>
            </div>
        </form>

        <p class="text-center"><a href="register.php">Register here for new admin account</a></p>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>