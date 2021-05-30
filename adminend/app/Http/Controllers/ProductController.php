<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(){

        $product = Product::orderBy('product_name')
        ->paginate(10);

        return view('product', compact('product'));
    }

    public function create(){
        return view('create_product');
    }

    public function store(Request $request){

        $request->validate([
            'productName'   => 'required',
            'price'         => 'required|numeric',
            'description'   => 'required',
            'image'         => 'required|mimes:png,jpg,jpeg',
        ]);

        if($request->hasFile('image')){

            $ext = $request->image->getClientOriginalExtension();
            $image = time().rand(1111,9999).'.'.$ext;

            $request->image->storeAs('public/product', $image);

            $image = 'storage/product/'.$image;
        }

        $product = new Product();
        $product->product_name  = $request->productName;
        $product->price         = $request->price;
        $product->description   = $request->description;
        $product->product_image = $image;
        $product->save();

        session()->flash('success', 'Product has been created');
        return redirect()->route('index.product');
    }

    public function view($id){

        $product = Product::firstwhere('id', $id);

        return view('view_product', compact('product'));
    }

    public function destroy(Request $request){
        
        Product::where('id', $request->id)
        ->delete();

        session()->flash('success', 'Product has been deleted');
        return redirect()->route('index.product');
    }
}
