$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function removeRow(id,url){
    if(confirm('Are you sure delete this user?')){
        $.ajax({
            type: "GET",
            datatype:'JSON',
            data:{id},
            url: url,
            success: function(result){
                if(result.error === false){
                    location.reload();
                }
            }
    })
    }
}