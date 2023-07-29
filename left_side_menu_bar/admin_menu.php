<?php
session_start();
require_once("login/db_session_chk.php");

$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
$user_type=$_SESSION['user_type'];
$select_sql_for_user="SELECT `profile_picture` FROM `user_login` WHERE `user_name`='$user_name'";
$result= mysqli_query($con, $select_sql_for_user) or die(mysqli_error($con));
$row=mysqli_fetch_assoc($result);
?>

<aside class="main-sidebar">
		  <!-- sidebar: style can be found in sidebar.less -->
		  <section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					  <div class="pull-left image">
						<img src="img/<?php echo $row['profile_picture'] ?>" class="img-circle" alt="User Image">
					  </div>
					  <div class="pull-left info">
						<p><?php echo $user_name?></p>
						<a><i class="fa fa-circle text-success"></i> Online</a>
					  </div>
				</div>
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu" data-widget="tree">

					  <li class="header"> REPORTS </li>
					  <li><a href=""><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a> </li>
						<li class="treeview" id="main_product_menu">

					 			 <a href="#">
					 			 <i class="fa fa-barcode"></i>
					 			 <span>Approve Events</span>
					 			 <span class="pull-right-container">
					 					 <i class="fa fa-angle-left pull-right"></i>
					 			 </span>
					 		 </a>
					 		 <ul class="treeview-menu">
								 <li><a onClick="load_page('events/events.php')"><i class="fa fa-circle-o"></i>Events</a></li>
                                 <li><a onClick="load_page('events/eventsWiseBuyerAndGD.php')"><i class="fa fa-circle-o"></i>eventsWiseBuyerAndGD</a></li>
                             </ul> <!-- End of <ul class="treeview-menu"> -->
					  </li> <!-- End of <li class="treeview" id="main_product_menu"> -->

					  <li class="treeview" id="main_product_menu">
					  			<a href="#">
								  <i class="fa fa-barcode"></i>
								  <span>User Menu</span>
								  <span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
								  </span>
								</a>
								<ul class="treeview-menu">
								  <li><a onClick="load_page('user/user_info.php')"><i class="fa fa-circle-o"></i>Add User</a></li>
								  <li><a onClick="load_page('user/user_list.php')"><i class="fa fa-circle-o"></i>User List</a></li>
								</ul> <!-- End of <ul class="treeview-menu"> -->
					  </li> <!-- End of <li class="treeview" id="main_product_menu"> -->
					  <li class="treeview" id="settings_menu">
					  			<a href="#">
								  <i class="fa fa-barcode"></i>
								  <span>Settings</span>
								  <span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
								  </span>
								</a>
								<ul class="treeview-menu">
								  <li><a onClick="load_page('settings/buyer/buyer.php')"><i class="fa fa-circle-o"></i>Add Buyer</a></li>
<!--                                    <li><a onClick="load_page('user/department_info.php')"><i class="fa fa-circle-o"></i>Add Department</a></li>-->
                                    <li><a onClick="load_page('settings/department/form.php')"><i class="fa fa-circle-o"></i>Department</a></li>
<!--                                    <li><a onClick="load_page('user/designation_info.php')"><i class="fa fa-circle-o"></i>Add Designation</a></li>-->
                                    <li><a onClick="load_page('settings/designation/form.php')"><i class="fa fa-circle-o"></i>Designation</a></li>
                                    <li><a onClick="load_page('user/event_info.php')"><i class="fa fa-circle-o"></i>Add Events</a></li>
<!--                                    <li><a onClick="load_page('settings/event_wise_buyer/event_wise_buyer.php')"><i class="fa fa-circle-o"></i>Events wise Buyer</a></li>-->
                                    <li><a onClick="load_page('settings/event_wise_user/form.php')"><i class="fa fa-circle-o"></i>Event Wise User</a></li>
<!--                                    <li><a onClick="load_page('settings/order/form.php')"><i class="fa fa-circle-o"></i>Order</a></li>-->
                                    <li><a onClick="load_page('settings/single_process/single_process_create_form.php')"><i class="fa fa-circle-o"></i>Buyer Profile Create</a></li>

                                    <li><a onClick="load_page('settings/new_order/order_create_form.php')"><i class="fa fa-circle-o"></i>Create Order</a></li>
                                    <!-- <li><a onClick="load_page('settings/order_wise_event_and_user/form.php')"><i class="fa fa-circle-o"></i>Order Wise Event and User</a></li> -->
                                    <li><a onClick="load_page('settings/order_n_buyer_profile/order_n_buyer_profile_create.php')"><i class="fa fa-circle-o"></i>Event wise Order & Buyer Profile</a></li>


                                </ul> <!-- End of <ul class="treeview-menu"> -->
					  </li> <!-- End of <li class="treeview" id="main_product_menu"> -->
							<li class="treeview" id="main_product_menu">
									 <a href="#">
									 <i class="fa fa-barcode"></i>
									 <span>Reports</span>
									 <span class="pull-right-container">
											 <i class="fa fa-angle-left pull-right"></i>
									 </span>
								 </a>
								 <ul class="treeview-menu">
									 <li><a onClick="load_page('report/events.php')"><i class="fa fa-circle-o"></i>Events</a></li>
								 </ul> <!-- End of <ul class="treeview-menu"> -->
							</li> <!-- End of <li class="treeview" id="main_product_menu"> -->
				</ul> <!-- End of <ul class="sidebar-menu" data-widget="tree"> -->
		  </section>
		  <!-- /.sidebar -->
</aside> <!-- End of <aside class="main-sidebar"> -->
