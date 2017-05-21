<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         //$this->call(NiceActionSeeder::class);      //registering our first seeder

        //Model::reguard();

        $this->call(AdminTableSeeder::class);      //registering our first seeder

        $this->call(CategoryTableSeeder::class);      //registering our first seeder
    }
}
