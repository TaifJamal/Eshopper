<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','store']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::with('Category')->get();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'size'=>'required',
            'color'=>'required',
            'category_id'=>'required',
            'image'=>'required',
        ]);

        $img_name=time().rand(). $request->image->getClientOriginalName();
        $request->image->move(public_path('image/product'), $img_name);

        Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'size'=>$request->size,
            'color'=>$request->color,
            'oldBrice'=>$request->oldBrice,
            'category_id'=>$request->category_id,
            'image'=> $img_name,
        ]);

        // Redirect
        return redirect()->route('admin.products.index')->with('msg', 'Product added successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        $categories=Category::select('id','name')->get();
        return view('admin.product.edit',compact('product','categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product=Product::find($id);
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'size'=>'required',
            'color'=>'required',
            'category_id'=>'required',
        ]);
        $image_name=$product->image;
        if( $request->image){
            $image_name=time().rand(). $request->image->getClientOriginalName();
            $request->image->move(public_path('image/product'), $image_name);
        }

        $product->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'size'=>$request->size,
            'color'=>$request->color,
            'oldBrice'=>$request->oldBrice,
            'category_id'=>$request->category_id,
            'image'=>  $image_name,
        ]);

        // Redirect
        return redirect()->route('admin.products.index')->with('msg', 'Product updated successfully')->with('type', 'info');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $product->delete();
        File::delete(public_path('image/product/'). $product->image);
        // Redirect
        return redirect()->route('admin.products.index')->with('msg', 'Product deleted successfully')->with('type', 'danger');

    }

    public function trach()
    {
        $products=Product::onlyTrashed()->paginate(10);
        return view('admin.product.trach',compact('products'));
    }

    public function restore($id)
    {
        Product::onlyTrashed()->find($id)->restore();
        return redirect()->route('admin.products.index')->with('msg', 'Product restored successfully')->with('type', 'warning');

    }

    public function forcedelete($id)
    {
        Product::onlyTrashed()->find($id)->forcedelete();
        return redirect()->route('admin.products.index')->with('msg', 'Product deleted permanintly successfully')->with('type', 'danger');
    }
}
