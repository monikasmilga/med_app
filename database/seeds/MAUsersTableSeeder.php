<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MAUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('id' => 1,
                'email' => 'demo@demo',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'role_id' => 1,
                'remember_token' => 'abcdef',
                'position' => 'Doctor',
                'password' => Hash::make('demodemo'),
                ),
        );
        DB::table('ma_users')->insert($data);
    }
}
