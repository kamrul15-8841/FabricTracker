<?php
session_start();
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$buyer_profile = $_POST['buyer_profile'];
//$id = (isset($_POST['id']) ? $_POST['id'] : '');
//
//echo $buyer_profile;
//exit();

$sql = "SELECT * FROM  buyer_profile where buyer_profile_id = '$buyer_profile'";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

$row = mysqli_fetch_assoc($result);
$buyer_profile = $row['buyer_profile_id'];
$buyer_id = $row['buyer_id'];
$fabric_type = $row['fabric_type'];
$weave_type = $row['weave_type'];
$p_requirement = $row['p_requirement'];

$res = $buyer_profile.'?fs?'.$buyer_id.'?fs?'.$fabric_type.'?fs?'.$weave_type.'?fs?'.$p_requirement;
echo $res;
?>
