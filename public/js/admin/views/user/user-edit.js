$(document).ready(function () {
    $("#user-form").validate({
        rules: {
            first_name: {
                required: true,
                maxlength: 50,
            },
            first_name_hiragana: {
                required: true,
                maxlength: 50,
                checkHiragana2Byte: true,
            },
            last_name: {
                required: true,
                maxlength: 50,
            },
            last_name_hiragana: {
                required: true,
                maxlength: 50,
                checkHiragana2Byte: true,
            },
            email: {
                required: true,
                maxlength: 75,
                email: true,
            },
            password: {
                maxlength: 100,
                alphanumeric: true,
            },
            "re-password": {
                alphanumeric: true,
                equalTo: "#password",
            },
            phone: {
                maxlength: 11,
                number: true,
            },
            addres: {
                maxlength: 255,
            },
            birthday: {
                date: true,
            },
            image_link: {
                extension: "jpg|jpeg|png",
                filesize: 5120,
            },
        },
    });
});
