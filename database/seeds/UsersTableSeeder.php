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
        $user = App\User::create([
           'name' => 'SadmanDMCX',
            'email' => 'sadman@gmail.com',
            'password' => bcrypt('123123'),
            'admin' => 1
        ]);

        App\Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/images/default.jpg',
            'about' => 'I am software engineer. I do love make applications and I am a passionate professional.',
            'facebook' => 'https://facebook.com',
            'youtube' => 'https://youtube.com',
        ]);
    }
}
