<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

use App\Category;

use App\Http\Requests\Item\CreateItemRequest;

use App\Http\Requests\Item\UpdateItemRequest;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('items.index')->with('items', Item::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create')->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateItemRequest $request)
    {      
        if($request->availability == 1){
            $available = '1';
        }else{
            $available = '0';
        }

        $image = $request->image->store('items');
        $int_category = (int)$request->category;
        $int_price = (int)$request->price;

        $item = new Item;
        $item->title = $request->title;
        $item->description = $request->description;
        $item->price = $int_price;
        $item->category_id = $int_category;
        $item->image = $image;
        $item->inStock = $available;

        $item->save();


        
        session()->flash('success', 'The menu item was created successfully');
        return redirect(route('items.index'));
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
    public function edit(Item $item)
    {
        return view('items.create')->with('item', $item)->with('categories', Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $data = $request->only(['title', 'description']);

        if($request->availability == 1){
            $data['inStock'] = '1';
        }else{
            $data['inStock'] = '0';
        }

        if($request->hasFile('image')){
            $image = $request->image->store('images');
            $item->deleteImage(); // GETS THE FUNCTION FROM POST.php
            $data['image'] = $image;
        }
          
        $data['category_id'] = (int)$request->category;
        $data['price'] = (int)$request->price;


        Item::where('id', $item->id)->update($data);
        session()->flash('success', 'The menu item was updated successfully');
        return redirect(route('items.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        session()->flash('success', 'The menu item was successfully deleted.');
        return redirect(route('items.index'));
    }
}
