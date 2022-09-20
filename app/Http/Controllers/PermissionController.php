<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Permission\CreateRequest;
use App\Http\Requests\Permission\EditRequest;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Permission::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Permission
     */
    public function index(Request $request)
    {
        $permissions = Permission::with('creater')->pimp()->paginate();
        PermissionResource::collection($permissions);
        return $this->sendResponse(compact('permissions'), "All Record");
    }

    /**
     * Add
     * @group Permission
     */
    public function store(CreateRequest $request)
    {
        $permission = Permission::createUpdate(New Permission, $request);
        $message = "Permission added successfully";
        $permission = new PermissionResource($permission);
        return $this->sendResponse(compact('permission'), $message);
    }

    /**
     * Show
     * @group Permission
     */
    public function show(Permission $permission, Request $request)
    {
        $message = 'Permission listed successfully';
        $permission = new PermissionResource($permission);
        return $this->sendResponse(compact('permission'), $message);
    }

    /**
     * Update
     * @group Permission
     */
    public function update(EditRequest $request, Permission $permission)
    {
        $permission = Permission::createUpdate($permission, $request);
        $message = "Permission updated successfully";
        $permission = new PermissionResource($permission);
        return $this->sendResponse(compact('permission'), $message);
    }

    /**
     * Delete
     * @group Permission
     */
    public function destroy(Request $request, Permission $permission)
    {
        $permission->delete();
        $message = "Permission deleted successfully";
        $permission = new PermissionResource($permission);
        return $this->sendResponse(compact('permission'), $message);
    }
}
