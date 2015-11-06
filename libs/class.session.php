<?php
error_reporting (E_ALL ^ E_NOTICE);
/* 
 * Voice for Animals
 *  
 */
include_once 'class.database.php';
include_once 'functions.php';

class Session{

function __construct()
		{

			if ( @ini_get('session.auto_start') == 1 || session_id() == '') session_start();
			
			$this->has_logged_in();
			
		}
public function set_session($uservalue)
{
	if ($uservalue["account_type"] == 3)
	{
		$vet_id = $uservalue["id"];
		global $database, $db;
		$qry="SELECT vet_id	from `".TBL_VET_DOCTOR."` WHERE doctor_id = '$vet_id'";
		$result = $database->query( $qry );
		$row = $database->fetch_array( $result );
		
		$_SESSION['VFA_Login']=true;
		$_SESSION['VFA_Userid']=$uservalue["id"];
		$_SESSION['VFA_isAdmin']=$uservalue["account_type"];
		$_SESSION['VFA_isactive']=$uservalue["isActive"];
		$_SESSION['VFA_username']=$uservalue["username"];
		$_SESSION['VFA_image']=$uservalue["image"];
		$_SESSION['VFA_name']=$uservalue["name"];
		
		$_SESSION['VFA_vetId']=$row['vet_id'];
		/* print_r($_SESSION['VFA_vetId']);
		exit; */

	}
	else 
	{
	    $_SESSION['VFA_Login']=true;
	    $_SESSION['VFA_Userid']=$uservalue["id"];
	    $_SESSION['VFA_isAdmin']=$uservalue["account_type"];
	    $_SESSION['VFA_isactive']=$uservalue["isActive"];
	    $_SESSION['VFA_username']=$uservalue["username"];
	    $_SESSION['VFA_image']=$uservalue["image"];
	    $_SESSION['VFA_name']=$uservalue["name"];
	   	/* print_r($_SESSION['VFA_Userid']);
	     exit;  */
	}
}
public function set_admin_permission()
{
    if(isset($_SESSION['VFA_Login']))
    {
        if($_SESSION['VFA_Login'] == 1)
        {
            global $db, $database;
			$sql = "SELECT permission_name FROM ".TBL_PERMISSIONS." WHERE  user_id='".$_SESSION['VFA_Userid']."'";
			print_r($_SESSION["$sql"]);
			exit;
			$result = $db->query( $sql );
			$permission=$database->db_result_to_array($result);		
			$_SESSION['UsrPermission']= $permission;
        }
    }
}


public function has_logged_in()
		{
		 /**
		 *  check to see if user logged in
		 */
/* 		print_r($_SESSION['VFA_Login']);
			exit; */
			if($_SESSION['VFA_isactive'] == 1)
			{
			  return TRUE;
			   
			   
			}
                        else{
                            
                            return false;
			}
		}
 public function session_deleteAll()
{
     session_destroy();
}

    public function check_permission_level($page_id) {
        $permission_level=false;
            foreach ($_SESSION["UsrPermission"] as $attr => $val) {
            	/* print_r($_SESSION["UsrPermission"]);
            	exit; */

                
             if($val["permission_name"] == $page_id)
             {
                    $permission_level=true;
                
             }
         }
         return $permission_level;

        
    }

 
}
