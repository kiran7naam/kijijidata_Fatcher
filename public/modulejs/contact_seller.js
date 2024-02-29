$('#contact_seller').click(function(e){

    var site_url_data = $('#site_url_data').text();
    var site_url_object = new URL(site_url_data);
    var site_url_params = new URLSearchParams(site_url_object.search);
    var site_url = site_url_data.replace(site_url_params,'');
    const myUrlWithParams = new URL(site_url);

    var product_id = $('#saved_product_id').val();
    
    myUrlWithParams.searchParams.append("action", "contact_seller");
    myUrlWithParams.searchParams.append("contact", "yes");

    var url = 'is_contacted';
    var data = {'product_id' : product_id};
    var dataType = "";
    var type = "POST";

    swal({
        title: "Are you sure?",
        text: "You want to Contact this seller. Press Ok to proceed!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            //window.open(myUrlWithParams,'_blank');
            callroute(url,type,dataType,data,function(data){
                if(data['status'] === 'success'){
                    $('.product_row_'+product_id).remove();
                       toastr.success(data['message']);
                       $('#contact_seller').prop('disabled', true);
                    }
                    else{
                        swal(data['message']);
                    }
            });   
        } 
      });  

});

