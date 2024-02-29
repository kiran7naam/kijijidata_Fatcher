<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use App\Models\Dealer;
use App\Models\Product_image;
use App\Models\Category;
use App\Models\Failed_product;
use DB;
use Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $pquery = Product::with('category');
         if(isset($_GET['price']) && $_GET['price'] != ''){
            if($_GET['price_type'] == 2){
                $pquery->where('price','>',$_GET['price']);
            }
            else if($_GET['price_type'] == 3){
                $pquery->where('price','<',$_GET['price']);
            }
            else if($_GET['price_type'] == 4){
                $pquery->where('price','>=',$_GET['price']);
            }
            else if($_GET['price_type'] == 5){
                $pquery->where('price','<=',$_GET['price']);
            }
            else{
                $pquery->where('price',$_GET['price']);
            }             
         }
         if(isset($_GET['is_like']) && $_GET['is_like'] == 1){
            $pquery->where('is_like',1);
         }
         if(isset($_GET['category']) && $_GET['category'] != ''){
            $category_name  = $_GET['category'];
            $category_data = Category::select('id')->where('category_name', 'LIKE', "%$category_name%")->first();
            $pquery->where('category_id',$category_data['id']);
         }
         
         $products = $pquery->where('is_contacted',0)->paginate(15); 
         return view('products.view-products',['products'=>$products])->render();
        
    }
    public function save_products(Request $request){
        $data = json_decode($request->getContent(),true);       

        if(!empty($data[1])){
            $dealer = Dealer::where('dealer_online_id',$data[1]['dealer_id'])->first();
            $dealer_id = '';
            if($dealer == ''){
                if($data[1]['dealer_id'] != ''){
                    $new_dealer = new Dealer();
                    $new_dealer->dealer_name = $data[1]['dealer_name'];
                    $new_dealer->dealer_address = $data[1]['dealer_address'];
                    $new_dealer->dealer_online_id = $data[1]['dealer_id'];
                    $new_dealer->save();
                    $dealer_id = $new_dealer->id;
                }
                
            }   
            else{
                $dealer_id = $dealer->id;
            }        
        }
        $category_id = '';
        $category = Category::where('category_name',$data[0]['category_name'])->first();
        if($category == ''){
            $new_category = new Category();
            $new_category->category_name = $data[0]['category_name'];
            $new_category->online_category_name = $data[0]['online_category'];
            $new_category->save();
            $category_id = $new_category->id;
        }
        else{
            $category_id = $category->id;
        }
        $product_id = '';
        $product = Product::where('ad_id',$data[0]['ad_id'])->first();
        if($product == ''){
            $new_product = new Product();
            $new_product->ad_id = $data[0]['ad_id'];
            $new_product->dealer_id = $dealer_id;
            $new_product->category_id = $category_id;
            $new_product->product_name = $data[0]['product_name'];
            $new_product->description = $data[0]['description'];
            $new_product->price = $data[0]['price'];
            $new_product->posted_date = $data[0]['posted_date'];
            $new_product->valid_through = $data[0]['valid_through'];
            $new_product->other_details = $data[0]['other_details'];
            $new_product->vehicle_details = $data[0]['vehicle_details'];
            $new_product->site_url = $data[0]['site_url'];
            $new_product->save();
            $product_id = $new_product->id;
        }
        else{
            $product_id = $product->id;
            return response()->json([
                'status' => 200,
                'message' => "Product already exist in the database."
            ],200);
        }
        $images_array = [];
        if(!empty($data[2])){
            foreach($data[2] as $key=>$value){
                $images_array[] = [
                'product_id' => $product_id,
                'image_path' => $value,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            DB::table('product_images')->insert($images_array);
        }
        if($product_id){
            return response()->json([
                'status' => 200,
                'message' => "Product added successfully!"
            ],200);
        }
        else{
            $failed_products = new Failed_product();
            $failed_products->ad_id = $data[0]['ad_id'];
            $failed_products->product_name = $data[0]['product_name'];
            $failed_products->error_message = 'Not saved. Something is wrong with this ad';
            return response()->json([
                'status' => 500,
                'message' => "Something went wrong"
            ],500);
        }
    }
    public function product_fetch()
    {
        return view('products.product-fetch');
    }
    public function get_product_details(Request $request){
               
        $data = json_decode($request->getContent(),true); 
        $product_id  = $data['product_id'];
        $products_data = Product::where('id',$product_id)
                            ->with('category')
                            ->with('dealer');
        if($data['product_status'] === 0){
            $products_data->withTrashed();
            $products_data->with(['product_images' => function($query){
                $query->withTrashed();
            }]);
        }   
        else{
            $products_data->with('product_images');
        }
        $products_details = $products_data->get();
        return view('products.product-details-popup',compact('products_details')); 
    }
    public function delete_product(Request $request){
        $data = json_decode($request->getContent(),true); 
        $product_id  = $data['product_id'];
        Product_image::where('product_id',$product_id)->delete();

        $product =  Product::where('id',$product_id)->first();
        $product->deleted_by = Auth::user()->id;
        $product->save();
        $product->delete();

        if($product){
            return response()->json([
                'status' => 'success',
                'message' => 'Product entry has been deleted successfully!'
            ],200);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'There is something wrong with this entry!'
            ],500);
        }


    }
    public function update_is_like(Request $request){

        $redirectTo = $request['redirectTo']; 
        $product_id = $request['id'];
        $is_like = $request['is_like'];
        if($request['is_like'] == 1){
            Product::where('id',$product_id)->update(['is_like'=>1,'modified_by' => Auth::user()->id]);
        }
        else{
            Product::where('id',$product_id)->update(['is_like'=>0,'modified_by' => Auth::user()->id]);
        }
        return redirect()->to($redirectTo);
    }
    public function deleted_products(Request $request){

        $deleted_products = Product::onlyTrashed()->paginate(15);
        return view('products.deleted-products',['deleted_products'=>$deleted_products])->render();
    }
    public function contacted_products(Request $request){

        $cquery  =  Product::with('category');
        if(isset($_GET['price']) && $_GET['price'] != ''){
            if($_GET['price_type'] == 2){
                $cquery->where('price','>',$_GET['price']);
            }
            else if($_GET['price_type'] == 3){
                $cquery->where('price','<',$_GET['price']);
            }
            else if($_GET['price_type'] == 4){
                $cquery->where('price','>=',$_GET['price']);
            }
            else if($_GET['price_type'] == 5){
                $cquery->where('price','<=',$_GET['price']);
            }
            else{
                $cquery->where('price',$_GET['price']);
            }             
         }
         if(isset($_GET['category']) && $_GET['category'] != ''){
            $category_name  = $_GET['category'];
            $category_data = Category::select('id')->where('category_name', 'LIKE', "%$category_name%")->first();
            $cquery->where('category_id',$category_data['id']);
         }
        $contacted_products = $cquery->where('is_contacted',1)->paginate(15);
        return view('products.contacted-products',['contacted_products'=>$contacted_products])->render();
    }
    public function restore_product(Request $request){
        $data  = $request->all();
        $product_id = $data['product_id'];
        $restore_product = Product::onlyTrashed()->find($product_id)->restore();
        Product_image::onlyTrashed()->where('product_id',$product_id)->restore();
        if($restore_product){
            return response()->json([
                'status' => 'success',
                'message' => 'Entry has been restored successfully!'
            ],200);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'There is something wrong with the entry!'
            ],500);            
        }
    }
    public function permanent_delete_product(Request $request){
        $data = $request->all();
        $product_id = $data['product_id']; 
        $status_all_products = $data['status_all_products'];
        if($status_all_products === 0){
            Product_image::onlyTrashed()->whereIn('product_id',$product_id)->forceDelete();
            $product = Product::onlyTrashed()->whereIn('id',$product_id)->forceDelete();
        }
        else{
            Product_image::onlyTrashed()->forceDelete();
            $product = Product::onlyTrashed()->forceDelete();
        }
        
        if($product){
            return response()->json([
                'status' => 'success',
                'message' => 'Products have been permanently deleted!'
            ],200);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'There is something wrong with the entry!'
            ],500);
        }
    }
    public function is_contacted(Request $request){
        $product_id  = $request->product_id;
        $product =  Product::where('id',$product_id)->update(['is_contacted' =>1,
                                                             'is_like' => 1,
                                                             'modified_by' => Auth::user()->id]);
        if($product){
            return response()->json([
                'status' => 'success',
                'message' => 'Seller has been Contacted Successfully'
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'There is something wrong with the entry'
            ]);
        }
    }
            
}
