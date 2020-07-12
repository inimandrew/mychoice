<?php

use Illuminate\Database\Seeder;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'firstname' => 'Inim',
            'lastname' => 'Andrew',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('polinium'),
            'role_id' => '1',
            ]);
    }
}
