<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    protected $permissions = [
        'show-categories' => 'Show_All_Categories',
        'add-category' => 'Add_New_Category',
        'edit-category' => 'Edit_Category',
        'delete-category' => 'Delete_Category',

        'show-products' => 'Show_All_Products',
        'add-product' => 'Add_New_Product',
        'edit-product' => 'Edit_Product',
        'delete-product' => 'Delete_Product',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->permissions as $code => $name) {
            Permission::create([
                'code' => $code,
                'name' => $name
            ]);
        }
    }
}
