<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

    	$faker = Faker\Factory::create();

    	$limit = 33;

    	for ($i = 0; $i < $limit; $i++) {
            DB::table('users')->insert([
            	'name' => $faker->name,
            	'email' => $faker->unique()->email,
            	'password' => rand ( 111111 , 999999 ),
            	'costumer_id' => rand ( 1111111111 , 9999999999 ),
            	'type_id' => 1
            	]);
        }
    }
}