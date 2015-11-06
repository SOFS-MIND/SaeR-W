<?php 
error_reporting (E_ALL ^ E_NOTICE);
include_once 'libs/class.database.php';
include_once 'libs/class.session.php';
include_once 'libs/functions.php';
include_once 'libs/tables.config.php';
session_start();
$session= new Session();

$mode=$_REQUEST["mode"];

	$product_name=$database->escape_value ($_REQUEST["product_name"]);
	$size=$database->escape_value ($_REQUEST["size"]);
    $material=$database->escape_value ($_REQUEST["material"]);
	$quantity=$database->escape_value ($_REQUEST["quantity"]);
	$rate=$_REQUEST["rate"];
	$code_no=$database->escape_value ($_REQUEST["code_no"]);
	$kgs=$_REQUEST["kgs"];


if($mode == "add")
{
  
	
   

	        global $database, $db;
			$qry_update="INSERT INTO `".TBL_COMMEN_PRODUCT_STOCK."` (`product_name`,`size`,`material`,`qty`,`rate`,`created_by`,`created_dt`,`update_by`,`update_dt`,`status`,`code_no`,`kgs`)"
                        . " VALUES ('".$product_name."','".$size."','".$material."','".$quantity."','".$rate."','".$_SESSION['VFA_username']."',NOW(),'".$_SESSION['VFA_username']."',NOW(),'0','".$code_no."','".$kgs."');";
			//print_r($qry_update);
			//exit();
			$result_upload = $database->query( $qry_update );
			//echo "The image {$_FILES['media']['name'][$i]} was successfully uploaded and added to the gallery<br />";
            if($result_upload >0)
            {
				$_SESSION["msg"]="Updated successfully!.";
				redirect_to('rod_manage.php');
			}
			else
			{
				$_SESSION["error"]="Updating failed!.";
				redirect_to('rod_manage.php');
			}
}
if($mode == "edit")
{
	$id=$_REQUEST['id'];
         global $database, $db;
			$qry_update="UPDATE `".TBL_COMMEN_PRODUCT_STOCK."` SET `product_name`='".$product_name."', `size`='".$size."', `code_no`='".$code_no."', `kgs`='".$kgs."', `material`='".$material."', `qty`='".$quantity."',`rate`='".$rate."' , `update_by`='".$_SESSION['VFA_username']."', `update_dt`=NOW()
		 WHERE `id`='".$id."' ";
		
		$result_upload = $database->query( $qry_update );
		if($result_upload)
	        {
				$_SESSION["msg"]="Updated successfully!.";
				redirect_to('rod_manage.php');
			}
			else
			{
				$_SESSION["error"]="Updating failed!.";
				redirect_to('rod_manage.php');
			}

    
   
}
     
if($_GET['mode'] == "delete")
{
	
	$id=$_REQUEST["id"];
	
	global $database, $db;
	$qry_update="DELETE FROM `".TBL_COMMEN_PRODUCT_STOCK."` WHERE `id`='".$id."' ";
   
	$result_update = $database->query( $qry_update );
	if($result_update)
		{
			$_SESSION["msg"]="Post deleted successfully!.";
		             redirect_to('rod_manage.php');
		}
		else{
			$_SESSION["error"]="File Delete Failed!.";
                  redirect_to('rod_manage.php');
		}		
                
	}

if($mode == "excel")
{
  
	
   $filename =$_FILES['excel']['tmp_name'];

	        global $database, $db;
			
			
			$file = fopen($filename, "r");
				
				$count = 0;                                         // add this line
				while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
				{
					print_r($emapData);
					exit;
					$count++;    
					$product_name =$database->escape_value ($emapData[0]);                        // add this line
				     $size =$database->escape_value ($emapData[1]);
					 $material =$database->escape_value ($emapData[2]);
					 $qty =$database->escape_value ($emapData[3]);
					 $rate =$database->escape_value ($emapData[4]);
					 $to_wt =$database->escape_value ($emapData[5]);
					if($count>1){                                  // add this line
					  $sql = "INSERT INTO `".TBL_COMMEN_PRODUCT_STOCK."` (`product_name`,`size`,`material`,`qty`,`rate`) values ('$product_name','$size','$material','$qty','$rate')";
					 $result_update = $database->query($sql);
					}                                              // add this line
				}
			
			//echo "The image {$_FILES['media']['name'][$i]} was successfully uploaded and added to the gallery<br />";
            if($result_upload >0)
            {
				$_SESSION["msg"]="Updated successfully!.";
				redirect_to('rod_manage.php');
			}
			else
			{
				$_SESSION["error"]="Updating failed!.";
				redirect_to('rod_manage.php');
			}
}
if($mode == "required")
{
	$status= $_REQUEST['status'];
	
	if($status != "")
	{
		    global $database, $db;
			if($status == 0)
			{
			$qry_update="UPDATE `".TBL_REQUIRED."` SET `status`='".$status."' ,`need_qty`=0 
		    WHERE `id`='".$_REQUEST['id']."' ";
			}
			else{
				$qry_update="UPDATE `".TBL_REQUIRED."` SET `status`='".$status."'
		    WHERE `id`='".$_REQUEST['id']."' ";
			}
			
		    $result_upload = $database->query( $qry_update );
			 if($result_upload >0)
            {
			
		    $result_upload = $database->query( $qry_update );	
				$_SESSION["msg"]="Updated successfully!.";
				redirect_to('rod_reqierment_manage.php');
				exit;
			}
			else
			{
				$_SESSION["error"]="Updating failed!.";
				redirect_to('rod_reqierment_manage.php');
				exit;
			}
	}
	$purpose = $_REQUEST['purpose'];
	$red_qty = $_REQUEST['required'];
	$stcok_idfk =$_REQUEST['stock_id'];
	
	
	if( $quantity < $red_qty)
	{
		$need_qty = $red_qty - $quantity;
		
		$status = 1;
		$qty = 0;
	}
	elseif(($quantity > $red_qty) || ($quantity == $red_qty) )
	{
		$need_qty =0;
		$status = 0;
		$qty = $quantity - $red_qty;
	}
	
	 global $database, $db;
			$qry_update="INSERT INTO `".TBL_REQUIRED."` (`stock_IDFK`,`purpose`,`current_qty`,`required_qty`,`need_qty`,`update_dt`,`status`,`type`)"
                        . " VALUES ('".$stcok_idfk."','".$purpose."','".$quantity."','".$red_qty."','".$need_qty."',NOW(),'".$status."',2);";
			//print_r($qry_update);
			//exit();
			$result_upload = $database->query( $qry_update );
			//echo "The image {$_FILES['media']['name'][$i]} was successfully uploaded and added to the gallery<br />";
            if($result_upload >0)
            {
			 global $database, $db;
			$qry_update="UPDATE `".TBL_COMMEN_PRODUCT_STOCK."` SET `qty`='".$qty."' ,status =1
		    WHERE `id`='".$stcok_idfk."' ";
		    $result_upload = $database->query( $qry_update );	
				$_SESSION["msg"]="Updated successfully!.";
				redirect_to('rod_reqierment_manage.php');
			}
			else
			{
				$_SESSION["error"]="Updating failed!.";
				redirect_to('rod_reqierment_manage.php');
			}
	
	
}

?>
