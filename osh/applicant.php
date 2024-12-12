<?php
require_once 'core/dbConfig.php';

// If the form is submitted, process the data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit_application'])) {
        // Collect and sanitize form data
        $first_name = htmlspecialchars($_POST['first_name']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $email = htmlspecialchars($_POST['email']);
        $gender = htmlspecialchars($_POST['gender']);
        $address = htmlspecialchars($_POST['address']);
        $education = htmlspecialchars($_POST['education']);
        $expertise = htmlspecialchars($_POST['expertise']);
        $experience = htmlspecialchars($_POST['experience']);
        
        // Check if all fields are filled
        if (empty($first_name) || empty($last_name) || empty($email) || empty($gender) || empty($address) || empty($education) || empty($expertise) || empty($experience)) {
            $error_message = "All fields are required.";
        } else {
            // Prepare and execute the SQL query to insert the application into the database
            $stmt = $pdo->prepare("INSERT INTO Applicant (first_name, last_name, email, gender, address, education, expertise, experience) 
                                   VALUES (:first_name, :last_name, :email, :gender, :address, :education, :expertise, :experience)");

            // Bind the parameters
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':education', $education);
            $stmt->bindParam(':expertise', $expertise);
            $stmt->bindParam(':experience', $experience);

            // Execute the query
            if ($stmt->execute()) {
                $success_message = "Application submitted successfully!";
            } else {
                $error_message = "Error submitting the application. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="text-center mb-4">
        <h1>Gonzales' Online Game Corporation</h1>
        <h3>WE ARE HIRING GAME DEVELOPERS</h3>
        <h3>Apply now and become a part of the best of the best</h3>
    </div>

    <h4 class="text-left mb-4">Application Form</h4>

    <!-- Display messages (if any) -->
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <?php if (isset($success_message)): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <!-- Applicant Form -->
    <form action="applicant.php" method="POST">
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" class="form-control" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="education">Education:</label>
            <input type="text" id="education" name="education" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="expertise">Expertise:</label>
            <input type="text" id="expertise" name="expertise" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="experience">Experience:</label>
            <input type="text" id="experience" name="experience" class="form-control" required>
        </div>

        <button type="submit" name="submit_application" class="btn btn-primary btn-block">Submit Application</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>