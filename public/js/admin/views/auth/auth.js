$(document).ready(function(){
    $("#form-login").validate({
        rules: {
          'email': {
            required: true,
            email: true
          },
          'password': {
              required: true,
              maxlength: 20,
              minlength: 6
          }
        }
       
    })
});


