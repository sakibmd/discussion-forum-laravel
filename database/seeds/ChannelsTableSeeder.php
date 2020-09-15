<?php

use LaravelForum\Channel;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'name' => 'Laravel 7.0',
            'slug' =>  str_slug('Laravel 7.0'),
        ]);

        Channel::create([
            'name' => 'Angular 7',
            'slug' =>  str_slug('Angular 7'),
        ]);

        Channel::create([
            'name' => 'Node js',
            'slug' =>  str_slug('Node js'),
        ]);

        Channel::create([
            'name' => 'Machine Learning',
            'slug' =>  str_slug('Machine Learning'),
        ]);
    }
}
