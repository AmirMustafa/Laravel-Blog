<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\Admin();
        $admin->email = "amirengg15@gmail.com";
        $admin->password = bcrypt("12345678");
        $admin->save();
    }
}
