$(document).ready(function(){
    $('.char-val').keydown(function(e) {
          
      	var $field = $(this);
      	var txt = $field.val();

      	$field.val(txt.replace(/[^a-z ]/gi,''));
 	});

 	$('#birthdate').change(function(e) {
        
      	var birthday = +new Date($(this).val());
  		var years = (~~((Date.now() - birthday) / (31557600000))); 

  		if(years <= 17) {
  			alert('Check birthdate. Must be 18 years old and above.');
  			$(this).val("");
  		}

 	});
 	  
 });