<?php 

// 如果 uninstall.php不是被 wp 调用，则 exit
if (!defined("WP_UNINSTALL_PLUGIN")) {
    exit;
}

delete_option("zm-sg4wp");
delete_option("zm_sg4wp_id");
delete_option("zm_sg4wp_type");
delete_option( "zm_sg4wp_apitype" );
delete_option( "zm_sg4wp_cachetime" );

?>