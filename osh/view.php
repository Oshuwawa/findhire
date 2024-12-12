<?php 
require_once 'core/handleForms.php'; 
require_once 'core/models.php'; 

// Check if ID is valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $getUserByID = getUserByID($pdo, $_GET['id']);
} else {
    echo "Invalid ID";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View Applicant Details</title>
	<!-- Include Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-pzjw8f+ua7Kw1TIq0hB1B10E2fKGrzQ1+KrZbE0FNVes3au/J9eD1X6HzM8EJXT1" crossorigin="anonymous">
	<!-- Custom Styles -->
	<link rel="stylesheet" href="styles.css">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function() {
			// Initially hide the success alert
			$('#successMessage').hide();

			// Submit the form via AJAX when the "Accept Application" button is clicked
			$('#acceptBtn').click(function(e) {
				e.preventDefault(); // Prevent form submission and page redirect

				// Send AJAX request
				var applicantId = <?php echo $_GET['id']; ?>;
				$.ajax({
					url: 'core/handleForms.php',
					type: 'POST',
					data: {
						acceptApplicationBtn: true, // Action flag
						id: applicantId // Send the applicant ID
					},
					success: function(response) {
						// On success, hide the button and show the success alert
						$('#acceptBtn').hide();
						$('#successMessage').fadeIn(); // Show the success message with a fade effect
					},
					error: function() {
						alert('Error processing request');
					}
				});
			});
		});
	</script>
	<style>
		body {
			font-size: 18px; /* Increased body font size */
			background-color: #f4f6f9;
		}
		.container {
			max-width: 900px; /* Increased container width */
			margin-top: 50px; /* Add some top margin */
		}
		.card {
			border-radius: 10px; /* Rounded corners for card */
		}
		.card-header {
			background-color: gray; /* Blue header */
			color: white;
			font-size: 24px;
			font-weight: bold;
			text-align: center;
			padding: 1px 0;
		}
		.card-body {
			padding: 20px; /* Reduced padding */
		}
		.card-title {
			font-size: 22px; /* Larger title font */
			font-weight: bold;
		}
		.card-body p {
			font-size: 18px; /* Larger font size for text */
			margin-bottom: 10px; /* Space between paragraphs */
		}
		.btn-lg {
			font-size: 20px; /* Larger button text */
			padding: 15px 30px; /* Larger padding for button */
		}
		.btn-success {
			background-color: #28a745;
			border-color: #28a745;
			font-weight: bold;
		}
		.btn-success:hover {
			background-color: #218838;
			border-color: #1e7e34;
		}
		.alert {
			font-size: 18px; /* Larger font size for success alert */
		}
		/* Reduce the gap between the title and the first name section */
		.card-body h5 {
			margin-bottom: 5px; /* Reduces the space below "Personal Information" */
		}
		.card-body p:first-of-type {
			margin-top: 0; /* Removes extra space above the first paragraph */
		}
	</style>
</head>
<body class="bg-light">
	<div class="container mt-5">
		<h1 class="text-center mb-4">Applicant Details</h1>
		<div class="card shadow-sm">
			<div class="card-header">
				<h5>Personal Information</h5>
			</div>
			<div class="card-body">
				<?php if ($getUserByID): ?>
					<p><strong>First Name:</strong> <?php echo htmlspecialchars($getUserByID['first_name']); ?></p>
					<p><strong>Last Name:</strong> <?php echo htmlspecialchars($getUserByID['last_name']); ?></p>
					<p><strong>Email:</strong> <?php echo htmlspecialchars($getUserByID['email']); ?></p>
					<p><strong>Gender:</strong> <?php echo htmlspecialchars($getUserByID['gender']); ?></p>
					<p><strong>Address:</strong> <?php echo htmlspecialchars($getUserByID['address']); ?></p>
					<p><strong>Education:</strong> <?php echo htmlspecialchars($getUserByID['education']); ?></p>
					<p><strong>Expertise:</strong> <?php echo htmlspecialchars($getUserByID['expertise']); ?></p>
					<p><strong>Experience:</strong> <?php echo htmlspecialchars($getUserByID['experience']); ?></p>

					<hr>

					<!-- Success Message -->
					<div id="successMessage" class="alert alert-success" role="alert" style="display: none;">
						Job applicant accepted successfully!
					</div>

					<!-- Check if the applicant is accepted -->
					<?php if ($getUserByID['status'] !== 'accepted'): ?>
						<!-- Accept Application Button -->
						<button id="acceptBtn" class="btn btn-success btn-lg btn-block">
							Accept Application
						</button>
					<?php else: ?>
						<p id="message" style="color: green; font-weight: bold;">Job applicant accepted</p>
					<?php endif; ?>
				<?php else: ?>
					<p>No applicant found with this ID.</p>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- Include Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ZvpUoO/+PpLfCz6bn2pS+dBBF0f7jbFF02pVez7ylFgB5g3r5pF9nXY66BhD9lym" crossorigin="anonymous"></script>
</body>
</html>