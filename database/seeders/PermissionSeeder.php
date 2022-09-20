<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Permission::factory()->create([
            'name' => 'BRAND',
            'label' => 'Brand',
        ]);
        \App\Models\Permission::factory()->create([
            'parent_id' => '1',
            'name' => 'VIEW',
            'label' => 'View',
        ]);
        \App\Models\Permission::factory()->create([
            'parent_id' => '1',
            'name' => 'ADD',
            'label' => 'Add',
        ]);
        \App\Models\Permission::factory()->create([
            'parent_id' => '1',
            'name' => 'EDIT',
            'label' => 'Edit',
        ]);
        \App\Models\Permission::factory()->create([
            'parent_id' => '1',
            'name' => 'DELETE',
            'label' => 'Delete',
        ]);
        \App\Models\Permission::factory()->create([
            'name' => 'PRODUCT',
            'label' => 'Product',
        ]);
        \App\Models\Permission::factory()->create([
            'parent_id' => '6',
            'name' => 'VIEW',
            'label' => 'View',
        ]);
        \App\Models\Permission::factory()->create([
            'parent_id' => '6',
            'name' => 'ADD',
            'label' => 'Add',
        ]);
        \App\Models\Permission::factory()->create([
            'parent_id' => '6',
            'name' => 'EDIT',
            'label' => 'Edit',
        ]);
        \App\Models\Permission::factory()->create([
            'parent_id' => '6',
            'name' => 'DELETE',
            'label' => 'Delete',
        ]);
    }
}
