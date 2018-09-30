<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $posts = [
        	['title'=>'Tips Cepat Mengumpulkan Bitcoin','content'=>'lorem ipsum'],
        	['title'=>'Memilih VGA Card Untuk Mining Dogecoin','content'=>'lorem ipsum'],
        	['title'=>'Coin Virtual Dari Tanah Air','content'=>'lorem ipsum']
        ];

        //memasukan data ke database
        DB::table('posts')->insert($posts);
    }
}
