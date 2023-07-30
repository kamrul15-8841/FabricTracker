<?php
session_start();
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
/*
$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];

$sql="select * from hrm_info.user_login where user_id='$user_id' and `password`='$password'";

$result=mysqli_query($con,$sql) or die(mysqli_error()());
if(mysql_num_rows($result)<1)
{

	header('Location:logout.php');

}
*/
?>


<style>

    .form-group /* This is for reducing Gap among Form's Fields */
    {

        margin-bottom: 5px;

    }

</style>


<div class="col-sm-12 col-md-12 col-lg-12">

    <div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item"><a onclick="load_page('events/eventsWiseBuyerAndGD.php')">events Wise Buyer
                        And GD</a></li>
            </ol>
        </nav>

        <form class="form-horizontal" action="POST" style="margin-top:10px;" name="user_list_form" id="user_list_form">


            <div class="form-group form-group-sm table-responsive">
                <label class="col-sm-offset-7 control-label col-sm-1" for="search">Search</label>
                <div class="col-sm-4">
                    <input type="text" id="my_input" class="form-control " onkeyup="my_function()"
                           placeholder="Please type Name ">
                </div>
            </div> <!-- End of <div class="form-group form-group-sm" -->

            <div class="form-group form-group-sm">
                <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th style="text-align:center">SI</th>
                        <th style="text-align:center">GD/Order Id</th>
                        <th style="text-align:center">Order Date</th>
                        <th style="text-align:center">Delivery Date</th>
                        <th style="text-align:center">Buyer</th>
                        <th style="text-align:center">Events</th>
                        <th style="text-align:center">Delivary Date</th>
                        <th style="text-align:center">Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $s1 = 1;
                    //                    $sql_for_user_list = "SELECT * FROM user_login";
//                    $sql_for_user_list = "SELECT order_id,o.buyer_id,b.buyer_name,bp.multi_events,
//o.gd_creation_date,o.buyer_delivery_date,o.buyer_profile_id,bp.day_before_delivary,
//(select event_name from event_info where event_id in(bp.multi_events)) event_name
//FROM orders o
//JOIN
//    buyer_profile bp ON o.buyer_profile_id = bp.buyer_profile_id
//JOIN
//    event_wise_buyer ewu ON bp.buyer_id = ewu.buyer_id
//JOIN
//    buyer b ON b.buyer_id = bp.buyer_id";

                    $sql_for_user_list = "SELECT order_id,o.buyer_id,b.buyer_name,bp.multi_events,
o.gd_creation_date,o.buyer_delivery_date,o.buyer_profile_id,bp.day_before_delivary
FROM orders o
JOIN
    buyer_profile bp ON o.buyer_profile_id = bp.buyer_profile_id
JOIN
    buyer b ON b.buyer_id = bp.buyer_id";
                    $res_for_user_list = mysqli_query($con, $sql_for_user_list);
                    while ($row = mysqli_fetch_assoc($res_for_user_list))
                    {
                    ?>
                    <tr>
                        <td><?php echo $s1; ?></td>
                        <td><?php echo $row['order_id']; ?></td>
                        <td><?php echo $row['gd_creation_date']; ?></td>
                        <td><?php echo $row['buyer_delivery_date']; ?></td>
                        <td><?php echo $row['buyer_name']; ?></td>
                        <td><?php
                            $multi_events = $row['multi_events'];
                            $query2 = "SELECT * from event_info where event_id IN ($multi_events)";
                            $res_for_query2 = mysqli_query($con, $query2);
                            $rows = mysqli_fetch_all($res_for_query2, MYSQLI_ASSOC);
                            // Loop through the rows
                            foreach ($rows as $roww) {
                                $event_name = $roww['event_name'];
                                $total_day = $roww['total_day'];
                                echo "$event_name<br>";
//                                echo "$total_day<br>";
                            }
//                            $gd_creation_date = date('d', strtotime($row['gd_creation_date']));
//                            echo $gd_creation_date;
                            ?>
                        </td>


                        <td>
                            <?php
                            $gd_creation_date = date('d', strtotime($row['buyer_delivery_date']));
                            $gd_creation_month = date('m', strtotime($row['buyer_delivery_date']));
                            $gd_creation_year = date('y', strtotime($row['buyer_delivery_date']));
                            $gd_creation_date_int = intval($gd_creation_date);
//                            echo $gd_creation_date;
//                            exit();
                            $day_before_delivery = $row['day_before_delivary'];
                            $day_before_delivery = explode(",", $day_before_delivery);
                            foreach ($day_before_delivery as $days){
//                                echo "$days<br>";
//                             $total_day_remain = $gd_creation_date_int - $days;
                                // Assuming $gd_creation_date_int and $days are already defined and have numeric values or set to 0.

// Check if $gd_creation_date_int and $days are numeric, if not, set them to 0.
                                $gd_creation_date_int = is_numeric($gd_creation_date_int) ? $gd_creation_date_int : 0;
                                $days = is_numeric($days) ? $days : 0;

// Perform the calculation and store the result in $total_day_remain.
                                $total_day_remain = $gd_creation_date_int - $days;


//                             $total_day_remain = (isset($gd_creation_date_int)?$gd_creation_date_int:0) - (isset($days)?$days:0);
//                             $total_day_remain = (isset($gd_creation_date_int)?$gd_creation_date_int:0)-(isset($total_day_int)?$total_day_int:0);
//                             echo isset($total_day_int)?$total_day_int:0;
//                             $today = date('j');
//                             echo isset($total_day_remain)?$total_day_remain:0;
//                             echo $total_day_remain.'<br>';
                             echo $total_day_remain.'-'.$gd_creation_month.'-'.$gd_creation_year.'<br>';
                            }
//                            exit();
                            ?>
                        </td>
<!--                        </td>-->
                        <td>
                            <?php
                            if ('Approved' === 'Approved') {
                                echo '<button type="submit" id="" name="" class="btn btn-primary btn-xs" disabled>Approved</button>';
                            } else {
                                echo '<button type="submit" id="" name="" class="btn btn-danger btn-xs" disabled>Cross</button>';
                            }
                            ?>
                        </td>
                        <td>
                            <button type="submit" id="" name="" class="btn btn-primary btn-xs" onclick="load_page('user/approve.php?order_id=<?php
                            ?>')"> Approve </button>
                            <!--                            <button type="submit" id="" name="" class="btn btn-danger btn-xs" onclick="load_page('user/user_deleting.php?user_id=<?php
                            /*                        */?>')"> Delete </button>-->
                        </td>
                        <!--                        <td>
                            <button type="submit" id="" name="" class="btn btn-primary btn-xs" onclick="load_page('user/edit_user.php?user_id=<?php /*echo $row['user_id']*/
                        ?>')"> Edit </button>
                            <button type="submit" id="" name="" class="btn btn-danger btn-xs" onclick="load_page('user/user_deleting.php?user_id=<?php /*echo $row['user_id']*/
                        ?>')"> Delete </button>
                        </td>-->
                        <?php

                        $s1++;
                        }
                        ?>
                    </tr>
                    </tbody>
                </table>

            </div> <!-- End of <div class="form-group form-group-sm" -->
            <script>
                $(document).ready(function () {
                    $('#datatable-buttons').DataTable({
                        initComplete: function () {
                            this.api().columns().every(function () {
                                var column = this;
                                var select = $('<select><option value=""></option></select>')
                                    .appendTo($(column.footer()).empty())
                                    .on('change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );

                                        column
                                            .search(val ? '^' + val + '$' : '', true, false)
                                            .draw();
                                    });

                                column.data().unique().sort().each(function (d, j) {
                                    select.append('<option value="' + d + '">' + d + '</option>')
                                });
                            });
                        }
                    });
                });
            </script>


        </form>
        <!-- End Of <form class="form-horizontal" action="POST" style="margin-top:10px;" name="user_list_form" id="user_list_form"> -->

    </div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->