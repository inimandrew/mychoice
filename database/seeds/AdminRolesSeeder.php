<?php

use Illuminate\Database\Seeder;

class AdminRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Super Administrator','Administrator'];

        foreach($roles as $role){
            DB::table('admin_roles')->insert([
                'name' => $role
                ]);
        }
    }
}
