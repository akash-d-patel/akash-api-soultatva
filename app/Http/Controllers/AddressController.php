<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Requests\Address\CreateRequest;
use App\Http\Requests\Address\EditRequest;
use App\Http\Resources\AddressResource;

class AddressController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Address::class);
        $this->getMiddleware();
    }
     
    public function index(Request $request)
    {
        $page_title = 'Address';
        $addresses = Address::with('creater')->pimp()->paginate();
        $message = "All Records";
        AddressResource::collection($addresses);
        return $this->sendResponse(compact('page_title', 'addresses'), $message);
    }

    /**
     * Add
     * @group Address 
     */

    public function store(CreateRequest $request)
    {
        // $request->validate([

        //     'mobile_no' => 'required|digits:10|numeric',
        //     'pin_code' => 'required|digits:6|numeric',
        // ]);
        $address = Address::createUpdate(New Address, $request);
        $message = "Address added succesfully";
        $address = new AddressResource($address);
        return $this->sendResponse(compact('address'), $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Address $address)
    {
        // $request->validate([

        //     'mobile_no' => 'required|digits:10|numeric',
        //     'pin_code' => 'required|digits:6|numeric',
        // ]);
        $address = Address::createUpdate($address, $request);
        $message = "Address updated succesfully";
        $address = new AddressResource($address);
        return $this->sendResponse(compact('address'), $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address, Request $request)
    {
        $address->delete();
        $message = "Address deleted succesfully";
        $address = new AddressResource($address);
        return $this->sendResponse(compact('address'), $message);
    }
}