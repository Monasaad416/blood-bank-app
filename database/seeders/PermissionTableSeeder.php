<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'roles-list',
            'role-create',
            'role-edit',
            'role-delete',
            'role-show',

            'users-list',
            'user-create',
            'user-edit',
            'user-delete',

            'governorates-list',
            'governorate-create',
            'governorate-edit',
            'governorate-delete',

            'cities-list',
            'city-create',
            'city-edit',
            'city-delete',

            'categories-list',
            'category-create',
            'category-edit',
            'category-delete',

            'posts-list',
            'post-create',
            'post-edit',
            'post-delete',
            'post-show',

            'clients-list',
            'client-delete',
            'client-toggle-status',

            'donation-requests-list',
            'donation-request-delete',
            'donation-request-show',

            'setting-edit',

            'messages-list',
            'message-show',
            'message-delete',

         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
