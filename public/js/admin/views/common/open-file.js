function open_file() {
    const fileimport = document.getElementById("customFile").click();
    $("#customFile").on("change", function () {
        document.getElementById("btn_import").click();
    });
}
