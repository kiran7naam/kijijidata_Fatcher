<table class="table table-hover">
    <thead>
        <tr>
            <th>Action</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Posted Date</th>
            <th>Valid through</th>
        </tr>
    </thead>
    <tbody>
        @php
        $redirectTo = $products->url($products->currentPage());
        if(!$products->hasMorePages() && $products->count() == 1){
            $redirectTo = $products->previousPageUrl();
        }
        @endphp
        @if(isset($products))
        @foreach ($products as $product)
        <tr class="product_row_{{$product->id}}">
            <td><i class="fa fa-eye fa-lg" aria-hidden="true"
                    onclick="view_product_details({{$product->id}},1);"></i>&nbsp;
                @if($product->is_like === 1)
                <a href="{{route('update_is_like',['id' => $product->id,'is_like'=> 0,'redirectTo'=>$redirectTo])}}"><i class="fa fa-solid fa-thumbs-up fa-lg" onclick="like_product({{$product->id}})"></i></a>&nbsp;
                @else
                <a href="{{route('update_is_like',['id' => $product->id,'is_like'=> 1,'redirectTo'=>$redirectTo])}}"><span style="color: Tomato;"><i class="fa fa-solid fa-thumbs-down fa-lg" onclick="unlike_product({{$product->id}})"></i></span></a>&nbsp;
                @endif
                <i class="fa fa-solid fa fa-trash fa-lg" onclick="delete_product({{$product->id}})"></i>
            </td>
            <td>{{ html_entity_decode($product->product_name) }}</td>
            <td>{{ $product->category->category_name }}</td>
            <td class="text-right">&dollar;{{ number_format($product->price,2) }}</td>
            <td>{{ date("d-m-Y",strtotime($product->posted_date)) }}</td>
            <td>{{ date("d-m-Y",strtotime($product->valid_through)) }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6">{{ $products->links() }} </td>
        </tr>
        @endif
    </tbody>
</table>