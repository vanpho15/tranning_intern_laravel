$(document).ready(function () {
    $("#importUser").validate({
        rules: {
            file: {
                extension: "csv, txt",
            },
        },
    });
});
