<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Address\CreateRequest;
use App\Http\Requests\Address\EditRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class UserAddressController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Address::class);
        $this->getMiddleware();
    }
    /**
     * List
     * @group UserAddress
     */
    public function index(User $user, Request $request)
    {
        $addresses = Address::whereHas('user', function ($query) use ($user) {
            $query->where('id',  $user->id);
            return $query;
        })->pimp()->paginate();
        AddressResource::collection($addresses);
        return $this->sendResponse(compact('user', 'addresses'), "All Records");
    }

    /**
     * Add
     * @group UserAddress
     */
    public function store(User $user, Address $address, CreateRequest $request)
    {
        $address = Address::createUpdateUserAddress($user, $address, $request);
        $message = "User address added successfully";
        $address = new AddressResource($address);
        return $this->sendResponse(compact('address'), $message);
    }

    /**
     * Show
     * @group UserAddress
     */
    public function show(User $user, Address $address, Request $request)
    {
        $message = "User address listed successfully";
        $address = new AddressResource($address);
        return $this->sendResponse(compact('address'), $message);
    }

    /**
     * Update
     * @group UserAddress
     */
    public function update(User $user, Address $address, EditRequest $request)
    {
        $address = Address::createUpdateUserAddress($user,$address, $request);
        $message = "User address updated successfully";
        $address = new AddressResource($address);
        return $this->sendResponse(compact('address'),$message);
    }

    /**
     * Delete
     * @group UserAddress
     */
    public function destroy(User $user, Address $address, Request $request)
    {
        $address->delete();
        $message = "User address deleted successfully";
        $address = new AddressResource($address);
        return $this->sendResponse(compact('address'), $message);
    }
}
