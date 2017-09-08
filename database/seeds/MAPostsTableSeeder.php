<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MAPostsTableSeeder extends Seeder
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
                'user_id' => '1',
                'title' => 'Post',
                'text' => 'Hello world, this is my post',
            ),
        );
        DB::table('ma_posts')->insert($data);
    }
}
