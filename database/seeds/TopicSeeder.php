<?php

use App\User;
use App\Category;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 15; $i++) {
            DB::table('topics')->insert([
                'title' => $faker->catchPhrase,
                'image' => 'https://images.unsplash.com/photo-1572470682591-d0fde2bd15a4?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80',
                'body' => $faker->text,
                'user_id' => User::all()->random()->id,
                'category_id' => Category::all()->random()->id,
                'approved' => true
            ]);
        }
    }
}
