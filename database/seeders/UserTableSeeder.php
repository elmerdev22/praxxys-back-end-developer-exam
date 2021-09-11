<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{
            
            User::create([
                'username' => 'admin',
                'email'    => 'admin@admin.com',
                'type'     => 'admin',
                'password' => Hash::make('password'),
            ]);

        }catch(\Exception $e){
            dd($e);
        }
    }
}
