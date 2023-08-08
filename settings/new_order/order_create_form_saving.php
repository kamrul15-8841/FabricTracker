<?php
session_start();
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$data_previously_saved = "No";
$data_insertion_hampering = "No";
$image_insertion_hampering = "No";
$error_msg = "";

$gd = mysqli_real_escape_string($con, stripslashes(trim($_POST['gd'])));

$buyer_id = mysqli_real_escape_string($con, stripslashes(trim($_POST['buyer_id'])));

$style = mysqli_real_escape_string($con, stripslashes(trim($_POST['style'])));

$color = mysqli_real_escape_string($con, stripslashes(trim($_POST['color'])));

$fabric_qty = mysqli_real_escape_string($con, stripslashes(trim($_POST['fabric_qty'])));

$fabric_type = mysqli_real_escape_string($con, stripslashes(trim($_POST['fabric_type'])));

$weave_type = mysqli_real_escape_string($con, stripslashes(trim($_POST['weave_type'])));

$p_requirement = mysqli_real_escape_string($con, stripslashes(trim($_POST['p_requirement'])));

$p_finish = mysqli_real_escape_string($con, stripslashes(trim($_POST['p_finish'])));

$fabrics_booking_date = mysqli_real_escape_string($con, stripslashes(trim($_POST['fabrics_booking_date'])));

$buyer_delivery_date = mysqli_real_escape_string($con, stripslashes(trim($_POST['buyer_delivery_date'])));

$gd_creation_date = mysqli_real_escape_string($con, stripslashes(trim($_POST['gd_creation_date'])));

$lead_time = mysqli_real_escape_string($con, stripslashes(trim($_POST['lead_time'])));

$buyer_profile_id="";
//$recording_person_name = $row['recording_person_name'];
//$recording_time = $row['recording_time'];

$sql = "
        select * from `buyer_profile` where `buyer_id`='$buyer_id' 
                            and `fabric_type`='$fabric_type' 
                            and `weave_type` = '$weave_type'
                            and `p_requirement` = '$p_requirement'
    ";
$result_for_buyer_profile_id = mysqli_query($con, $sql) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($result_for_buyer_profile_id)){
    $buyer_profile_id = $row['buyer_profile_id'];
    //echo $buyer_profile_id;


}

if ( $buyer_profile_id=="") {
    echo "Please Create Buyer Profile First";

    exit();

}

//$recording_person_name = mysqli_real_escape_string($con, stripslashes(trim($_POST['recording_person_name'])));

//$recording_time = mysqli_real_escape_string($con, stripslashes(trim($_POST['recording_time'])));

mysqli_query($con, 'BEGIN');
mysqli_query($con, 'START TRANSACTION') or die(mysqli_error($con));

$today = date('d-m-Y');

$sql_for_duplicacy = "
					select * from 
						 orders
						 
						where
						gd = '$gd'
					and buyer_id ='$buyer_id'
				
					and style ='$style'
				
					and color ='$color'
				
					and fabric_qty ='$fabric_qty'
					
					and fabric_type ='$fabric_type'
					
					and weave_type ='$weave_type'
					
					and p_requirement ='$p_requirement'
					
					and p_finish ='$p_finish'
					
					and fabrics_booking_date ='$fabrics_booking_date'
					
					and buyer_delivery_date ='$buyer_delivery_date'
				
					and gd_creation_date ='$gd_creation_date'
					
					and lead_time = '$lead_time'
					
				
					";

$result = mysqli_query($con, $sql_for_duplicacy) or die(mysqli_error($con));

if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);
    $gd = $row['gd'];
    $buyer_id = $row['buyer_id'];
    $style = $row['style'];
    $color = $row['color'];
    $fabric_qty = $row['fabric_qty'];
    $fabric_type = $row['fabric_type'];
    $weave_type = $row['weave_type'];
    $p_requirement = $row['p_requirement'];
    $p_finish = $row['p_finish'];
    $fabrics_booking_date = $row['fabrics_booking_date'];
    $buyer_delivery_date = $row['buyer_delivery_date'];
    $gd_creation_date = $row['gd_creation_date'];
    $lead_time = $row['lead_time'];



    $update_sql_statement = "
                        UPDATE orders 
                        
                        SET gd = '$gd',
                        
                        buyer_id ='$buyer_id',
                        
                         style ='$style',
                         
                         color ='$color',
				
					    fabric_qty ='$fabric_qty',
					
					    fabric_type ='$fabric_type',
					
					    weave_type ='$weave_type',
					
					    p_requirement ='$p_requirement',
					
					    p_finish ='$p_finish',
					
					    fabrics_booking_date ='$fabrics_booking_date',
					
					    buyer_delivery_date ='$buyer_delivery_date',
				
					    gd_creation_date ='$gd_creation_date',
					    
					    lead_time = '$lead_time'
                         
                        
                        WHERE buyer_id ='$buyer_id'
                        
					";

    mysqli_query($con, $update_sql_statement) or die(mysqli_error($con));

    if (mysqli_affected_rows($con) <> 1) {

        $data_insertion_hampering = 'Yes';

    }

}

else {

    $insert_sql_statement = "
					insert into 
						orders  
						( 
                            gd,
                            
                            buyer_id,
                            
                            style,
                            
                            color,
                        
                            fabric_qty,
                        
                            fabric_type,
                            
                            weave_type,
                            
                            p_requirement,
                            
                            p_finish,
                            
                            fabrics_booking_date,
                            
                            buyer_delivery_date,
                            
                            gd_creation_date,
                            
                            lead_time,
                            
                            buyer_profile_id ) 

						values 

						( 
                            '$gd',
                            
                            '$buyer_id',
                            
                            '$style',
                            
                            '$color',
                        
                            '$fabric_qty',
                        
                            '$fabric_type',
                            
                            '$weave_type',
                            
                            '$p_requirement',
                            
                            '$p_finish',
                            
                            '$fabrics_booking_date',
                            
                            '$buyer_delivery_date',
                            
                            '$gd_creation_date',
                            
                            '$lead_time',
                            
                            '$buyer_profile_id')";

    mysqli_query($con, $insert_sql_statement) or die(mysqli_error($con));

    if (mysqli_affected_rows($con) <> 1) {

        $data_insertion_hampering = 'Yes';

    }
}

if ($data_previously_saved == 'Yes') {

    mysqli_query($con, 'ROLLBACK');
    echo 'Data is previously saved.';

} else if ($data_insertion_hampering == 'No') {

    mysqli_query($con, 'COMMIT');
    echo 'Data is successfully saved.';

} else {

    mysqli_query($con, 'ROLLBACK');
    echo 'Data is not successfully saved.';

}

$obj->disconnection();