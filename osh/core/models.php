<?php  

require_once 'dbConfig.php';

function getAllUsers($pdo) {
	$sql = "SELECT * FROM Applicant 
			ORDER BY first_name ASC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getUserByID($pdo, $id) {
	$sql = "SELECT * from Applicant WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function searchForAUser($pdo, $searchQuery) {
	
	$sql = "SELECT * FROM Applicant WHERE 
			CONCAT(first_name,last_name,email,gender,
				address,education,expertise,experience,date_added) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$searchQuery."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}



function insertNewUser($pdo, $first_name, $last_name, $email, 
	$gender, $address, $education, $expertise, $experience) {

	$sql = "INSERT INTO Applicant 
			(
				first_name,
				last_name,
				email,
				gender,
				address,
				education,
				expertise,
				experience
			)
			VALUES (?,?,?,?,?,?,?,?)
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([
		$first_name, $last_name, $email, 
		$gender, $address, $education, $expertise, $experience,
	]);

	if ($executeQuery) {
		return true;
	}

}

function editUser($pdo, $first_name, $last_name, $email, $gender, 
	$address, $education, $expertise, $experience, $id) {

	$sql = "UPDATE Applicant
				SET first_name = ?,
					last_name = ?,
					email = ?,
					gender = ?,
					address = ?,
					education = ?,
					expertise = ?,
					experience= ?
				WHERE id = ? 
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $email, $gender, 
		$address, $education, $expertise, $experience, $id]);

	if ($executeQuery) {
		return true;
	}

}


function deleteUser($pdo, $id) {
	$sql = "DELETE FROM Applicant 
			WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$id]);

	if ($executeQuery) {
		return true;
	}
}


require_once 'dbConfig.php';

// Function to register a new employee
function registerNewUser($pdo, $first_name, $last_name, $email, $password) {
    $sql = "INSERT INTO Employee (hr_first_name, hr_last_name, hr_email, password)
            VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    return $stmt->execute([$first_name, $last_name, $email, $hashedPassword]);
}

// Function to check the credentials of an employee
function checkUserCredentials($pdo, $email, $password) {
    $sql = "SELECT password FROM Employee WHERE hr_email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        return true;
    }
    return false;
}

function getAcceptedUsers($pdo) {
    $query = "SELECT * FROM Applicant WHERE status = 'accepted' ORDER BY date_added DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Function to get all employees (admins)
function getAllEmployees($pdo) {
    $sql = "SELECT * FROM Employee";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>



