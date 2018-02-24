$(document).ready(function(){
    $('.char-val').keydown(function(e) {
          
      	var $field = $(this);
      	var txt = $field.val();

      	$field.val(txt.replace(/[^a-z ]/gi,''));
 	});

 	$('#birthdate, #spouse_bdate').change(function(e) {
        
      	var birthday = +new Date($(this).val());
  		var years = (~~((Date.now() - birthday) / (31557600000))); 

  		if(years <= 17) {
  			alert('Check birthdate. Must be 18 years old and above.');
  			$(this).val("");
  		}

 	});

  $('#img').change(function(e) {
        var fuData = $(this);
        var FileUploadPath = fuData.val();

      //To check if user upload any file
              if (FileUploadPath == '') {
                  alert("Please upload an image");

              } else {
                  var Extension = FileUploadPath.substring(
                          FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

      //The file uploaded is an image

      if (Extension == "gif" || Extension == "png" || Extension == "bmp"
                          || Extension == "jpeg" || Extension == "jpg") {

      // To Display
                      if (fuData.files && fuData.files[0]) {
                          var reader = new FileReader();

                          reader.onload = function(e) {
                              $('#blah').attr('src', e.target.result);
                          }

                          reader.readAsDataURL(fuData.files[0]);
                      }

                  } 

      //The file upload is NOT an image
      else {
                      alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
                      $(this).val(null);

                  }
              }
          


  });
 	  
 });