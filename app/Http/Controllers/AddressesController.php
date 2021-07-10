<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Address;

use App\Http\Requests\Address\CreateAddressRequest;

use App\Http\Requests\Address\UpdateAddressRequest;

class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create-address')->with('user', auth()->user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAddressRequest $request, Address $address)
    {


        $int_user_id = (int)auth()->user()->id;

        $address = new Address;
        $address->address = $request->address;
        $address->municipality = $request->municipality;
        $address->user_id = $int_user_id;
        $address->save();


        session()->flash('success', 'Address added successfully to your profile');
        return redirect(route('users.index'));
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
    public function edit(Address $address)
    {
        return view('users.create-address')->with('address', $address)->with('user', auth()->user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAddressRequest $request, Address $address)
    {
        
        $int_user_id = (int)auth()->user()->id;

        Address::where('id', $address->id)->update([
            'address' => $request->address,
            'municipality' => $request->municipality,
            'user_id' => $int_user_id,
        ]);

        session()->flash('success', 'The address has been successfully updated');
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();
        session()->flash('success', 'The addres has been deleted successfully');
        return redirect(route('users.index'));
    }
}
