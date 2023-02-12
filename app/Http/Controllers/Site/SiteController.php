<?php

namespace App\Http\Controllers\Site;

use App\Models\Cart;
use App\Models\Client;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Mail\ContactData;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Print_;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
    public function index()
    {
        $sliders=Slider::all();
        $products=Product::all();
        $clients=Client::all();
        return view('site.index',compact('sliders','products','clients'));
    }
    public function cart()
    {
        $carts=Cart::all();
        return view('site.cart',compact('carts'));
    }

    public function checkout()
    {
        $carts=Cart::all();
        return view('site.checkout',compact('carts'));
    }

    public function contact()
    {
        return view('site.contact');
    }

    public function detail($id)
    {
        $product=Product::find($id);
        $products=Product::all();
        return view('site.detail',compact('product','products'));
    }

    public function shop()
    {
        $num=array(0,0,0,0,0);
        $products=Product::all();
        foreach ($products as $product){

            if($product->price<=99){
                $num[0]+=1;
            }
            elseif($product->price<=199){
                $num[1]+=1;
            }
            elseif($product->price<=299){
                $num[2]+=1;
            }
            elseif($product->price<=399){
                $num[3]+=1;
            }
            elseif($product->price<=499){
                $num[4]+=1;
            }
        }

        $color=array(0,0,0,0,0);
        $products=Product::all();
        foreach ($products as $product){

            if($product->color=='Black'){
               $color[0]+=1;
            }
            elseif($product->color=='White'){
               $color[1]+=1;
            }
            elseif($product->color=='Red'){
               $color[2]+=1;
            }
            elseif($product->color=='Blue'){
               $color[3]+=1;
            }
            elseif($product->color=='Green'){
               $color[4]+=1;
            }
        }

        $size=array(0,0,0,0,0);
        $products=Product::all();
        foreach ($products as $product){

            if($product->size=='XS'){
               $size[0]+=1;
            }
            elseif($product->size=='S'){
               $size[1]+=1;
            }
            elseif($product->size=='M'){
               $size[2]+=1;
            }
            elseif($product->size=='L'){
               $size[3]+=1;
            }
            elseif($product->size=='XL'){
               $size[4]+=1;
            }
        }
        return view('site.shop',compact('num','products','color','size'));
    }

    public function category($id)
    {
        $category=Category::find($id);
        return view('site.category',compact('category'));
    }

    public function add_to_cart(Request $request)
    {
        $count=1;
        if( $request->quantity){
            $count=$request->quantity;
        }
        $request->validate([
            'product_id'=>'exists:products,id'
        ]);
        $product=Product::select('price')->where('id',$request->product_id)->first();
        $cart=Cart::where('user_id',1)->where('product_id',$request->product_id)->first();
        if($cart){
            $cart->update([
                'quantity'=>$cart->quantity+ $count,
            ]);

        }else{
            Cart::create([
                'price'=> $product->price,
                'quantity'=>$count,
                'product_id'=>$request->product_id,
                'user_id'=>1,
            ]);
        }
       return redirect()->back();
    }

    public function remove_from_cart($id)
    {
       $cart=Cart::find($id);
       $cart->forcedelete();

       return redirect()->back();

    }

    public function add_review(Request $request)
    {
        $request->validate([
            'product_id'=>'exists:products,id',
        ]);

        Review::create([
            'review'=>$request->review,
            'name'=>$request->name,
            'email'=>$request->email,
            'product_id'=>$request->product_id,
            'user_id'=>1
        ]);

        return redirect()->back();
    }

    public function contact_data(Request $request)
    {
        $data=$request->except('_token');
        Mail::to('h.7383039@gmail.com')->send(new ContactData($data));

    }

   public function search(Request $request)
   {

    $products=Product::where('name','like','%'.$request->search.'%')->get();
    $search=$request->search;

    return view('site.shop',compact('products','search'));

   }
}
