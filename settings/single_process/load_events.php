<?php
session_start();
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$buyer_id = mysqli_real_escape_string($con, stripslashes(trim($_POST['buyer_id'])));

$p_requirement = mysqli_real_escape_string($con, stripslashes(trim($_POST['p_requirement'])));

$fabric_type = mysqli_real_escape_string($con, stripslashes(trim($_POST['fabric_type'])));

$weave_type = mysqli_real_escape_string($con, stripslashes(trim($_POST['weave_type'])));

$sql = " SELECT *  FROM buyer_profile WHERE 
            p_requirement = '$p_requirement'
            and buyer_id = '$buyer_id'
            and fabric_type= '$fabric_type'
            and weave_type = '$weave_type'
 
 ";


$result = mysqli_query($con, $sql) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($result)) {

    $multi_events = $row['multi_events'];
    $day_before_delivary = $row['day_before_delivary'];
    if (($multi_events == "" || !isset($row['multi_events'])) && ($multi_events == "" || !isset($row['multi_events']))) {

    } else {
        $multi_events = explode(",", $multi_events);
        $day_before_delivary = explode(",", $day_before_delivary);

    }

//        foreach ($multi_events1 as $multi_list){
//            if (in_array($multi_list, $multi_events1)){
//
////                echo '<input checked = "checked" type ="checkbox" name="multi_events[]" value="'.$multi_list.'">';
//                echo $multi_list;
//            } else{
//                echo '<input checked = "checked" type ="checkbox" name="multi_events[]" value="'.$multi_list.'">';
//            }
//        }

//    echo '<option value="' . $row['buyer_profile_id'] . '">' . $row['multi_events'] . '</option>';
//    echo '<option value="'.$row['multi_events'].'">'.$row['multi_events'].'</option>';

}

//    if(!isset($multi_events)){
//        ?>
<!---->
<!--        <div class="form-group form-group-sm" id="form-group_for_multi_events" style="margin-bottom: 20px;">-->
<!--            <label class="control-label col-sm-3" for="multi_events"-->
<!--                   style="margin-right:0px; color:#00008B;">Select Events</label>-->
<!--            <div class="container" id="multi_events">-->
<!--                --><?php
//                $sql_for_events = " SELECT * FROM event_info ";
//                $result_for_events = mysqli_query($con, $sql_for_events) or die(mysqli_error($con));
//                while ($row_for_events = mysqli_fetch_array($result_for_events)) {
//
//
//                echo '<td><input type="checkbox" name="event_names[]" value=" ' . $row_for_events['event_id'] . ' " > ' . $row_for_events['event_name'] . ' '; ?><!--</td>-->
<!---->
<!--                --><?php
//                }
//                ?>
<!--            </div> </br>-->
<!---->
<!--        </div>-->
<!---->
<!--        --><?php
//        exit();
//    }
//
//?>

<?php error_reporting(0); ?>
<div class="form-group form-group-sm" id="form-group_for_multi_events" style="margin-bottom: 20px;">
    <div><strong>Select Events And Days</strong></div>

    <?php
    $sql_for_events = " SELECT * FROM event_info ";
    $result_for_events = mysqli_query($con, $sql_for_events) or die(mysqli_error($con));
    while ($row_for_events = mysqli_fetch_array($result_for_events)) {
        $event_check = 0;

        foreach ($multi_events as $event) {
            $event = trim($event);
            if ($row_for_events['event_id'] == $event) {
                $event_check = 1;

            }

        }

        if ($event_check == 0) {

            ?>
            <?php echo '<div class="col-md-12 form-group form-check" style="text-align: center; margin-left: 15px;padding-left: 20px;">';
            echo '<td>
           <input type="checkbox" name="event_names[]" value=" ' . $row_for_events['event_id'] . ' " > ' . $row_for_events['event_name'] . ' '; ?>
            <input type="text" id="day_before_delivary"
                   value="<?php echo $row_for_events['total_day']; ?>"
                   name="day_before_delivary_<?php echo $row_for_events['event_id']; ?>"
                   ?>
            </td>
            <?php echo "</div>"; ?>
            <?php


        } else {
            echo '<div class="col-md-12 form-group form-check" style="text-align: center; margin-left: 15px;padding-left: 20px;">';
            echo '<td><input type="checkbox" checked = "checked" name="event_names[]" value=" ' . $row_for_events['event_id'] . ' " > ' . $row_for_events['event_name'] . ' '; ?>
            <input type="text" id="day_before_delivary"
                   value="<?php echo $row_for_events['total_day']; ?>"
                   name="day_before_delivary_<?php echo $row_for_events['event_id']; ?>" ?>
            </td>
            <?php echo "</div>"; ?>
            <?php
        }
    }
    echo "</div>";

    ?>
</div> </br>

