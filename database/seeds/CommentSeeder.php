<?php

use App\User;
use App\Topic;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 155; $i++) {
            DB::table('comments')->insert([
                'comment_body' => $faker->text,
                'user_id' => User::all()->random()->id,
                'topic_id' => Topic::all()->random()->id,
                'reported'=> false
            ]);
        }
    }
}
