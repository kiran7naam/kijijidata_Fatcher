function callroute(url,type,dataType="",data,callback)
{
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: type,
        url: url,
        dataType: dataType,
        processData: false,

        async: false,
        data: JSON.stringify(data),
        contentType: 'application/json; charset=UTF8',
        beforeSend: function(xhr)
        {
            xhr.setRequestHeader("X-CSRF-TOKEN",csrf_token);
        },
        success: function(server_response)
        {
            callback(server_response);
        },
        error: function(server_error)
        {

            callback(server_error);
        }
    });
}
$('input[name="change_password"]').click(function() {
    if ($(this).is(':checked')) {
        console.log($('.password_section'));
        document.querySelector('.password_section').style.display = 'block';
    }
    else{
        document.querySelector('.password_section').style.display = 'none';
    }
});  
function delete_user(user_id){
    var url = 'delete_user';
    var data = {'user_id' : user_id};
    var dataType = "";
    var type = "POST";
    swal({
        title: "Are you sure?",
        text: "Deleted User will not show in users List.Press Ok to delete the User!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            callroute(url,type,dataType,data,function(data){
                if(data['status'] === 'success'){
                    $('.user_row_'+user_id).remove();
                       toastr.success(data['message']);
                    }
                    else{
                        swal(data['message']);
                    }
            });            
        } 
      });    
}