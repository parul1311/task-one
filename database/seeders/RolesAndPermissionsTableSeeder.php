<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laratrust\Models\LaratrustPermission;
use Laratrust\Models\LaratrustRole;
use App\Models\User;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        $admin = LaratrustRole::firstOrCreate(
            [
            'name' => 'admin',
            'display_name' => 'Admin'
            ]
        );
        LaratrustRole::firstOrCreate(
            [
            'name' => 'user',
            'display_name' => 'User'
            ]
        );

        $manageViewUsers = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_users',
            'display_name' => 'Manage User View',
            ]
        );
        $manageAddUsers = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_user',
            'display_name' => 'Manage User Add',
            ]
        );
        $manageEditUsers = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_user',
            'display_name' => 'Manage User Edit',
            ]
        );
        $manageDeleteUsers = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_user ',
            'display_name' => 'Manage User Delete',
            ]
        );
        $manageViewCategories = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_categories',
            'display_name' => 'Manage categories View',
            ]
        );
        $manageAddCategories = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_category',
            'display_name' => 'Manage category Add',
            ]
        );
        $manageEditCategories = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_category',
            'display_name' => 'Manage category Edit',
            ]
        );
        $manageDeleteCategories = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_category ',
            'display_name' => 'Manage category Delete',
            ]
        );
        // Attaching
        $admin->attachPermission($manageViewUsers);
        $admin->attachPermission($manageAddUsers);
        $admin->attachPermission($manageEditUsers);
        $admin->attachPermission($manageDeleteUsers);
        $admin->attachPermission($manageViewCategories);
        $admin->attachPermission($manageAddCategories);
        $admin->attachPermission($manageEditCategories);
        $admin->attachPermission($manageDeleteCategories);
       
        
     
    }
}
