<?php

use Illuminate\Database\Seeder;

class PostTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('postTypes')->insert([
                    'type'  => 'published' ,
                  ]);
        DB::table('postTypes')->insert([
                    'type'  => 'draft' ,
                  ]);
        DB::table('postTypes')->insert([
                    'type'  => 'personal' ,
                  ]);
    }
}
