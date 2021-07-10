<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;

use App\Item;

class OrdersController extends Controller
{
    public function store(Request $request)
    {
        $total_cost = session()->get('total_cost');
        $user_id = auth()->user()->id;
        $address = $request->address;
        $cart = session()->get('cart');
        $item_ids = array();
        $item_quantities = array();
        
        
        $order = Order::create([
            'cost' => $total_cost,
            'user_id' => $user_id,
            'address' => $address,
        ]);

        foreach($cart as $items => $item)
        {
            $i = $item['quantity'];
            for($i; $i > 0; $i--){
                array_push($item_ids, $item['item_id']);
            };
            
        }
        $order->items()->attach($item_ids);

        session()->put('cart', null);     
        return redirect(route('orders.index'));

    }

    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->get(); 
        return view('orders.index')->with('orders', $orders)->with('items', Item::all());
    }

    public function indexEmployee()
    {
        return view('orders.employee')->with('orders', Order::all())->with('items', Item::all());
    }

    public function updateProgress(Request $request, $id)
    {
        $order = Order::where('id', $id)->get();
        $data = $request->only(['progress']);

        if($request->progress == 'recieved')
        {
            Order::where('id', $id)->update($data);
            session()->flash('success', 'The order progress has been successfully updated.');
            return redirect(route('orders.employee'));
        }

        if($request->progress == 'making')
        {
            Order::where('id', $id)->update($data);
            session()->flash('success', 'The order progress has been successfully updated.');
            return redirect(route('orders.employee'));
        }

        if($request->progress == 'baking')
        {
            Order::where('id', $id)->update($data);
            session()->flash('success', 'The order progress has been successfully updated.');
            return redirect(route('orders.employee'));
        }

        if($request->progress == 'sent')
        {
            Order::where('id', $id)->update($data);
            session()->flash('success', 'The order progress has been successfully updated.');
            return redirect(route('orders.employee'));
        }

        if($request->progress == 'finished')
        {
            Order::where('id', $id)->update($data);
            session()->flash('success', 'The order progress has been successfully updated.');
            return redirect(route('orders.employee'));
        }

        session()->flash('error', 'The order could not be updated');
        return redirect(route('orders.employee'));
                
    }

}
