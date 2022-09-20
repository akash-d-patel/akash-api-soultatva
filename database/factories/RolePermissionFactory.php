<?php

namespace Database\Factories;

use App\Models\RolePermission;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;

use Illuminate\Database\Eloquent\Factories\Factory;

class RolePermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RolePermission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'role_id' => Role::all()->random()->id,
            'permission_id' => Permission::all()->random()->id,
            'created_by' => User::all()->random()->id
        ];
    }
}
