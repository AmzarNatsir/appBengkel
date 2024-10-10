<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin321')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Syed Ahsan Kamal',
            'email' => 'ahsan@allphptricks.com',
            'password' => Hash::make('admin321')
        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $productManager = User::create([
            'name' => 'Abdul Muqeet',
            'email' => 'muqeet@allphptricks.com',
            'password' => Hash::make('admin321')
        ]);
        $productManager->assignRole('Product Manager');

        // Creating Application User
        $user = User::create([
            'name' => 'Naghman Ali',
            'email' => 'naghman@allphptricks.com',
            'password' => Hash::make('admin321')
        ]);
        $user->assignRole('User');
    }
}
