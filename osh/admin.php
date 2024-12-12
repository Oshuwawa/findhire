<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-5">
        <!-- Greeting and Logout Option -->
        <div class="text-center mb-4">
            <h1>Gonzales' Game Developing Team</h1>
            <h2>List of HR Admins</h2>
        </div>

        <!-- Admin Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query to fetch all employees (admins)
                $getAdmins = getAllEmployees($pdo);

                // Display all admins
                foreach ($getAdmins as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['hr_first_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['hr_last_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['hr_email']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>