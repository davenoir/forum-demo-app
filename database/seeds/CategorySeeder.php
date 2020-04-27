<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['General', 'Entertainment', 'Sports', 'Movies', 'Politics', 'Automotive'];
        foreach($categories as $category) {
            DB::table('categories')->insert([
                'category_name'=>$category
            ]);
        }
    }
}
