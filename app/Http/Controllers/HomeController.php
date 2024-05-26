<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function home()
    {

        $product = Product::all();

        if(Auth::id()){
            $user = Auth::user();

        $user_id = $user->id;

        $count = Cart::where('user_id',$user_id)->count();


        }
        else{

            $count= '' ;
        }

        
        return view('home.index', compact('product','count'));
    }

    public function login_home()
    {

        $product = Product::all();

        if(Auth::id()){
            $user = Auth::user();

        $user_id = $user->id;

        $count = Cart::where('user_id',$user_id)->count();


        }
        else{

            $count= '' ;
        }

        return view('home.index', compact('product','count'));
    }

    public function product_details($id)
    {
        $data = Product::find($id);

        if(Auth::id()){
            $user = Auth::user();

        $user_id = $user->id;

        $count = Cart::where('user_id',$user_id)->count();


        }
        else{

            $count= '' ;
        }

        return view('home.product_details', compact('data','count'));
    }

    public function add_cart($id)
    {
        $product_id = $id;

        $user = Auth::user();

        $user_id = $user->id;

        $data= new Cart;

        $data->user_id = $user_id;

        $data->product_id = $product_id;

        $data->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Added to the Cart Successfully');

        return redirect()->back();
    }

    public function mycart(){

        if(Auth::id()){

        $user = Auth::user();

        $user_id = $user->id;

        $count = Cart::where('user_id',$user_id)->count();

        $cart = Cart::where('user_id',$user_id)->get();

        }
        return view('home.mycart',compact('count','cart'));
    }

    public function delete_cart($id){

        $data = Cart::find($id);

        $data->delete();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Removed Successfully');

        return redirect()->back();

    }

    public function confirm_order(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->get();

        if ($cart->isEmpty()) {
            toastr()->error('Your cart is empty.');
            return redirect()->back();
        }

        foreach ($cart as $carts) {
            $order = new Order;
            $order->name = $request->name;
            $order->rec_address = $request->address;
            $order->phone = $request->phone;
            $order->user_id = $user->id;
            $order->product_id = $carts->product_id;
            $order->save();
        }

        Cart::where('user_id', $user->id)->delete();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Ordered Successfully');

        return redirect()->back();
    }
}
