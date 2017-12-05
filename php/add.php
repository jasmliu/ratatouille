<?php
require_once 'include/Connection.php';

$conn = new Connection();
$db = $conn->getDb();

$response = array("error" => FALSE, "msg" => "add successful");

if(isset($_POST['date']) && isset($_POST['loc_type']) && isset($_POST['zip']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['borough']) && isset($_POST['lat']) && isset($_POST['lng'])) {

	$loc_type = $_POST['loc_type'];
	$zip = $_POST['zip'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$borough = $_POST['borough'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];

	$date = $_POST['date'];

	$sql = "INSERT INTO rats (id, date, loc_type, zip, address, city, borough, lat, lng) VALUES (null, '$date', '$loc_type', $zip, '$address', '$city', '$borough', $lat, $lng)";
	$result = mysqli_query($db, $sql);

	
	/*$stmt = $db->prepare("INSERT INTO rats(id, loc_type, zip, address, city, borough, lat, lng) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
    $result = $stmt->bind_param("isisssdd", $id, $loc_type, $zip, $address, $city, $borough, $lat, $lng);
    $result = $stmt->execute();
    $stmt->close();*/


    if ($result) {
    	$response["error"]=FALSE;
    
    } else {
        $reponse["error"]=TRUE;
        $response["msg"]="error";
    }

} else {
	$response["error"]=TRUE;
    $response["msg"]="please complete all parameters";
}

echo json_encode($response);

?>
