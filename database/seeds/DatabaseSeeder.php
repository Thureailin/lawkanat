<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        /*User::Create([
    		'name' => "Testing Owner",
    		'email' => "burmateahouse@gmail.com",
    		'password' => \Hash::make('teahouse123@'),
    		'role_flag' => 1,
    		'prohibition_flag' => 1,
    		'phone' => "09250206903",
    		'address' => "Yangon Mynmar",
            'photo_path' => "user.jpg",
    	]);*/
    }
}
