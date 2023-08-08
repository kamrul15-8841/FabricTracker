<?php
session_start();
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$data_previously_saved = "No";
$data_insertion_hampering = "No";
$image_insertion_hampering = "No";
$error_msg = "";

$buyer_id = $_POST['buyer_id'];
$fabric_type = $_POST['fabric_type'];
$weave_type = $_POST['weave_type'];
$p_requirement = $_POST['p_requirement'];
$event_names = $_POST['event_names'];

$all_event_day = '';
foreach ($event_names as $event_id){
    $day_before_delivary_day ="day_before_delivary_".trim($event_id);
    $day_before_delivary = $_POST[$day_before_delivary_day];
    $all_event_day = $all_event_day.",".$day_before_delivary;
    $all_event_day = ltrim($all_event_day, ',');
}
$event_names=implode(',',$event_names);

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

 $select_sql_for_duplicacy="select * from `buyer_profile` 
                            where `buyer_id`='$buyer_id' 
                            and `fabric_type`='$fabric_type' 
                            and `weave_type` = '$weave_type'
                            and `p_requirement` = '$p_requirement'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{
    $data_previously_saved="Yes";
    $insert_sql_statement="update `buyer_profile` set `multi_events`='$event_names',`day_before_delivary`='$all_event_day'
                            where `buyer_id`='$buyer_id' 
                            and `fabric_type`='$fabric_type' 
                            and `weave_type` = '$weave_type'
                            and `p_requirement` = '$p_requirement'";
    mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));
}
else if( mysqli_num_rows($result) < 1)
{
    $insert_sql_statement="insert into `buyer_profile` ( buyer_id, fabric_type, weave_type, p_requirement, multi_events, day_before_delivary ) 
                            values ('$buyer_id', '$fabric_type', '$weave_type', '$p_requirement', '$event_names', '$all_event_day')";
    mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));
    if(mysqli_affected_rows($con)<>1)
    {
        $data_insertion_hampering = "Yes";
    }
}

if($data_previously_saved == "Yes")
{
    mysqli_query($con,"COMMIT");
    echo "Data is Updated!";
}
else if($data_insertion_hampering == "No" )
{
    mysqli_query($con,"COMMIT");
    echo "Data is successfully saved.";
}
else
{
    mysqli_query($con,"ROLLBACK");
    echo "Data is not successfully saved.";
}

$obj->disconnection();

?>



