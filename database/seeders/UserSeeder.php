<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'Ryan Menezes',
        	'email' => 'menezesryan1010@gmail.com',
        	'password' => bcrypt('12345678')
        ]);

        $user->roles()->sync(3);
    }
}
