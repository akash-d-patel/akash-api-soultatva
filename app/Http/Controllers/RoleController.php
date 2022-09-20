<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Role\CreateRequest;
use App\Http\Requests\Role\EditRequest;
use App\Http\Resources\RoleResource;

class RoleController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Role::class);
        $this->getMiddleware();
    }
    /**
     * List
     * @group Role
     */
    public function index(Request $request)
    {
        $roles = Role::with('creater')->pimp()->paginate();
        RoleResource::collection($roles);
        return $this->sendResponse(compact('roles'), "All Record");
    }

    /**
     * Add
     * @group Role
     */
    public function store(CreateRequest $request)
    {
        $role = Role::createUpdate(New Role, $request);
        $message = "Role added successfully";
        $role = new RoleResource($role);
        return $this->sendResponse(compact('role'), $message);
    }

    /**
     * Show
     * @group Role
     */
    public function show(Role $role, Request $request)
    {
        $message = 'Role listed successfully';
        $role = new RoleResource($role);
        return $this->sendResponse(compact('role'), $message);
    }

    /**
     * Update
     * @group Role
     */
    public function update(EditRequest $request, Role $role)
    {
        $role = Role::createUpdate($role, $request);
        $message = "Role updated successfully";
        $role = new RoleResource($role);
        return $this->sendResponse(compact('role'), $message);
    }

    /**
     * Delete
     * @group Role
     */
    public function destroy(Role $role, Request $request)
    {
        $role->delete();
        $message = "Role deleted successfully";
        $role = new RoleResource($role);
        return $this->sendResponse(compact('role'), $message);
    }
}
