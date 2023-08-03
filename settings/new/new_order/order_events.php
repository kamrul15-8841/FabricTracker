<?php

session_start();
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$buyer_id = mysqli_real_escape_string($con, stripslashes(trim($_POST['buyer_id'])));

// $sql = "
//        SELECT buyer_profile.multi_events
//        FROM `buyer_profile`
//        WHERE buyer_id = '$buyer_id'
//        ";
//$result = mysqli_query($con, $sql) or die(mysqli_error($con));
//while ($row = mysqli_fetch_array($result)) {
//
//    $multi_events = $row['multi_events'];
//    if ($multi_events == "" || !isset($row['multi_events'])) {
//
//    } else {
//        $multi_events = explode(",", $multi_events);
//
//    }
//}


$sql_for_events = " SELECT buyer_profile.multi_events
                                    FROM `buyer_profile`
                                    WHERE buyer_id = '$buyer_id' ";
$result_for_events = mysqli_query($con, $sql_for_events) or die(mysqli_error($con));
while ($row_for_events = mysqli_fetch_array($result_for_events)) {
    echo $row_for_events['multi_events'];
}

                