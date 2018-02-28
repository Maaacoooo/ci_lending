$(document).ready(function(){
    $('.char-val').bind('keydown blur', function(e) {
          
      	// Allow controls such as backspace, tab etc.
        var arr = [8,9,16,17,20,35,36,37,38,39,40,45,46,189];

        // Allow letters
        for(var i = 65; i <= 90; i++){
          arr.push(i);
        }

        // Prevent default if not in array
        if(jQuery.inArray(event.which, arr) === -1){
          event.preventDefault();
        }
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