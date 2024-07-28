<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductRating;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function productForm(){

        $categories = Category::all();
        return view('backend.pages.product.productForm',compact('categories'));
    }

    public function productStore(Request $request){
         //dd($request->all());

        $validator = Validator::make($request->all(), [
            'name'                  => 'required|string',
            'category_id'           => 'required',
            'image'                 => 'nullable|max:500',
            'weight'                => 'required|numeric|min:0',
            'stock'                 => 'required|integer|min:0',
            'price'                 => 'required|numeric|min:0',
            'discount'              => 'nullable|numeric|min:0|max:100',
            'description'           => 'required',
            'product_information'   => 'required',
            'status'                => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $images=null;
        if ($request->hasFile('image')) {
            $images=date('Ymdhsis').'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('uploads', $images, 'public');
        }
        
        $product=  Product::create([

             "name"                 =>$request->name,
             "category_id"          =>$request->category_id,
             "image"                =>$images,
             "weight"               =>$request->weight,
             "stock"                =>$request->stock,
             "price"                =>$request->price,
             "discount"             =>$request->discount,
             "time"                 =>$request->time,
             "description"          =>$request->description,
             'product_information'  =>$request->product_information,
             'status'               =>$request->status,
          ]);

          if ($product) {
            // Assuming $product->discount is the discount percentage (e.g., 70%)
            $discountPercentage = $product->discount / 100;
            $originalPrice = $product->price;

            // Calculate the discounted price
            $discountedPrice = $originalPrice - ($originalPrice * $discountPercentage);

            // Update the product's discounted price
            $product->update(['discounted_price' => $discountedPrice]);
        }


          return back()->with('success', 'Product Added Successfully!');

        }


        public function productList(){

            $products = Product::latest()->get();

            return view('backend.pages.product.productList',compact('products'));
        }

        public function productEdit($id){

            $categories = Category::all();

            $edit = Product::find($id);
            return view('backend.pages.product.edit',compact('edit','categories'));
        }

        public function productupdate( Request $request ,$id){


        $images=null;
        if ($request->hasFile('image')) {
            $images=date('Ymdhsis').'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('uploads', $images, 'public');
        }
          

            $update=Product::find($id);

            $update->update([
             "name"              =>$request->name,
             "category_id"          =>$request->category_id,
             "image"                =>$images,
             "weight"               =>$request->weight,
             "stock"                =>$request->stock,
             "price"                =>$request->price,
             "discount"             =>$request->discount,
             "time"                 =>$request->time,
             "description"          =>$request->description,
             'product_information'  =>$request->product_information,
             'status'               =>$request->status,
            ]);

            return redirect()->back()->with('success','product edited successful!!');

        }

        public function productDelete($id){

            $delete =  Product::find($id);

            $delete->delete();

            Alert::toast('Deleted! Product Deleted');

            return redirect()->back();
        }


        public function storeRating(Request $request, $id)
        {
            //dd($request->all());
            $request->validate([
                'rating'=>'required'
            ]);

            $product = Product::find($id);

            $rating = new ProductRating();
            $rating->product_id = $product->id;
            $rating->rating = $request->input('rating');
            $rating->save();
            notify()->success('Thank you for your feedback.');
            return back();
            }

            //Trending Product
              public function trendingProduct(){

                $trendingProduct = Product::where('status',2)->latest()->limit(8)->get();

                return view('frontend.components.trendingProduct',compact('trendingProduct'));
            }
            public function trendingStatus($id){

                $product = Product::find($id);

                $product->update([
                    "status"=>"2"
                ]);

                Alert::toast()->success('Your status has been changed');

                return redirect()->route('product.list');

            }

            }
