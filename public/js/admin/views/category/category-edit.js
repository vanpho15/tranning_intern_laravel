$(document).ready(function(){
    $("#category-form").validate({
        rules: {
            'name': {
                required: true,
                maxlength: 100
            },
            'alias': {
                required: true,
                maxlength: 100
            },       
        }
    });
});