<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Applicants</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ6E+R7M4xPj0dPQZmA1YWiHMQz9dy0bAW9yy4+gHzo+kpF/5MRKghg0D4z5" crossorigin="anonymous">
    <style>
        body {
            font-size: 18px; /* Increased body font size */
            background-color: #f4f6f9;
        }
        .container {
            max-width: 900px; /* Increased container width */
            margin-top: 50px; /* Add some top margin */
        }
        .form-label {
            font-size: 20px; /* Larger labels */
        }
        .form-control {
            font-size: 18px; /* Larger input text */
            width: 100%; /* Ensure inputs take full width */
            padding: 12px; /* Increased padding for better spacing */
            margin-bottom: 20px; /* Increased spacing between inputs */
        }
        .btn-lg {
            padding: 15px 30px; /* Larger button */
            width: 100%; /* Make the button full-width */
            font-size: 20px; /* Larger button text */
        }
        .card {
            border-radius: 10px; /* Rounded corners for card */
        }
        .card-header {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 20px 0;
        }
        .card-body {
            padding: 30px;
        }
        .btn-success {
            background-color: #28a745; /* Green color */
            border-color: #28a745;
            font-weight: bold;
        }
        .btn-success:hover {
            background-color: #218838; /* Darker green on hover */
            border-color: #1e7e34;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Bootstrap Container -->
    <div class="container mt-5">

        <!-- Form Card -->
        <div class="card shadow-sm p-4">
            <div class="card-header">
                <h4>Manually Insert Applicants</h4>
            </div>
            <div class="card-body">
                <form action="core/handleForms.php" method="POST">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <input type="text" class="form-control" name="gender" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>

                    <div class="mb-3">
                        <label for="education" class="form-label">Education</label>
                        <input type="text" class="form-control" name="education" required>
                    </div>

                    <div class="mb-3">
                        <label for="expertise" class="form-label">Expertise</label>
                        <input type="text" class="form-control" name="expertise" required>
                    </div>

                    <div class="mb-3">
                        <label for="experience" class="form-label">Experience</label>
                        <input type="text" class="form-control" name="experience" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid gap-2">
                        <button type="submit" name="insertUserBtn" class="btn btn-success btn-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEJ6E+R7M4xPj0dPQZmA1YWiHMQz9dy0bAW9yy4+gHzo+kpF/5MRKghg0D4z5" crossorigin="anonymous"></script>

</body>
</html>