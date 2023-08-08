<?php
session_start();
include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
//$p_requirement = $_POST['p_requirement'];

//$sql = " SELECT * FROM buyer_profile ";
//$result = mysqli_query($con, $sql) or die(mysqli_error($con));
//$row = mysqli_fetch_array($result);

?>
<script type='text/javascript' src='settings/single_process/single_process_form_validation.js'></script>

<style>

    .form-group /* This is for reducing Gap among Form's Fields */
    {

        margin-bottom: 5px;

    }

</style>

<div class="col-sm-12 col-md-12 col-lg-12">

    <div class="panel panel-default">  <!--This div will create a block/panel for FORM -->

        <div class="panel-heading" style="color:#191970;"><b>Buyer Yarn & Solid</b></div>
        <!--This will create a upper block for FORM (Just Beautification) -->

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item"><a onclick="load_page('settings/single_process/single_process_create_form.php')">Create Buyer Yarn & Solid</a></li>
            </ol>
        </nav>

        <form class="form-horizontal yarn_dyed_wise_buyer_info_form" action="" style="margin-top:10px;" name="yarn_dyed_wise_buyer_info_form"
              id="yarn_dyed_wise_buyer_info_form" enctype="multipart/form-data" data-parsley-validate>

            <div class="form-group form-group-sm" id="form-group_for_buyer" style="margin-bottom: 20px;">
                <label class="control-label col-sm-3" for="buyer_id"
                       >Buyer:</label>
                <div class="col-sm-5">
                    <select class="form-control for_auto_complete" id="buyer_id" name="buyer_id">
                        <option select="selected" value="select">Select Buyer</option>
                        <?php
                        $sql = 'select * from `buyer` order by `buyer_name`';
                        $result = mysqli_query($con, $sql) or die(mysqli_error());
                        while ($row = mysqli_fetch_array($result)) {
                           echo '<option value="' . $row['buyer_id'] . '">' . $row['buyer_name'] . '</option>';
                       }
                        ?>
                    </select>
                </div>
            </div>

<!--            <div class="form-group form-group-sm" style="margin-bottom: 20px;">-->
<!--                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fabric_finish">Day before Delivery<span class="required">*</span></label>-->
<!--                <div class="col-md-5 col-sm-6 col-xs-12">-->
<!--                    <input type="text" id="day_before_delivary" name="day_before_delivary[]" class="form-control" multiple="multiple">-->
<!--                </div>-->
<!--            </div>-->

            <div class="form-group form-group-sm" id="form-group_for_designation" style="margin-bottom: 20px;">
                <label class="control-label col-sm-3" for="fabric_type"
                >Fabric Type</label>
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
                      >Weave Type</label>
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
                       >Print Requirements</label>
                <div class="col-sm-5">
                    <select id="p_requirement" onchange="details_information()" class="form-control for_auto_complete" name="p_requirement">
                        <option select="selected" value="select">Select Print Requirements</option>

                        <option value='yes'>Yes </option>

                        <option value='no'>No</option>

                    </select>
                </div>
            </div>

            <!-- Assuming you have already established a database connection $con -->

<!--                <div class="form-group form-group-sm" id="form-group_for_multi_events" style="margin-bottom: 20px;">-->
<!--                    <div class="container" id="multi_events">-->
<!--                        --><?php
//                        // Prepared statement to prevent SQL injection
//                        $sql_for_events = "SELECT event_id, event_name, total_day FROM event_info";
//                        $result_for_events = mysqli_query($con, $sql_for_events) or die(mysqli_error($con));
//
//                        while ($row_for_events = mysqli_fetch_array($result_for_events)) {
//                            ?>
<!--                            <div class="col-md-12 form-group form-check" style="text-align: left; margin-left: 15px; padding-left: 20px;">-->
<!--                                <label>-->
<!--                                    <input type="checkbox" name="event_names[]" value="--><?php //echo $row_for_events['event_id']; ?><!--">-->
<!--                                    --><?php //echo $row_for_events['event_name']; ?>
<!--                                </label>-->
<!--                                <input type="text" name="event_days[--><?php //echo $row_for_events['event_id']; ?><!--]" placeholder="Event Day">-->
<!--                            </div>-->
<!--                            --><?php
//                        }
//                        ?>
<!--                    </div>-->
<!--                </div>-->



                        <div class="container" id="details_info">
                <div class="row" style="text-align: center; margin: 15px 20px;"><strong>Select Events And Days</strong></div>
                <div class="form-group form-group-sm" id="form-group_for_multi_events" style="margin-bottom: 20px;">
                    <div class="container" id="multi_events">
                        <?php
                        $sql_for_events = " SELECT event_id,event_name,total_day FROM event_info ";
                        $result_for_events = mysqli_query($con, $sql_for_events) or die(mysqli_error($con));
                        while ($row_for_events = mysqli_fetch_array($result_for_events)) { ?>
                             <?php echo '<div class="col-md-12 form-group form-check" style="text-align: center; margin-left: 15px;padding-left: 20px;">';
                                echo '<td>
                               <input type="checkbox" name="event_names[]" value=" ' . $row_for_events['event_id'] . ' " > ' . $row_for_events['event_name'] . ' '; ?>
                               <input type="text" id="day_before_delivary" value="<?php echo $row_for_events['total_day']; ?>"
                                      name="day_before_delivary_<?php echo $row_for_events['event_id']; ?>" ?>
                                </td>
                             <?php echo "</div>"; ?>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="form-group form-group-sm">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="button" class="btn btn-primary"
                            onClick="sending_data_of_buyer_profile_form_for_saving_in_database()">Submit
                    </button>
                    <button type="reset" class="btn btn-success">Reset</button>
                </div>
            </div>
</form>

    </div>

    <script>

        function Remove_Value_Of_This_Element(element_name) {

            document.getElementById(element_name).value = '';
            var alternate_field_of_date = "alternate_" + element_name;

            if (typeof (alternate_field_of_date) != 'undefined' && alternate_field_of_date != null) // This is for deleting Alternative Field of Date if exists
            {
                document.getElementById(alternate_field_of_date).value = '';
            }

        }

        function Reset_Radio_Button(radio_element) {

            var radio_btn = document.getElementsByName(radio_element);
            for (var i = 0; i < radio_btn.length; i++) {
                radio_btn[i].checked = false;
            }


        }

        function Reset_Checkbox(checkbox_element) {
            for (var i = 0; i < checkbox_element.length; i++) {

                checkbox_element[i].checked = false;

            }
        }
    </script>

    <script>
        function sending_data_of_buyer_profile_form_for_saving_in_database() {


            var form = document.forms.namedItem("yarn_dyed_wise_buyer_info_form");
            var form_data = new FormData(form);

            if (window.XMLHttpRequest) {
                var xmlhttp = new XMLHttpRequest();
            } else {
                var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.open("POST", "settings/single_process/buyer_profile_data_saving.php", true);
            //xmlhttp.setRequestHeader("Content-type","multipart/form-data");
            xmlhttp.send(form_data);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState != 4) // Means data is not received from server.
                {

                }
                if (xmlhttp.readyState == 4) {
                    var data = xmlhttp.responseText;
                    console.log(data);
                    // alert('Successfully Saved');
                    // success_alert(data, "single_process_create_form.php", "Success!");

                    //alert(Successfully Submitted);
                    // if (data == "Feeding panel ID already exists!" || data == "Feeding panel creation is failed!") {
                    //     fail_alert_2(data, "folding_panel_id", "Sorry!");
                    // } else {
                    //     //success_alert(data);
                    //     success_alert(data, "folding_panel_list.php", "Success!");
                    // }
                }
            }


            //    let buyer_id = $("#buyer_id").val()
            //    let p_requirement = $("#p_requirement").val()
            //    let fabric_type = $("#fabric_type").val()
            //    let weave_type = $("#weave_type").val()
            //  //  let multi_events = $("#multi_events").val()
            //
            //    // alert(buyer_id)
            //    // alert(fabric_type)
            //    // alert(weave_type)
            //    //var validate = Event_wise_buyer_Form_Validation();
            // //   var url_encoded_form_data = $("#user_info_form").serialize(); //This will read all control elements value of the form
            //    var url_encoded_form_data = new FormData(document.getElementById('yarn_dyed_wise_buyer_info_form'));
            //
            //
            //        $.ajax({
            //            url: 'settings/single_process/buyer_profile_data_saving.php',
            //            dataType: 'text',
            //            type: 'post',
            //            contentType: 'application/x-www-form-urlencoded',
            //            data: {
            //                url_encoded_form_data:url_encoded_form_data
            //                // buyer_id: buyer_id,
            //                // p_requirement: p_requirement,
            //                // fabric_type: fabric_type,
            //                // weave_type: weave_type,
            //                // multi_events: multi_events
            //
            //            },
            //            success: function (data, textStatus, jQxhr) {
            //                alert(data);
            //                $("#details_info").html(data);
            //            }
            //        });

        }

        /***************************************************** FOR AUTO COMPLETE********************************************************************/

        $('.for_auto_complete').chosen();


        /***************************************************** FOR AUTO COMPLETE********************************************************************/

        function details_information() {

            let buyer_id = $("#buyer_id").val()
            let p_requirement = $("#p_requirement").val()
            let fabric_type = $("#fabric_type").val()
            let weave_type = $("#weave_type").val()


            if(buyer_id=="select"){
                return "please select buyer";

            }
            if(fabric_type=="select"){
                return "please select fabric type";

            }
            else if(weave_type=="select"){
                return "please select weave type";

            }



            // let barcode=$("#delete_barcode").val()
            // let work_order_number=$("#delete_work_order_number").val()
            $.ajax({
                url: 'settings/single_process/load_events.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: {
                    buyer_id: buyer_id,
                    p_requirement: p_requirement,
                    fabric_type: fabric_type,
                    weave_type: weave_type,

                },
                success: function (data, textStatus, jQxhr) {
                    //console.log(data)
                    //alert(data);
                    $("#details_info").html(data);
                    alert('Selected Successfully');
                }
            });
        }
    </script>



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
            $(document).ready(function () {
                //function to initialize select2
                function initializeSelect2(selectElementObj) {
                    selectElementObj.select2(
                        {
                            width: "100%",
                            tags: true
                        });
                }

                //onload: call the above function
                $(".select2").each(function () {
                    initializeSelect2($(this));
                });
            });


        </script>

    </div>

