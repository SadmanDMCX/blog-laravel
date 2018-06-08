<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'site_name' => 'Laravel\'s Blog',
            'contact_number' => '019 11 22 99 66',
            'contact_email' => 'info@larablog.com',
            'address' => 'Bangladesh, Dhaka'
        ]);
    }
}
