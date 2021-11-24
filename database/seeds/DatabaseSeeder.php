<?php

use App\{
    Screen,
    User,
    Timing,
    About
};
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($h=0; $h < 40; $h++) {
            Screen::create([
                'fingerprint' => Str::random(80),
            ]);
        }

        User::create([
            'name' => 'مشرف النظام',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'is_admin' => true,
            'section' => null,
            'remember_token' => null,
        ]);

        About::create([
            'string' => " Lorem ipsum, dolor sit amet consectetur adi
            pisicing elit. Voluptates consequuntur quaerat dicta, 
            modi odit cum, voluptatum unde tempora maxime esse re
            cusandae, nam iusto blanditiis minima quia laboriosam
             explicabo iure debitis.",
        ]);
    }
}
