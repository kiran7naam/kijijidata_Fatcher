$('.productDetailsBody').html('');
$('#search_products').click(function(e){
    var search_by_product_name =  $('#search_by_product_name').val();
    var url = "https://www.kijiji.ca/?searchAd="+search_by_product_name;
    window.open(url,'_blank');
});
// function view_product_details(product_id){
//     var url= 'get_product_details';
//     fetch(url, {
//         method: 'POST',
//         headers: {
//             'Accept': 'application/json; charset=UTF8',
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         body: JSON.stringify({"product_id": product_id})
//     })
//     .then(function(response) {
//         return response.text()
//     })
//     .then(function(data) {
//         console.log(data);
//         $('.productDetailsBody').html('');
//         $('.productDetailsBody').html(data);
//         $("#myProductDetailsModal").modal('show');
//     })
//     .catch(function(err) {  
//         console.log('Failed to fetch page: ', err);  
//     });
// }
function view_product_details(product_id,product_status){
    var url = 'get_product_details';
    var data = {'product_id':product_id,'product_status':product_status};
    var dataType = "";
    var type = "POST";
    callroute(url, type, dataType, data,function (data)
    { 
        $('.productDetailsBody').html('');
        $('.productDetailsBody').html(data);
        $("#myProductDetailsModal").modal('show');
    });
}
$('.close_productdetails_popup').click(function(){
    $('#myProductDetailsModal').modal('hide');
    $('.productDetailsBody').html('');
})
function delete_product(product_id){
    var url = 'delete_product';
    var data = {'product_id' : product_id};
    var dataType = "";
    var type = "POST";
    swal({
        title: "Are you sure?",
        text: "Deleted product will show in deleted Products List. You can restore or permanently delete the entry from there. Press Ok to temporarily delete It!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            callroute(url,type,dataType,data,function(data){
                if(data['status'] === 'success'){
                    $('.product_row_'+product_id).remove();
                       toastr.success(data['message']);
                    }
                    else{
                        swal(data['message']);
                    }
            });            
        } 
      });    
}
function restore_product(product_id){
    var url = 'restore_product';
    var data = {'product_id' : product_id};
    var dataType = "";
    var type = "POST";
    swal({
        title: "Are you sure?",
        text: "Restored product will show in the view products list. Press Ok to Restore the product!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            callroute(url,type,dataType,data,function(data){
                if(data['status'] === 'success'){
                    $('.product_row_'+product_id).remove();
                    swal(data['message'], {
                        icon: "success",
                      });
                    }
                    else{
                        swal(data['message']);
                    }
            });            
        } 
      });    
}
function permanent_delete_product(product_id,status_all_products){
    var url = 'permanent_delete_product';
    var data = {'product_id' : product_id, 'status_all_products' : status_all_products};
    var dataType = "";
    var type = "POST";
    var popmessage = "";
    if(status_all_products === 0){
        popmessage = "Once Permanently Deleted, Product will not be restored later. Press Ok to Confirm!";
    }
    else{
        popmessage = "Confirming will permanently delete all items in the trash list, and there is no option for recovery. Press OK to proceed!"
    }
    swal({
        title: "Are you sure?",
        text: popmessage,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            callroute(url,type,dataType,data,function(data){
                if(data['status'] === 'success'){
                        if(status_all_products === 0){
                            $('.product_row_'+product_id).remove();
                            toastr.success(data['message']);
                        }
                        else{
                            toastr.success(data['message']);
                            window.location.reload();
                        }
                        
                    }
                    else{
                        swal(data['message']);
                    }
            });            
        } 
      });    
}
$('#search_data').click(function(e){
    var category = $('#category').val();
    var price = $('#price').val();
    var is_like = $('input[name="is_like"]:checked').val();
    
});
$('#selectall').click(function() {
    if ($(this).is(':checked')) {
        $('tbody input').attr('checked', true);
    } else {
        $('tbody input').attr('checked', false);
    }
});
$("#delete_all_products").click(function (){
    var ids = [];
    var url = 'permanent_delete_product';
    var dataType = "";
    var type = "POST";

    $('input[name="delete_allproducts[]"]:checked').each(function()
    {
        ids.push($(this).val());
    });

    if(ids.length > 0)
    {     
        var data = {'product_id' : ids, 'status_all_product' : 0};
        swal({
            title: "Are you sure?",
            text: "Once Permanently Deleted, Product will not be restored later. Press Ok to Confirm!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                callroute(url,type,dataType,data,function(data){
                    if(data['status'] === 'success'){
                        swal(data['message'], {
                            icon: "success",
                          });
                          window.location.reload();
                        }
                        else{
                            swal(data['message']);
                        }
                });            
            } 
          });     

    }
    else
    {
        swal("Please select checkboxes to bulk delete the products", {
            icon: "error",
          });
    }
});
$('#contact_seller').click(function(e){
    var site_url_data = $('#site_url_data').text();
    var site_url_object = new URL(site_url_data);
    var site_url_params = new URLSearchParams(site_url_object.search);
    var site_url = site_url_data.replace(site_url_params,'');
    const myUrlWithParams = new URL(site_url);
    myUrlWithParams.searchParams.append("contact", "yes");

    swal({
        title: "Are you sure?",
        text: "You want to Contact this seller. Press Ok to proceed!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
                 
        } 
      });  
});

