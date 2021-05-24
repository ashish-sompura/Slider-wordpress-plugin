<?php 

/*  Creating table for  Slider plugin  */

function DBP_tb_create()
{
	
	global $wpdb;
	$DBP_tb_name = $wpdb->prefix ."our_slider";
	$DBP_tb_name_1 = $wpdb->prefix ."our_slider_img";
	
	$queries = [ 


	 "CREATE TABLE $DBP_tb_name( 
											id int (10) NOT NULL AUTO_INCREMENT,
                                            slider_name varchar (500) DEFAULT '',
                                            created_at datetime NOT NULL,
											PRIMARY KEY (id)
                                             
	
)",  
	
	
	"CREATE TABLE $DBP_tb_name_1( 
											id int (10) NOT NULL AUTO_INCREMENT,
                                            slider_images varchar (500) DEFAULT '',
											order_number int (10)  NOT NULL,
											silder_id int (10) NOT NULL,
											created_at datetime NOT NULL,
											PRIMARY KEY (id)
                                             
	
)",
];
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  
   foreach ( $queries as $DBP_query ) {
   	dbDelta($DBP_query);
}


	//dbDelta($DBP_query_2);
}

register_activation_hook( __FILE__, 'DBP_tb_create' );





?>