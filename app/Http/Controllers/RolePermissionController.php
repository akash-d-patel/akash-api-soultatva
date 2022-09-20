<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\RolePermission\CreateRequest;
use App\Http\Requests\RolePermission\EditRequest;
use App\Http\Resources\RolePermissionResource;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class RolePermissionController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(RolePermission::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group RolePermission
     */
    public function index(Request $request)
    {
        $role_permissions = RolePermission::with(['role','permission','creater'])->pimp()->paginate();
        $message = "All Records"; 
        RolePermissionResource::collection($role_permissions); 
        return $this->sendResponse(compact('role_permissions'), $message);
    }

    /**
     * Add
     * @group RolePermission
     */
    public function store(CreateRequest $request)
    {
        $rolePermission = RolePermission::createUpdate(new RolePermission, $request);
        $message = "Role permission added successfully";
        $rolePermission = new RolePermissionResource($rolePermission);
        return $this->sendResponse(compact('rolePermission'), $message);
    }

    /**
     * Show
     * @group RolePermission
     */
    public function show(RolePermission $rolePermission)
    {
        $role_permission = $rolePermission->load('role','permission','creater');
        $message = 'Role permission listed successfully';
        $role_permission = new RolePermissionResource($role_permission);
        return $this->sendResponse(compact('role_permission'), $message);
    }

    /**
     * Update
     * @group RolePermission
     */
    public function update(EditRequest $request, RolePermission $rolePermission)
    {
        $rolePermission = RolePermission::createUpdate($rolePermission, $request);
        $message = "Role permission updated successfully";
        $rolePermission = new RolePermissionResource($rolePermission);
        return $this->sendResponse(compact('rolePermission'), $message);
    }

    /**
     * Delete
     * @group RolePermission
     */
    public function destroy(Request $request, RolePermission $rolePermission)
    {
        $rolePermission->delete();
        $message = "Role permission deleted successfully";
        $rolePermission = new RolePermissionResource($rolePermission);
        return $this->sendResponse(compact('rolePermission'), $message);
    }
}
