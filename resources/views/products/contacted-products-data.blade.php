<table class="table table-hover">
    <thead>
        <tr>
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
        $redirectTo = $contacted_products->url($contacted_products->currentPage());
        if(!$contacted_products->hasMorePages() && $contacted_products->count() == 1){
        $redirectTo = $contacted_products->previousPageUrl();
        }
        @endphp
        @if(isset($contacted_products))
        @foreach ($contacted_products as $product)
        <tr class="product_row_{{$product->id}}">
            <td><i class="fa fa-solid fa fa-eye fa-lg" aria-hidden="true"
                    onclick="view_product_details({{$product->id}},1);"></i>&nbsp;
                <i class="fa fa-undo fa-lg" aria-hidden="true"></i>&nbsp;
                <i class="fa fa-solid fa fa-trash fa-lg" onclick="delete_product({{$product->id}})"></i>
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
            <td colspan="6">{{ $contacted_products->links() }} </td>
        </tr>
        @endif
    </tbody>
</table>