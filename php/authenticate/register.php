<?php
require_once 'User.php';

$conn = new Connection();
$db = $conn->getDb();
$userObject = new User($db);

$response = array("error" => FALSE, "msg" => "registration successfull");

if (trim($_POST['username']) != "" && trim($_POST['password']) != "" && trim($_POST['confirm']) != "" && trim($_POST['account_type']) != "") {

	$username = $_POST['username'];
	$password = $_POST['password'];
	$password_confirm = $_POST['confirm'];
	$account_type = $_POST['account_type'];

	if ($userObject->isUserExist($username)) {
		$response["error"] = TRUE;
		$response["msg"] = "username already exists";
		echo json_encode($response);

	} else if ($password !== $password_confirm) {
		$response["error"] = TRUE;
		$response["msg"] = "passwords do not match";
		echo json_encode($response);

	} else {
		$user = $userObject->storeUser($username, $password, $account_type);

		if ($user) {
			echo json_encode($response);

		} else {
			$response["error"] = TRUE;
			$response["msg"] = "unknown error occured";
			echo json_encode($response);
		}
	}
} else {
	$response["error"] = TRUE;
	$response["msg"] = "please complete all parameters";
	echo json_encode($response);
}

?>