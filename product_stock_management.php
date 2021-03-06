<?php
error_reporting (E_ALL ^ E_NOTICE);
include_once 'libs/class.database.php';
include_once 'libs/class.session.php';
include_once 'libs/functions.php';
include_once 'libs/tables.config.php';
session_start();
$session= new Session();
if(!$session->has_logged_in())
{
	redirect_to("index.php");
}
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
            stock Manage
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
          </ol>
        </section>
		
		
         <?php 
            
			if($_REQUEST[product_name])
			{
				
				$wherepatten= "and product_name ='".$_REQUEST[product_name]."'";
     		}
			if($_REQUEST[size])
			{
				$wherepart= "and size ='".$_REQUEST[size]."'";
     		}
			if($_REQUEST[material])
			{
				$wherematerial= "and material ='".$_REQUEST[material]."'";
     		}

			
			$seresh = $_REQUEST["mode"];
			
			if( $seresh != "")
			{
            global $database, $db;
            $qry="SELECT * from `".TBL_COMMEN_PRODUCT_STOCK."` where req_status = 0 $wherepatten $wherepart $wherematerial ORDER BY
                   id ASC";  
				   //print_r($qry);
				   //exit;
            $result = $database->query( $qry );
			}
			elseif( $seresh == "")
			{
				$qry="SELECT * from `".TBL_COMMEN_PRODUCT_STOCK."`  where product_name != 'ROD'  ORDER BY
                   id ASC ";
				$result = $database->query( $qry );
			}
            ?>

        <!-- Main content -->
        <section class="content">
          <?php if($_SESSION["msg"] !="") { ?>
            <div class="alert alert-success alert-dismissable ">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i><?php echo $_SESSION["msg"]; ?> </h4>
                    
                  </div>
		<?php }  elseif($_SESSION["error"] !="") {?>
		   <div class="alert alert-danger alert-dismissable ">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i><?php echo $_SESSION["error"]; ?> </h4>
                    
                  </div>
                 
		<?php } ?>

          <!-- Default box -->
          <div class="box">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Stock Management</h3>
                  <br><br>
				  
				  <a href="product_stock.php" class="btn btn-md btn-primary">Add stock</a>
                   <a href="excel.php" class="btn btn-md btn-primary">Import Excel</a>
				   
				   
                </div><!-- /.box-header -->
				<br>
				<form action="" enctype="multipart/form-data" method="post">
				   <input type="hidden" class="form-control" id="mode" name="mode" value="seresh" >
				   
				    <div class="col-md-3">
				     <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $_REQUEST[product_name]; ?>" placeholder="Product Name">
				    </div>
					<div class="col-md-3">
					 <input type="text" class="form-control col-md-3" id="size" name="size" value="<?php echo $_REQUEST[size];?>" placeholder="Size">
					 </div>
					 <div class="col-md-3">
					  <input type="text" class="form-control col-md-3" id="material" name="material" value="<?php echo $_REQUEST[material]; ?>" Placeholder="Material">
                     </div>
					 <div class="col-md-3">
					  <div class="col-md-6">
					       <button type="submit" value="Save" name="action" class="btn btn-primary pull-right">Seresh</button>
					 </div>
					 <div class="col-md-6">
					       <a href="product_stock_management.php"  class="btn btn-primary pull-right">All stock</a>
					 </div>
					 </div>
			    </form>
				   <div><br> <br><br></div>
				   
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.no</th>
                        <th>Product Name</th>
                        <th>Size</th>
                        <th>Material</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Created Date</th>
						<th>Required</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php 
                                                        $j=0;
                                                        while($row = $database->fetch_array( $result ))
														
                                                        {
                                                          
                                                        ?>
                                        	<tr>
                                        		<td><?php echo $j+1; ?></td>
                                        		<td><?php echo $row['product_name']; ?></td>
                                        		<td><?php echo $row['size']; ?></td>
                                                <td><?php echo $row['material'];?></td>
                                        		<td><?php echo $row['qty']; ?></td>
                                        		<td><?php echo $row['rate']; ?></td>
                                                <td><?php echo $row['update_dt'];?></td>
												<td> <a href="product_stock.php?mode=required&id=<?php echo $row['id']; ?>">
                                                    <button class="btn btn-md bg-info">Required</button>
                                                </a></td>
                                                <td style="width:100px;">
                                                <a href="product_stock.php?mode=edit&id=<?php echo $row['id']; ?>">
                                                    <button class="btn btn-xs bg-maroon"><i class="fa fa-fw fa-edit"></i></button>
                                                </a>
                                                <a href="product_stock_action.php?mode=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are You Sure To Delete')">
                                                    <button class="btn btn-xs btn-danger delete_confirm"><i class="fa fa-fw fa-trash"></i></button>
                                                </a>
                            	
                            					</td>
												

                                            </tr>
                                            			<?php 
                                                                $j++;
                                                                }
                                                        ?>
                    </tbody>
                  </table>
                </div>
            </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>

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
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
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
<?php 
unset($_SESSION["error"]);
unset($_SESSION["msg"]);
?>