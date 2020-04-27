<?php

use App\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'username' => $faker->userName,
                'email' => $faker->email,
                'password' => Hash::make($faker->password),
                'role_id' => Role::all()->random()->id
            ]);
        }
    }
}
