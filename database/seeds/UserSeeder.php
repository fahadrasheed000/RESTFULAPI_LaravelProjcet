<?php

use Illuminate\Database\Seeder;

use App\Models\User;

use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncate table before insert data to get fresh data
        Schema::disableForeignKeyConstraints();

        User::truncate();


        Schema::enableForeignKeyConstraints();


        $user = User::create([
        	'name' => 'Fahad Rasheed',
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('12345678')
        ]);
      
    }
}
