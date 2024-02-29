<table class="table table-hover">
    <thead>
        <tr>
            <th><input type="checkbox" name="selectall" id="selectall" class="smallcheckbox" title="Check to select checkboxes"></th>
            <th>Action</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Posted Date</th>
            <th>Valid through</th>
            <th>User Name</th>
        </tr>
    </thead>
    <tbody>
        @php
        $redirectTo = $deleted_products->url($deleted_products->currentPage());
        if(!$deleted_products->hasMorePages() && $deleted_products->count() == 1){
        $redirectTo = $deleted_products->previousPageUrl();
        }
        @endphp
        @if(isset($deleted_products))
        @foreach ($deleted_products as $product)
        <tr class="product_row_{{$product->id}}">
            <td><input type="checkbox" class="smallcheckbox" name="delete_allproducts[]" value="{{$product->id}}"
                    id="delete_product_{{$product->id}}"></td>
            <td><i class="fa fa-solid fa fa-eye fa-lg" aria-hidden="true"
                    onclick="view_product_details({{$product->id}},0);"></i>&nbsp;
                <i class="fa fa-undo fa-lg" aria-hidden="true" title="Restore" style="color:green !important;"
                    onclick="restore_product({{$product->id}})"></i>&nbsp;
                <i class="fa fa-solid fa fa-trash fa-lg" style="color:red !important;"
                    onclick="permanent_delete_product({{$product->id}},0)"></i>
            </td>
            <td>{{ html_entity_decode($product->product_name) }}</td>
            <td>{{ $product->category->category_name }}</td>
            <td class="text-right">&dollar;{{ number_format($product->price,2) }}</td>
            <td>{{ date("d-m-Y",strtotime($product->posted_date)) }}</td>
            <td>{{ date("d-m-Y",strtotime($product->valid_through)) }}</td>
            <td>{{ $product->deleted_by != NULL ? $product->user->name : '' }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6">{{ $deleted_products->links() }} </td>
        </tr>
        @endif
    </tbody>
</table>