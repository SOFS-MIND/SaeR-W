<?php
error_reporting (E_ALL ^ E_NOTICE);
include_once 'libs/class.database.php';
include_once 'libs/class.session.php';
include_once 'libs/functions.php';
include_once 'libs/tables.config.php';
session_start();
$session= new Session();

?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Blank Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
 <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

     <?php include 'includes/header.php'; ?>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <?php include 'includes/side_menu.php'; ?>
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Stock
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashbord</a></li>
            <li><a href="#">stock</a></li>
          </ol>
        </section>
         <?php 
             if($_GET['mode'] == "edit" || $_GET['mode'] == "required" ) {
				
            global $database, $db;
			if($_GET[rid] == "")
			{
            $qry="SELECT * from `".TBL_COMMEN_PRODUCT_STOCK."` as stk LEFT JOIN  `".TBL_REQUIRED."` as ret on stk.id=ret.stock_IDFK where stk.id=".$_GET['id']."";
			}
			else{
			 $qry="SELECT * from `".TBL_COMMEN_PRODUCT_STOCK."` as stk LEFT JOIN  `".TBL_REQUIRED."` as ret on stk.id=ret.stock_IDFK where stk.id=".$_GET['id']." AND ret.id=".$_GET['rid']."";
			}
            $result = $database->query( $qry );
			$row = $database->fetch_array( $result );
			
			 }
            ?>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box">
                
                <div class="box-body">
                  <form role="form" action="bearings_action.php" id="stock" enctype="multipart/form-data" method="post">
                  <?php if($_GET['mode'] == "") {?>
				<input type="hidden" name="mode" value="add" />
				<?php }
				elseif( $_GET['mode'] == "required") 
				{ ?>
					<input type="hidden" name="mode" value="required">
					<input type="hidden" name="stock_id" value="<?php echo $_GET['id']; ?>">
					<input type="hidden" name="id" value="<?php echo $_GET['rid']; ?>">
			<?php }
				elseif ( $_GET['mode'] == "edit") {?>
                <input type="hidden" name="mode" value="edit" />
				<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                <?php }?>
				                    <div class="row">
                                     <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="Patten number">Product Name</label>
                                            <input type="text" class="form-control" id="product_name" name="product_name" value="BEARING" readonly>
                                        </div>
								     </div>
				                      <div class="col-md-6">
                                     
                                       <div class="form-group">
                                            <label for="exampleInputFile">Make</label>
                                             <input type="text" class="form-control" id="make" name="make" value="<?php echo $row['make'];?>" <?php if($_GET['mode'] == "required") { echo "readonly"; } ?> >
                                        </div>
                                        </div>
				                       
									 </div>
									<div class="row">
                                   
										 <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="Patten number">Size</label>
                                            <input type="text" class="form-control" id="size" name="size" value="<?php  echo $row['size'];  ?>" <?php if($_GET['mode'] == "required") { echo "readonly"; } ?> >
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                     
                                       <div class="form-group">
                                            <label for="exampleInputFile">Quantity</label>
                                             <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $row['qty'];?>" <?php if($_GET['mode'] == "required") { echo "readonly"; } ?>>
                                        </div>
                                        </div>
										</div>
										 <div class="row">
                                        <div class="col-md-6">
                                         <div class="form-group">
                                            <label for="exampleInputFile">Rate</label>
                                             <input type="text" class="form-control" id="rate" name="rate" value="<?php echo $row['rate'];?>" <?php if($_GET['mode'] == "required") { echo "readonly"; } ?>>
                                        </div>
                                        </div>
										<?php if($_GET['mode'] == "required") { ?>
										
										 <div class="col-md-6">
                                         <div class="form-group">
                                            <label for="exampleInputFile">Required Quantity</label>
                                             <input type="text" class="form-control" id="required" name="required" value="<?php if($_GET['rid'] != "") {echo $row['required_qty']; }?>" <?php if($row['required_qty'] != 0 && $_GET['rid'] != "") { echo "readonly"; } ?>>
                                        </div>
                                        </div>
										</div>
										 <div class="row">
										<div class="col-md-6">
                                         <div class="form-group">
                                            <label for="exampleInputFile">Purpose</label>
                                             <input type="text" class="form-control" id="purpose" name="purpose" value="<?php if($_GET['rid'] != "") { echo $row['purpose']; }?>"  <?php if($row['purpose'] != "" && $_GET['rid'] != "") { echo "readonly"; } ?>>
                                        </div>
                                        </div>
										<?php if($_GET['rid'] != "") {?>
										<div class="col-md-6">
                                         <div class="form-group">
                                            <label for="exampleInputFile" >Status</label>
                                            <select  class="form-control" name="status" id="status">
											  <option value="1" <?php if($row['status'] == 1) echo "selected"; ?>>pending</option>
											  <option value="0"  <?php if($row['status'] == 0) echo "selected";  ?>>closed</option>
											</select>
                                        </div>
                                        </div>
										</div>
										<?php } } ?>
                                       <!-- <div class="col-md-3">
                                         <div class="form-group">
                                            <label for="exampleInputFile">To.Wt</label>
                                             <input type="text" class="form-control" id="to_wt" name="to_wt" value="<?php echo $row['to_waite']; ?>">
                                        </div>
                                        </div>-->
				     <div class="col-lg-12">
                          
                                      
                                       
                                    	    <div class="box-footer">
											<div class="form-group col-md-1 pull-right">

 										   <button type="submit" value="Save" name="action" class="btn btn-primary">Submit</button>
					                       </div>
											<div class="form-group col-md-1 pull-right">

											<a href="#" onclick="window.history.go(-1); return false;" class="btn btn-warning"> Cancel </a>    
                                           </div>
										   
						                  </div>
                                    	</div>
				     </div>
                                </form>
               
                </div>
            </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

     

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<!----- validation ------->
	<script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.js"></script>
	<script>
        $().ready(function() {
        	$.validator.addMethod("alphabetOnly", function(value, element) {
                return this.optional(element) || /^[a-z\-\s]+$/i.test(value);
            }, "Text must contain only alphabets.");
            
     		 $.validator.addMethod("numberOnly", function(value, element) {
                 return this.optional(element) || /^[0-9\-\s]+$/i.test(value);
             }, "Text must contain only letters, numbers, or dashes.");

             $.validator.addMethod("mobile", function(value, element) {
    				return this.optional(element) || /^[0-9\-\+\s]+$/i.test(value);
    			}, "Plese give the correct patten number");
				$.validator.addMethod("make", function(value, element) {
    				return this.optional(element) || /^[a-z\-\+\s]+$/i.test(value);
    			}, "Plese give the correct patten number");
           
        	$("#stock").validate({
				rules: {
					product_name: {
						required:true
				                 },
                    size: {
						required:true
					},
                    make:{
						required:true
					},
                   quantity:
						{
							required:true,
							number:true
						},
                    rate:
					{
						required:true,
						number:true
					},
					  required:
					  {
						  required:true,
						  number:true
					  },
                        purpose:
						{
							required:true,
							alphabetOnly:true
						}					  
				},
		      messages: {
		    	  product_name: {
						required: "Enter the product name"
				        },
								  size: {
						required: "Enter the size"
						 },
						make: {
						required:"Enter the make name"
						},
						quantity:
						{
							required:"Enter the quantity"
						},
						  rate:
					     {
						required:"Enter the rate"
					     },
						  required:
					  {
						  required:"Enter the required quantity",
						  
					  },
                        purpose:
						{
							 required:"Enter the purpose of requirement",
							 alphabetOnly:"Enter alphabets only"
						}						
				          
                      
			            }
        });
        });
   
        </script>

    <!-- Bootstrap 3.3.5 -->
    <script src="css/bootstrap/js/bootstrap.min.js"></script>
       <!-- DataTables -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="assets/dist/js/demo.js"></script>
  
  </body>
</html>
