<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //this method shows products page
    public function index() {
        $products = Product::orderBy('created_at','DESC')->get();
        return view('product.list',[

            'products' => $products
        ]);
    }

    //create procduct page
    public function create() {
        return view('product.create');
    }

    //store a product in db
    public function store(Request $request) {
        $rules =[
            'Name' => 'required|min:5',
            'Sku' => 'required|min:3',
            'Price' => 'required|numeric',
        ];

        if($request->image!=""){
            $rules['image']= 'image';
        }


        $Validator=Validator:: make($request->all(),$rules);

        if($Validator-> fails()){
            return redirect()->route('products.create')->withInput()->withErrors($Validator);
        }
            // insert product in db
        $product = new Product();
        $product -> Name = $request-> Name;
        $product -> Sku = $request-> Sku;
        $product -> Price = $request-> Price;
        $product -> Description = $request-> Description;
        $product -> save();

        if ($request->image != ""){

            //here we will store image
            $image = $request-> image;
            $ext = $image-> getClientOriginalExtension();
            $imageName = time().'.'.$ext; //image name

            //save image to product directory
            $image->move(public_path('uploads/products'), $imageName);

            //save image name in db
            $product -> image = $imageName;
            $product -> save();
    }


        return redirect()->route('products.index')->with('success','Product added successfully.');
    }

    //edit the product
    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('product.edit',[
            'product' => $product
        ]);
    }

    //update a product
    public function update($id , Request $request) {
        $product = Product::findOrFail($id);
        $rules =[
            'Name' => 'required|min:5',
            'Sku' => 'required|min:3',
            'Price' => 'required|numeric',
        ];

        if($request->image!=""){
            $rules['image']= 'image';
        }


        $Validator=Validator:: make($request->all(),$rules);

        if($Validator-> fails()){
            return redirect()->route('products.edit',$product->id)->withInput()->withErrors($Validator);
        }
            // insert product in db

        $product -> Name = $request-> Name;
        $product -> Sku = $request-> Sku;
        $product -> Price = $request-> Price;
        $product -> Description = $request-> Description;
        $product -> save();

        if ($request->image != ""){

            //delete old image if new onw selected
            File::delete(public_path('uploads/products/'.$product->image));

            //here we will store image
            $image = $request-> image;
            $ext = $image-> getClientOriginalExtension();
            $imageName = time().'.'.$ext; //image name

            //save image to product directory
            $image->move(public_path('uploads/products'), $imageName);

            //save image name in db
            $product -> image = $imageName;
            $product -> save();
    }


        return redirect()->route('products.index')->with('success','Product updated successfully.');


    }

    //delete a product
    public function destroy($id) {
        $product = Product::findOrFail($id);

        File::delete(public_path('uploads/products/'.$product->image));

        $product -> delete(); //delete product from db

        return redirect()->route('products.index')->with('success','Product deleted successfully.');


    }
}
