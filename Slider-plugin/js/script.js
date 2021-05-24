
 var img_path;
jQuery(function() {

jQuery("#btnImage").on("click", function()  
{

var images = wp.media({
  title: "upload Images",
  multiple: false

}).open().on("select", function(e) {

var uploadedImages = images.state().get("selection").first();

var selectedImages = uploadedImages.toJSON();
img_path = selectedImages.url;
jQuery("#getimage").attr("src", selectedImages.url);

console.log(selectedImages.url);

//jquery("#geturl").attr("val", selectedImages.url);


 jQuery.each(selectedImages,function(index, image){


 console.log(image.url);



}); 


});

	});


});

