<?php 

$DBP_id = $_GET['id'];
DBP_update_form($DBP_id);

function DBP_update_form($DBP_id) {
	
	
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


<?php  wp_enqueue_media(); ?>


 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo home_url( '/' ); ?>wp-content/plugins/slider-plugin/css/site.css">

        <script type="text/javascript" src="<?php echo home_url( '/' ); ?>wp-content/plugins/slider-plugin/js/jquery.min.js"></script>

  <script type="text/javascript" src="<?php echo home_url( '/' ); ?>wp-content/plugins/slider-plugin/js/script.js"></script>

    

      <?php 
	      global $wpdb;
		$table_name = $wpdb->prefix."our_slider";
		$DBP_result = $wpdb->get_results("SELECt * FROM $table_name where id = $DBP_id");
		foreach($DBP_result as $DBP_row) {
			 
			 $id = $DBP_row->id;
			 $slider_name = $DBP_row->slider_name;
		}
       ?>
       <form method="post" >
       <H1>Add Slider Images</H1>
       <h3>Slider Name </h3> <input type="text" class="content" name="sname"  value="<?php echo $slider_name;  ?>" readonly />

     <div class="uploader">
       <h3>Upload Images </h3>
  <input id="btnImage"  class="button" name="btnImage" type="button" style="width:100%;" value="Upload Images" />
</br>
   <img src="" id="getimage" />  
 
</div>

       <input type="submit" name="Update" value="upload Slider Images" />
        </form>
        <?php 
        global $wpdb;
		$table_name = $wpdb->prefix."posts";
		$DBP_result = $wpdb->get_results("SELECt * FROM $table_name");
		
		foreach($DBP_result as $DBP_row) {
			 
			 $ID = $DBP_row->ID;
			 $guid = $DBP_row->guid;
		
		
        ?>
        
        <img  src="<?php echo $guid; ?>" height="100" width="100" />
   
    
       

<?php
		}
DBP_update($DBP_id);
}

function DBP_update($DBP_id)
{
 
	global $wpdb;
$table_name_2 = $wpdb->prefix."our_slider_img";

 



    if(isset($_POST['Update']))
   {


    $s_images = $_POST['image'];
   $wpdb->insert($table_name_2, 
           array(
            
             //'slider_images'=> $("#getimage").attr("src"),
             'silder_id'=>$DBP_id,
             'created_at' => gmdate('Y-m-d H:i:s')
             ),
           array(
               
             '%s',  // use string format
             )
           );
	 
	 ?>
    <script>

	window.location.href = "<?php echo admin_url('admin.php?page=Add+Slider&action=S_images&id='.$DBP_id); ?>";
	 
     </script>
     <?php
}
}

?>