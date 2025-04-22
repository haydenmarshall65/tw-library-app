<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // customer
        Role::create([
            'name' => 'customer'
        ]);
        //librarian
        $librarianRole = Role::create(['name' => 'librarian']);

        $librarianRole->givePermissionTo(Permission::create(['name' => 'create books']));
        $librarianRole->givePermissionTo(Permission::create(['name' => 'edit books']));
        $librarianRole->givePermissionTo(Permission::create(['name' => 'delete books']));
        $librarianRole->givePermissionTo(Permission::create(['name' => 'return books']));
    }
}
