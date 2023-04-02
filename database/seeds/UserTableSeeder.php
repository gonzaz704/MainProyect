<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $user = User::create([
            'name' => 'Gonzalo',
            'email' => 'gonzaz704@gmail.com',
            'password' => Hash::make('JnR390XB')
        ]);
        // $role = Role::where('name','Admin')->first();
        $user->assignRole('Admin');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('JnR390XB')
        ]);
        $user->assignRole('User');

        $user = User::create([
            'name' => 'Author',
            'email' => 'author@gmail.com',
            'password' => Hash::make('JnR390XB')
        ]);

        $user->assignRole('Author');
       
    }
}