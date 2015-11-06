<?php
/* 
 * voice for animals
 */
include_once("db.config.php");
$PREFIX=DB_PREFIX;
defined('TBL_USER') ? null : define('TBL_USER',$PREFIX.'user' );
defined('TBL_STOCK') ? null : define('TBL_STOCK',$PREFIX.'stock' );
defined('TBL_REQUIRED') ? null : define('TBL_REQUIRED',$PREFIX.'required' );
defined('TBL_PRODUCT_STOCK') ? null : define('TBL_COMMEN_PRODUCT_STOCK',$PREFIX.'commen_product_stock' );
?>
