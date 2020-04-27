<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'guest'];
        foreach($roles as $role) {
            DB::table('roles')->insert([
                'name'=>$role
            ]);
        }
    }
}
