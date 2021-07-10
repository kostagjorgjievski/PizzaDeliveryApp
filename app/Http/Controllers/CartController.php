<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

class CartController extends Controller
{
    public function index(){
        return view('cart.index')->with('items', Item::all());
    }

    public function addToCart($id){
        $int_id = (int)$id;
        $item = Item::where('id', $int_id)->first();
        if(!$item) {
            abort(404);
        }

        $cart = session()->get('cart');
        $total_cost = session()->get('total_cost');
        
 
        // if cart is empty then this the first menu item
        if(!$cart) {
            $cart = [
                    $id => [
                        'item_id' => $item->id,
                        'title' => $item->title,
                        'quantity' => 1,
                        'price' => $item->price,
                        'image' => $item->image,                       
                    ],
                               
            ];
            $total_cost = $cart[$id]['price']; 
            
            session()->put('cart', $cart);
            session()->put('total_cost', $total_cost);
            session()->flash('success', 'Item added to your cart successfully');
            return redirect(route('cart.index'));
        }

        // if cart is already has this item
        if(isset($cart[$id])) {
            
            $cart[$id]['quantity']++;
            $total_cost += $cart[$id]['price'];
     
            session()->put('cart', $cart);
            session()->put('total_cost', $total_cost);    
            session()->flash('success', 'Item added to your cart successfully');
            return redirect(route('cart.index'));    
        }

        // if cart doesnt have this item
        $cart[$id] = [
            'item_id' => $item->id,
            'title' => $item->title,
            'quantity' => 1,
            'price' => $item->price,
            'image' => $item->image,
        ];
        $total_cost += $cart[$id]['price'];
 
        session()->put('cart', $cart);
        session()->put('total_cost', $total_cost);
        session()->flash('success', 'The item has been added to your cart');
        return redirect(route('cart.index'));
    }

    public function viewCart(){
        $cart = session()->get('cart');

        if(!$cart) {
            $cart = [];           
            session()->put('cart', $cart);
        }
        return view('cart.view')->with('cart', session('cart'));
    }

    public function update(Request $request)
    {
        
        if($request->items and $request->quantity)
        {
            $cart = session()->get('cart');
            $total_cost = session()->get('total_cost');

            if($request->operator == "+")
            {
                $cart[$request->items]['quantity']++;
                $total_cost += $cart[$request->items]['price'];
            }
            else{
                $cart[$request->items]['quantity']--;
                $total_cost -= $cart[$request->items]['price'];
            }
            session()->put('cart', $cart);
            session()->put('total_cost', $total_cost); 
            session()->flash('success', 'The cart has been successfully updated.');
            return redirect(route('cart.viewCart'));
        }


    }
 
    public function remove(Request $request)
    {
        
        if($request->items) {
            $total_cost = session()->get('total_cost');
            $cart = session()->get('cart');

            
            if(isset($cart[$request->items])) {
                $total_cost -= $cart[$request->items]['quantity'] * $cart[$request->items]['price'];
                unset($cart[$request->items]);

                session()->put('total_cost', $total_cost); 
                session()->put('cart', $cart);
            }
 
            session()->flash('success', 'The item has been successfully removed.');
            return redirect(route('cart.viewCart'));
        }
    }
}
