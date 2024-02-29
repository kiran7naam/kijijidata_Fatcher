@if(isset($products_details))
@if($products_details[0]['is_contacted'] == 0)
<center><button class="btn btn-success" style="margin-top:-66px;position:fixed;" id="contact_seller">Contact
        Seller</button></center>
@else
<center><button class="btn btn-success" style="margin-top:-66px;position:fixed;" disabled>Already Contacted
        </button></center>
@endif

<table class="table table-hover noBorder" border="0">
    <tr>
        <td width="60%">
            <table border="1" width="100%">
                <tr>
                    <td width="17%">ProductName</td>
                    <td>{{$products_details[0]['product_name']}}
                        <textarea id="site_url_data" class="noDisplay">{{$products_details[0]['site_url']}}</textarea>
                        <input type="hidden" id="saved_product_id" value="{{$products_details[0]['id']}}">
                    </td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>{{ucfirst($products_details[0]['category']['category_name'])}}</td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>{{$products_details[0]['price']}}</td>
                </tr>
                <tr>
                    <td>Posted Date</td>
                    <td>{{date("d-m-Y",strtotime($products_details[0]['posted_date']))}}</td>
                </tr>
                <tr>
                    <td>Valid Through</td>
                    <td>{{date("d-m-Y",strtotime($products_details[0]['valid_through']))}}</td>
                </tr>
                <tr>
                    <td>Dealer Name</td>
                    <td>{{$products_details[0]['dealer']['dealer_name']}}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{$products_details[0]['dealer']['dealer_address']}}</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <div style="width:100%; max-height:500px; overflow:auto;word-wrap: break-word !important;">
                            {{html_entity_decode($products_details[0]['description'])}}
                        </div>
                    </td>

                </tr>
            </table>
        </td>
        <td width="40%">
            <table border="0" width="100%">
                <tr>
                    <td>
                        <div style="width:100%; max-height:1000px; overflow:auto;">
                            @foreach($products_details[0]['product_images'] as $key=>$value)
                            <a data-fancybox="gallery" href="{{$value['image_path']}}">
                                <img src="{{$value['image_path']}}" width="220">
                            </a>
                            @endforeach
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

</table>
@endif
<script src="/modulejs/contact_seller.js"></script>