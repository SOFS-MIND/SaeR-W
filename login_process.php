<?php
session_start();
/* 
 * Voice for Animals
 *  
 */
	include_once './libs/class.authendicate.php' ;
    $username	= $_REQUEST['username'];
	$password	= $_REQUEST['password'];
	
    //error_reporting(E_ALL);
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	//ini_set('display_errors', '1');
	$errors = array();
        $_SESSION["success"]=false;
       $_SESSION["error"]=true;
	if( $username == '' || $password == '' || empty( $username) || empty($password) )
	{
		
		//$_SESSION["msg"]= "User name or password cant be empty";
		header('Location:index.php');
		exit;
	}
        	//if they are no errors then process the login page
	else 
	{
            
            $has_user_been_found = Emp_Authendicate::authenticate( $username, $password );
             
            //$errors["user_details"]=$has_user_been_found;
            if( $has_user_been_found )
		{
			
                include_once './libs/class.session.php';
               $session = new Session();
              
               $session->set_session($has_user_been_found);
              
              // if($has_user_been_found["isactive"]==1)
               //{
				  
               // $session->set_admin_permission();
                  
               //}
			   
                global $database, $db;
			
	$qry_update="UPDATE `".TBL_USER."` SET `lastVisit`= NOW() WHERE `id`='".$has_user_been_found["id"]."' ";
	$result_upload = $database->query( $qry_update );
                $errors["success"]=true;
                $errors["error"]=false;
           
		header('Location:dashboard.php');
		exit;
		//print_r($_SESSION['UsrPermission']);
                }
            else {
            	//$_SESSION["msg"]= "User name or password not valid";
				header('Location:index.php');
                //$errors['success']=false;
                //$errors['error']=true;
                exit;
            }
          
        }
        
       //echo json_encode($errors);  
       ?>
