<?php
require_once 'query.php';

//build array of data items
$arRows = array();
while ($row_rsItems = mysqli_fetch_assoc($rsItems)) {
	array_push($arRows, $row_rsItems);
}

//serialize and deliver as JSON
echo json_encode($arRows);

?>