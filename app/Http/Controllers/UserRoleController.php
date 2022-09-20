<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\UserRole\CreateRequest;
use App\Http\Requests\UserRole\EditRequest;
use App\Http\Resources\UserRoleResource;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(UserRole::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group UserRole
     */
    public function index(Request $request)
    {
        $user_roles = UserRole::with(['user','role','creater'])->pimp()->paginate();
        $message = "All Records"; 
        UserRoleResource::collection($user_roles);
        return $this->sendResponse(compact('user_roles'), $message);
    }

    /**
     * Add
     * @group UserRole
     */
    public function store(CreateRequest $request)
    {
        $userRole = UserRole::createUpdate(new UserRole, $request);
        $message = "User role added successfully";
        $userRole = new UserRoleResource($userRole);
        return $this->sendResponse(compact('userRole'), $message);
    }

    /**
     * Show
     * @group UserRole
     */
    public function show(UserRole $userRole, Request $request)
    {
        $user_role = $userRole->load(['user','role','creater']);
        $message = 'User role listed successfully';
        $user_role = new UserRoleResource($user_role);
        return $this->sendResponse(compact('user_role'), $message);
    }

    /**
     * Update
     * @group UserRole
     */
    public function update(EditRequest $request, UserRole $userRole)
    {
        $userRole = UserRole::createUpdate($userRole, $request);
        $message = "User role updated successfully";
        $userRole = new UserRoleResource($userRole);
        return $this->sendResponse(compact('userRole'), $message);
    }

    /**
     * Delete
     * @group UserRole
     */
    public function destroy(Request $request, UserRole $userRole)
    {
        $userRole->delete();
        $message = "User role deleted successfully";
        $userRole = new UserRoleResource($userRole);
        return $this->sendResponse(compact('userRole'), $message);
    }
}
