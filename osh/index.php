<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

// Redirect to login if the user is not logged in
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
    <title>Welcome to the User Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container mt-5">
        <!-- Display any session messages -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <!-- Greeting and Logout Option -->
        <div class="text-center mb-4">
            <h1>FindHire Recruitment</h1>
            <h2>Welcome Admin: <?php echo htmlspecialchars($_SESSION['email']); ?>!</h2>
            <h3><a href="core/handleForms.php?logoutUserBtn=1" class="btn btn-danger">Logout</a></h3>
        </div>

        <!-- Admins Link -->
        <div class="text-center mb-4">
            <a href="admin.php" class="btn btn-primary">Admins</a>
        </div>

        <!-- Search Form -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" class="form-inline justify-content-center mb-4">
            <input type="text" name="searchInput" placeholder="Search here" class="form-control mr-2">
            <input type="submit" name="searchBtn" value="Search" class="btn btn-outline-primary">
        </form>

        <!-- Navigation Links -->
        <div class="text-center mb-4">
            <p><a href="accepted.php" class="btn btn-info">Accepted Applicants</a></p>
            <p><a href="insert.php" class="btn btn-success">Add New Applicants</a></p>
        </div>

        <!-- User Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Education</th>
                    <th>Expertise</th>
                    <th>Experience</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!isset($_GET['searchBtn'])) {
                    $getAllUsers = getAllUsers($pdo);
                    foreach ($getAllUsers as $row) {
                        // Check if the applicant's status is 'accepted'
                        $status = $row['status'] == 'accepted' ? 'Accepted' : 'Pending';
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['education']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['expertise']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['experience']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['date_added']) . "</td>";
                        echo "<td>" . $status . "</td>";

                        // If the applicant is accepted, don't show the Reject button
                        if ($row['status'] == 'pending') {
                            echo "<td><a href='view.php?id=" . $row['id'] . "' class='btn btn-info btn-sm'>View</a> | <a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Reject</a></td>";
                        } else {
                            echo "<td><a href='view.php?id=" . $row['id'] . "' class='btn btn-info btn-sm'>View</a></td>"; 
                        }
                        echo "</tr>";
                    }
                } else {
                    $searchForAUser = searchForAUser($pdo, $_GET['searchInput']);
                    foreach ($searchForAUser as $row) {
                        $status = $row['status'] == 'accepted' ? 'Accepted' : 'Pending';
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['education']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['expertise']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['experience']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['date_added']) . "</td>";
                        echo "<td>" . $status . "</td>";

                        // If the applicant is accepted, don't show the Reject button
                        if ($row['status'] == 'pending') {
                            echo "<td><a href='view.php?id=" . $row['id'] . "' class='btn btn-info btn-sm'>View</a> | <a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Reject</a></td>";
                        } else {
                            echo "<td><a href='view.php?id=" . $row['id'] . "' class='btn btn-info btn-sm'>View</a></td>"; 
                        }
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>