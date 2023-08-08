<?php
session_start();
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
//echo '<pre>';
//print_r($obj);
//echo '<pre>';

$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];

?>
<script type='text/javascript' src='settings/new_order/order_create_form_validation.js'></script>

<style>

    .form-group		/* This is for reducing Gap among Form's Fields */
    {

        margin-bottom: 5px;

    }

</style>

<script>

    function Remove_Value_Of_This_Element(element_name)
    {

        document.getElementById(element_name).value='';
        var alternate_field_of_date = "alternate_"+element_name;

        if(typeof(alternate_field_of_date) != 'undefined' && alternate_field_of_date != null) // This is for deleting Alternative Field of Date if exists
        {
            document.getElementById(alternate_field_of_date).value='';
        }

    }

    function Reset_Radio_Button(radio_element)
    {
        var radio_btn = document.getElementsByName(radio_element);
        for(var i=0;i<radio_btn.length;i++)
        {
            radio_btn[i].checked = false;
        }
    }

    function Reset_Checkbox(checkbox_element)
    {
        for(var i=0;i<checkbox_element.length;i++)
        {

            checkbox_element[i].checked = false;

        }
    }
</script>

<script>
    function sending_data_of_order_info_form_for_saving_in_database()
    {
        var validate = Order_Form_Validation();
        var url_encoded_form_data = $("#order_info_form").serialize(); //This will read all control elements value of the form
        if(validate != false)
        {

            $.ajax({
                url: 'settings/new_order/order_create_form_saving.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: url_encoded_form_data,
                success: function( data, textStatus, jQxhr )
                {
                    alert(data);

                    $.ajax({
                        url: 'settings/new_order/order_create_form_list.php',
                        dataType: 'text',
                        type: 'post',
                        contentType: 'application/x-www-form-urlencoded',
                        data: url_encoded_form_data,
                        success: function( data, textStatus, jQxhr )
                        {
                            document.getElementById('table_body').innerHTML = data;
                        },
                        error: function( jqXhr, textStatus, errorThrown )
                        {
                            //console.log( errorThrown );
                            alert(errorThrown);
                        }
                    }); // End of $.ajax({

                },
                error: function( jqXhr, textStatus, errorThrown )
                {
                    //console.log( errorThrown );
                    alert(errorThrown);
                }
            }); // End of $.ajax({

        }//End of if(validate != false)

    }//End of function sending_data_of_order_info_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

    <div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

        <div class="panel-heading" style="department:#191970;"><b>Order</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item"><a onclick="load_page('settings/order/form.php')">Order</a></li>
            </ol>
        </nav>

        <form class="form-horizontal" action="" style="margin-top:10px;" name="order_info_form" id="order_info_form">

            <div class="form-group form-group-sm" id="form-group_for_order_id">
                <label class="control-label col-sm-3" for="gd" style="department:#00008B;">GD :</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="gd" name="gd" placeholder="Enter GD" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('order_id')"></i>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_country_of_origin">
                <label class="control-label col-sm-3" for="buyer_profile_id" style="department:#00008B;">Select Buyer Profile:</label>
                <div class="col-sm-5">
                    <select  class="form-control add_buyer" id="buyer_profile_id" name="buyer_profile_id"
                             onchange="SelectValuesFromBuyerProfile(this.value)">
                        <option select="selected" value="select" disabled'>Select Buyer Profile</option>

                        <?php
                        //                        $sql = "select * from `buyer_profile`";
                        $sql = "select buyer_profile_id, buyer_name,fabric_type,weave_type,p_requirement from buyer_profile bp JOIN buyer b on b.buyer_id = bp.buyer_id ORDER BY buyer_profile_id";
                        $result= mysqli_query($con,$sql) or die(mysqli_error);
                        while( $row = mysqli_fetch_array( $result))
//                          $buyer_name =  $row['buyer_name'];
//                          $weave_type =  $row['weave_type'];
//                          $fabric_type =  $row['fabric_type'];
////                          $buyer_profile = $buyer_name.$weave_type.$fabric_type;
//                          $buyer_profile = $buyer_name =  $row['buyer_name'].$weave_type =  $row['weave_type']. $fabric_type =  $row['fabric_type'];;
                        {
                            echo "<option value='" . $row['buyer_profile_id'] . "'>  buyer_name (" . $row['buyer_name'] . "), fabric(" . $row['fabric_type'] ."), weave(" . $row['weave_type'] . "), Req(" . $row['p_requirement'] . ")</option>";
//                              echo '<option value="'.$row['buyer_profile_id'].'">'.$row['buyer_name'].'_'.$row['fabric_type'].'_'.$row['weave_type'].'_'.$row['p_requirement'].'</option>';
//                            echo '<option value="'.$row['buyer_profile_id'].'">'.$row['buyer_profile_id'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_buyer">
                <label class="control-label col-sm-3" for="buyer">Buyer:</label>
                <div class="col-sm-5">
                    <!-- Code For Fetching Data from drop-down list From Buyer(table) -->
                    <select  class="form-control for_auto_complete" id="buyer_id" name="buyer_id">
                        <option select="selected" value="select">Select Buyer</option>
                        <?php
                        $buyer_id = $row['buyer_id'];
                        $sql_for_buyer = 'select * from `buyer` ';
                        $result_for_buyer = mysqli_query($con,$sql_for_buyer) or die(mysqli_error());
                        while( $row_for_buyer = mysqli_fetch_array( $result_for_buyer))
                        {
                            if($buyer_id == $row_for_buyer['buyer_id'])
                            {
                                echo '<option selected value="'.$row_for_buyer['buyer_id'].'">'.$row_for_buyer['buyer_name'].'</option>';
                            }
                            else{
                                echo '<option value="'.$row_for_buyer['buyer_id'].'">'.$row_for_buyer['buyer_name'].'</option>';
                            }
                        }

                        ?>
                    </select><!-- Code For Fetching Data from drop-down list From Buyer(table) -->
                </div>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_department"> -->


            <div class="form-group form-group-sm" id="form-group_for_style">
                <label class="control-label col-sm-3" for="style" style="department:#00008B;">Style Name:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="style" name="style" placeholder="Enter Style Name" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('style')"></i>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_color">
                <label class="control-label col-sm-3" for="color" style="department:#00008B;">Color Name:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="color" name="color" placeholder="Enter Color Name" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('color')"></i>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_fabric_qty">
                <label class="control-label col-sm-3" for="fabric_qty" style="department:#00008B;">Fabrics Quantity (YDS)
                    :</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="fabric_qty" name="fabric_qty" placeholder="Enter Fabrics Quantity" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('fabric_qty')"></i>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_designation" style="margin-bottom: 20px;">
                <label class="control-label col-sm-3" for="fabric_type"
                       >Fabric Type :</label>
                <div class="col-sm-5">
                    <select id="fabric_type" class="form-control for_auto_complete" name="fabric_type">
                        <option select="selected" value="select">Select Fabric Type</option>

                        <option value='yarn_died'>Yarn Dyed </option>

                        <option value='solid'>Solid</option>

                        <option value='print'>Print </option>

                        <option value='rfd'>RFD </option>

                    </select>
                </div>
            </div>
            <div class="form-group form-group-sm"  style="margin-bottom: 20px;">
                <label class="control-label col-sm-3" for="weave_type"
                      >Weave Type :</label>
                <div class="col-sm-5">
                    <select id="weave_type" class="form-control for_auto_complete" name="weave_type">
                        <option select="selected" value="select">Select Weave Type</option>

                        <option value='regular'>Regular </option>

                        <option value='twisting'>Twisting</option>

                    </select>
                </div>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_designation" style="margin-bottom: 20px;">
                <label class="control-label col-sm-3" for="p_requirement"
                      >Print Requirements :</label>
                <div class="col-sm-5">
                    <select id="p_requirement" class="form-control for_auto_complete" name="p_requirement">
                        <option select="selected" value="select">Select Print Requirements</option>

                        <option value='yes'>Yes </option>

                        <option value='no'>No</option>

                    </select>
                </div>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_p_finish">
                <label class="control-label col-sm-3" for="p_finish">Performance Finish :</label>
                <div class="col-sm-5">
                    <!-- Code For Fetching Data from drop-down list From Buyer(table) -->
                    <select  class="form-control for_auto_complete" id="p_finish" name="p_finish">
                        <option select="selected" value="select"> Select Performance Finish</option>

                        <option value='yes'>Yes </option>

                        <option value='no'>No</option>
                    </select><!-- Code For Fetching Data from drop-down list From Buyer(table) -->
                </div>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_department"> -->

            <div class="form-group form-group-sm" id="form-group_for_location">
                <label class="control-label col-sm-3" for="fabrics_booking_date" >Fabrics Booking Date :</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="fabrics_booking_date" name="fabrics_booking_date" placeholder=" Enter Fabrics Booking Date" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('fabrics_booking_date')"></i>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_location">
                <label class="control-label col-sm-3" for="buyer_delivery_date">Buyer Delivery Date :</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="buyer_delivery_date" name="buyer_delivery_date" placeholder="Enter Buyer Delivery Date" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('buyer_delivery_date')"></i>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_gd_creation_date">
                <label class="control-label col-sm-3" for="gd_creation_date" style="department:#00008B;">GD Creation Date :</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="gd_creation_date" name="gd_creation_date" placeholder="Enter GD Creation Date" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('gd_creation_date')"></i>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_lead_time">
                <label class="control-label col-sm-3" for="lead_time" style="department:#00008B;">Lead Time :</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="lead_time" name="lead_time" placeholder="Enter Lead Time" required>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('lead_time')"></i>
            </div>

            <div class="form-group form-group-sm">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="button" class="btn btn-primary" onClick="sending_data_of_order_info_form_for_saving_in_database()">Submit</button>
                    <button type="reset" class="btn btn-success">Reset</button>
                </div>
            </div>

        </form>

    </div></br> <!-- End of <div class="panel panel-default"> --></br>




<!--    <div class="panel panel-default" style="margin-top: 50px;">-->

<!--        <div class="form-group form-group-sm">-->
<!--            <label class="col-sm-offset-7 control-label col-sm-1" for="search">Search</label>-->
<!--            <div class="col-sm-4">-->
<!--                <input type="text" id="my_input" class="form-control " onkeyup="my_function()" placeholder="Please Type Order Name Keyword">-->
<!--            </div>-->
<!--        </div> -->


        <div class="form-group form-group-sm">
            <label class="control-label col-sm-5" for="search">Order List</label>
        </div> <!-- End of <div class="form-group form-group-sm" -->


        <div class="form-group form-group-sm" >
            <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                <tr >
                    <th style="text-align: center">SI</th>
                    <th style="text-align: center">Order Id</th>
                    <th style="text-align: center">Gd</th>
                    <th style="text-align: center">Buyer Name</th>
                    <th style="text-align: center">Style</th>
                    <th style="text-align: center">Color</th>
                    <th style="text-align: center">Fabric Quantity</th>
                    <th style="text-align: center">Fabric Type</th>
                    <th style="text-align: center">Weave Type</th>
                    <th style="text-align: center">Printing Requirement</th>
                    <th style="text-align: center">Performance Finish</th>
                    <th style="text-align: center">Fabrics Booking Date</th>
                    <th style="text-align: center">Buyer Delivery Date</th>
                    <th style="text-align: center">GD Creation Date</th>
                    <th style="text-align: center">Lead Time</th>

                    <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody id="table_body">
                <?php
                $s1 = 1;
                $sql_for_order = "
                 SELECT *, orders.order_id o_id from orders
                 join buyer on buyer.buyer_id = orders.buyer_id
                 ORDER BY orders.order_id ASC";

                $res_for_order = mysqli_query($con, $sql_for_order);

                while ($row = mysqli_fetch_assoc($res_for_order))
                {
                ?>

                <tr>
                    <td><?php echo $s1; ?></td>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['gd']; ?></td>
                    <td><?php echo $row['buyer_name']; ?></td>
                    <td><?php echo $row['style']; ?></td>
                    <td><?php echo $row['color']; ?></td>
                    <td><?php echo $row['fabric_qty']; ?></td>
                    <td><?php echo $row['fabric_type']; ?></td>
                    <td><?php echo $row['weave_type']; ?></td>
                    <td><?php echo $row['p_requirement']; ?></td>
                    <td><?php echo $row['p_finish']; ?></td>
                    <td><?php echo $row['fabrics_booking_date']; ?></td>
                    <td><?php echo $row['buyer_delivery_date']; ?></td>
                    <td><?php echo $row['gd_creation_date']; ?></td>
                    <td><?php echo $row['lead_time']; ?></td>
<!--                    <td>--><?php //echo $row['color']; ?><!--</td>-->
                    <td>


                        <button type="submit" id="edit_department" name="edit_department"  class="btn btn-primary btn-xs" onclick="load_page('settings/new_order/edit_order_create_form.php?order_id=<?php echo $row['o_id'] ?>')"> Edit </button>
                        <span>  </span>

                        <button type="submit" id="delete_department" name="delete_department"  class="btn btn-danger btn-xs" onclick="load_page('settings/new_order/order_deletion.php?order_id=<?php echo $row['o_id'] ?>')"> Delete </button>
                    </td>
                    <?php

                    $s1++;
                    }
                    ?>
                </tr>
                </tbody>
            </table>


        </div> <!-- End of <div class="form-group form-group-sm" -->

        <script>
            function my_function() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("my_input");
                filter = input.value.toUpperCase();
                table = document.getElementById("datatable-buttons");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
            $(document).ready( function () {
                $('#datatable-buttons').DataTable();
            } );
            function SelectValuesFromBuyerProfile(buyer_profile) {

                $.ajax({
                    url: 'settings/new_order/buyerProfileData.php',
                    dataType: 'text',
                    type: 'post',
                    contentType: 'application/x-www-form-urlencoded',
                    data: {buyer_profile: buyer_profile},
                    success: function (data, textStatus, jQxhr) {
                        alert(data);
                        const myArray = data.split('?fs?');
                        //var word = myArray[1];

                        //var stitaching_itemd = myArray[1];
                        var buyer_id = myArray[1];
                        var fabric_type = myArray[2];
                        var weave_type = myArray[3];
                        var p_requirement = myArray[4];

                        document.getElementById('buyer_id').value = buyer_id;
                        // document.getElementById('cutting_length').readOnly = true;

                        document.getElementById('fabric_type').value = fabric_type;
                        document.getElementById('weave_type').value = weave_type;
                        document.getElementById('p_requirement').value = p_requirement;
                        // document.getElementById('width').readOnly = true;

                    },
                    error: function (jqXhr, textStatus, errorThrown) {
                        //console.log( errorThrown );
                        alert(errorThrown);
                    }
                });
                onchange = "width_meter_change(this.value)"
            }

        </script>

    </div> <!-- End of <div class="panel panel-default"> -->


</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->
