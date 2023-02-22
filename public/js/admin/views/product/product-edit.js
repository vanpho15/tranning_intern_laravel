$(document).ready(function () {
    $.validator.addMethod("validatealphanumber", function (value, element) {
        return this.optional(element) || /^[0-9a-z]/.test(value);
    });
    $("#product-form").validate({
        rules: {
            name: {
                required: true,
                maxlength: 100,
            },
            name_kana: {
                required: true,
                maxlength: 100,
                checkHiragana2Byte: true,
            },
            alias: {
                required: true,
                validatealphanumber: true,
            },
            content: {
                maxlength: 2000,
            },
            amount: {
                required: true,
                number: true,
                maxlength: 6,
            },
            price: {
                required: true,
                number: true,
                maxlength: 20,
            },
            image_link: {
                extension: "jpg|jpeg|png",
                filesize: 5,
            },
            category_id: {
                required: true,
            },
        },
    });
});
