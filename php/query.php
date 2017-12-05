<?php
require_once 'include/Connection.php';

$conn = new Connection();
$db = $conn->getDb();

$sql = "SELECT id, date, loc_type, zip, address, city, borough, lat, lng FROM rats";

//$sql .= " WHERE date >= '2017-08-24' AND date <= '2017-08-24'";

//id filter
if (isset($_GET['id']))
	$id = $_GET['id'];
else if (isset($_POST['id']))
	$id = $_POST['id'];

if (isset($id))
	$sql .= " WHERE id = '{$id}'";

//date filter
if (isset($_GET['date_start'])) {
	$date_start = $_GET['date_start'];
}
else if (isset($_POST['date_start'])) {
	$date_start = $_POST['date_start'];
}

if (isset($_GET['date_end'])) {
	$date_end = $_GET['date_end'];
} else if (isset($_POST['date_end'])) {
	$date_end = $_POST['date_end'];
}

if (isset($date_start) && isset($date_end)) {
	$sql .= " WHERE date >= '{$date_start}' AND date <= '{$date_end}'";
} else if (isset($date_start)) {
	$sql .= " WHERE date >= '{$date_start}'";
} else if (isset($date_end)) {
	$sql .= " WHERE date <= '{$date_end}'";
}

//zipcode filter
if (isset($_GET['zip']))
	$zip = $_GET['zip'];
else if (isset($_POST['zip']))
	$zip = $_POST['zip'];

if (isset($zip))
	$sql .= " WHERE zip = '{$zip}'";

//sort order
if (isset($_GET['orderby']))
  $orderby = $_GET['orderby'];
else if (isset($_POST['orderby']))
  $orderby = $_POST['orderby'];

if (isset($orderby)) {
	$sql .= " ORDER BY date {$orderby}";
}

$rsItems = mysqli_query($db, $sql);

?>