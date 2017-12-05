<?php
require_once 'User.php';

$conn = new Connection();
$db = $conn->getDb();

$userObject = new User($db);

$response = array("error" => FALSE, "msg" => "login successfull");

if (isset($_POST['username']) && isset($_POST['password']) && trim($_POST['username']) != "" && trim($_POST['password']) != "") {

	$username = $_POST['username'];
	$password = $_POST['password'];

	$user = $userObject->checkPassword($username, $password);

	if ($user != NULL) {
		echo json_encode($response);
	} else {
		$response["error"] = TRUE;
		$response["msg"] = "bad username/password";
		echo json_encode($response);
	}

} else {
	$response["error"] = TRUE;
	$response["msg"] = "please complete all parameters";
	echo json_encode($response);
}

?>