<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\User::create([
            'email' =>"test@ssdsd.com",
            "password" => md5("123")
        ]);
    }
}
