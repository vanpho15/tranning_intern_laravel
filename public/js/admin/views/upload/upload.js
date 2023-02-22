$(document).ready(() => {
    $("#image_link").change(function () {
        const file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (event) {
                $("#imgPreview")
                  .attr("src", event.target.result);
            };
            $("#imgPreview").add($('#image_name').css('visibility','hidden'));
            reader.readAsDataURL(file);
        }
    });
});
