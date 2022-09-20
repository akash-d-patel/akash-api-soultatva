<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\EditRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
        $this->getMiddleware();
    }
    
    /**
     * List
     * @group User
     */
    public function list(Request $request)
    {
        $users = User::with(['creater'])->pimp()->paginate();
        $message = "All records";
        UserResource::collection($users);
        return $this->sendResponse(compact('users'), $message);
    }

    /**
     * Add
     * @group User
     */
    public function storeUser(CreateRequest $request)
    {
        $user = User::createUpdate(New User, $request);
        $message = "User added successfully";
        $user = new UserResource($user);
        return $this->sendResponse(compact('user'),$message);
    }

    /**
     * Show
     * @group User
     */
    public function showUser(User $user, Request $request)
    {
        $message = "Users listed succesfully!!";
        $user = new UserResource($user);
        return $this->sendResponse(compact('user'),$message);
    }

    /**
     * Update
     * @group User
     */
    public function updateUser(EditRequest $request, User $user)
    {
        $user = User::createUpdate($user, $request);
        $message = "User updated successfully!!";
        $user = new UserResource($user);
        return $this->sendResponse(compact('user'),$message);
    }

    /**
     * Delete
     * @group User
     */
    public function destroyUser(User $user, Request $request)
    {
        $user->delete();
        $message = "User deleted successfully!!";
        $user = new UserResource($user);
        return $this->sendResponse(compact('user'),$message);
    }
}
