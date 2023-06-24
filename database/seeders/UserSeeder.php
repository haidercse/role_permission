<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','admin@gmail.com')->first();
        if (is_null($user)) {
           $user = User::create([
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'password'=> Hash::make('12345678'),
                'username' => 'admin',
                'is_super_admin' => 1,

             ]);
            $user->assignRole('super-admin');
        }



    }
}
