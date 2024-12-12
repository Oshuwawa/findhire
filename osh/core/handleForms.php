<?php  

require_once 'dbConfig.php';
require_once 'models.php';


if (isset($_POST['insertUserBtn'])) {
	$insertUser = insertNewUser($pdo,$_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['gender'], $_POST['address'], $_POST['education'], $_POST['expertise'], $_POST['experience']);

	if ($insertUser) {
		$_SESSION['message'] = "Successfully inserted!";
		header("Location: ../index.php");
	}
}


if (isset($_POST['deleteUserBtn'])) {
	$deleteUser = deleteUser($pdo,$_GET['id']);

	if ($deleteUser) {
		$_SESSION['message'] = "Successfully deleted!";
		header("Location: ../index.php");
	}
}

if (isset($_GET['searchBtn'])) {
	$searchForAUser = searchForAUser($pdo, $_GET['searchInput']);
	foreach ($searchForAUser as $row) {
		echo "<tr> 
				<td>{$row['id']}</td>
				<td>{$row['first_name']}</td>
				<td>{$row['last_name']}</td>
				<td>{$row['email']}</td>
				<td>{$row['gender']}</td>
				<td>{$row['address']}</td>
				<td>{$row['education']}</td>
				<td>{$row['expertise']}</td>
				<td>{$row['experience']}</td>
			  </tr>";
	}
}


if (isset($_POST['acceptApplicationBtn'])) {
    // Get the applicant ID from the URL
    if (isset($_GET['id'])) {
        $applicantId = $_GET['id'];
        
        // Get the admin's name from the session
        $adminName = $_SESSION['hr_first_name'] . ' ' . $_SESSION['hr_last_name'];  // Assumes admin's name is stored in session

        // Update the applicant's status to 'accepted' and store the admin's name in 'accepted_by'
        $updateStatusQuery = "UPDATE Applicant SET status = :status, accepted_by = :adminName WHERE id = :id";
        $stmt = $pdo->prepare($updateStatusQuery);
        $stmt->execute([
            ':status' => 'accepted',
            ':adminName' => $adminName,
            ':id' => $applicantId
        ]);

        // Redirect to the accepted.php page
        header("Location: accepted.php");
        exit();
    }
}




// Handling application acceptance
if (isset($_POST['acceptApplicationBtn'])) {
    // Get the applicant ID from the URL
    if (isset($_GET['id'])) {
        $applicantId = $_GET['id'];

        // Update the applicant's status to 'accepted'
        $updateStatusQuery = "UPDATE Applicant SET status = :status WHERE id = :id";
        $stmt = $pdo->prepare($updateStatusQuery);
        $stmt->execute([
            ':status' => 'accepted',
            ':id' => $applicantId
        ]);

        // Redirect to accepted.php
        header("Location: accepted.php");
        exit();
    }
}

// Handling logout
if (isset($_GET['logoutUserBtn'])) {
    // Log the user out
    session_start();
    session_unset();
    session_destroy();

    // Redirect to login page
    header("Location: ../login.php");
    exit();
}


// handleForms.php
require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_GET['logoutUserBtn'])) {
    session_destroy();
    header("Location: ../login.php");
    exit();
}

require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['acceptApplicationBtn'])) {
    $id = $_POST['id'];  // Get the applicant's ID from the form submission

    // Update the status of the applicant to 'accepted'
    $query = "UPDATE Applicant SET status = 'accepted' WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':id' => $id]);

    // Redirect back to the view page to show updated status
    header("Location: ../view.php?id=$id");
    exit();
}

if (isset($_POST['acceptApplicationBtn'])) {
    $applicantId = $_GET['id'];
    $stmt = $pdo->prepare("UPDATE Applicant SET status = 'accepted' WHERE id = :id");
    $stmt->bindParam(':id', $applicantId);
    $stmt->execute();

    $_SESSION['message'] = "Job applicant accepted";
    header("Location: view.php?id=" . $applicantId);
    exit();
}






?>


