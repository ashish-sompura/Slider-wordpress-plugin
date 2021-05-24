<?php
/*
Plugin Name: Ultimate slider
Plugin URI:
Description: This is dynamic slider plugin 
Author: Ashish
Author URI: www.ashishsompura.com
Version: 0.1


*/

if(!defined('ABSPATH'))
{
	define('ABSPATH', dirname(_FILE_) . '/');
} 

 include_once("DBP_db_file.php");
 
 
add_action("admin_menu", "addmenu");

DBP_tb_create();
function addmenu()
{
	add_menu_page("Ultimate slider", "Ultimate slider","manage_options","Add Slider","Slider");

}



function Slider()
{      
     if(isset($_GET['id']) && $_GET['action'] == "S_images")
		{
			include_once('DBP_update_file.php');
			
		}
    else  
	{
?>
       <style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
textarea{
 width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=submit] {
  width: 100%;
  background-color: #000000;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #102533;
}
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #102533;
  color: white;
}
</style>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo home_url( '/' ); ?>wp-content/plugins/slider-plugin/css/site.css">
        <link rel="stylesheet" href="<?php echo home_url( '/' );?>wp-content/plugins/slider-plugin/js/richtext.min.css">
        <script type="text/javascript" src="<?php echo home_url( '/' ); ?>wp-content/plugins/slider-plugin/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo home_url( '/' ); ?>wp-content/plugins/slider-plugin/js/jquery.richtext.js"></script>
     

       <form method="post" >
       <H1>Add Slider</H1>
       <h3>Slider Name : </h3> <input type="text" name="slider_name" />
       </br>
       <input type="submit" name="Add"  />
        </form>
             
        
        <?php 
		global $wpdb;
		$table_name = $wpdb->prefix."our_slider";
		$DBP_result = $wpdb->get_results("SELECt * FROM $table_name");
		
			if(isset($_GET['id']) && $_GET['action'] == "delete")
		{
			include_once('DBP_delete_file.php');
			
		}
		
		else
		?>
        <table id="customers" >
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
        </tr>
         <?php foreach($DBP_result as $DBP_row) {
			 
			 $id = $DBP_row->id;
			 $slider_name = $DBP_row->slider_name;
		
		 ?>
        <tr>
        <td> <?php echo $id; ?></td>
        <td><?php echo $slider_name; ?></td>
        <td><a href="<?php echo admin_url('admin.php?page=Add+Slider&action=S_images&id='.$id); ?>">Add slider images </a> / <a href="<?php echo admin_url('admin.php?page=Add+Slider&action=delete&id='.$id); ?>"  onclick="return myConfirm();" >Delete </a></td>
        </tr>
        <?php } ?>
        </table>
        <script>
   function myConfirm() {
  var result = confirm("you want to delete?");
  if (result) {
   return true;
  } else {
   return false;
  }
}
   </script>
<?php


DBP_insert_data();
}
}



function DBP_insert_data() {
 
  global $wpdb;
	$table_name = $wpdb->prefix."our_slider";
	  $slider_name = $_POST['slider_name'];
	

	 
	 if(isset($_POST['Add']))
	 {
		 
	 $wpdb->insert($table_name, 
				   array(
						
						 'slider_name'=> $slider_name,
              'created_at' => gmdate('Y-m-d H:i:s')
						 
						 ),
				   array(
						   
						 '%s'  // use string format
						 )
				   );
	
	
	
}
}

function DBP_show_data() {
 
 global $wpdb;
		$table_name = $wpdb->prefix."our_slider";
		?>
	  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> 
   <!--  <link rel="stylesheet" href="<?php echo home_url( '/' ); ?>wp-content/plugins/slider-plugin/css/swiper-bundle.min.css" /> -->
     
     <!-- Demo styles -->
    <style>
      html,
      body {
        position: relative;
        height: 100%;
      }

      body {
        background: #eee;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color: #000;
        margin: 0;
        padding: 0;
      }

      .swiper-container {
        width: 100%;
        height: 100%;
      }

      .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
      }

      .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
    </style>
     <!-- Swiper -->
    <div class="swiper-container mySwiper">
      <div class="swiper-wrapper">
       <?php 
         global $wpdb;
		$table_name = $wpdb->prefix."posts";
	 	$DBP_result = $wpdb->get_results("SELECt * FROM $table_name where post_mime_type = 'image/jpeg'");
		
	foreach($DBP_result as $DBP_row) {
			 
		 $ID = $DBP_row->ID;
			 $guid = $DBP_row->guid;
		
		
        ?>
   
        <div class="swiper-slide">
         <img src="<?php echo $guid;  ?>" width="100%" height="500px;" />
        </div>
        <?php } ?>
        
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>

    <!-- Swiper JS -->
  <!--  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> -->
           <script src="<?php echo home_url( '/' ); ?>wp-content/plugins/slider-plugin/js/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    </script>
       
    	
<?php 
}

add_shortcode( 'myslideshow', 'custom_slider_shortcode' );
function custom_slider_shortcode() {
    ob_start();
    DBP_show_data();
    return ob_get_clean();
}

?>