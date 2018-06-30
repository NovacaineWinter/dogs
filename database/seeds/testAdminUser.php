<?php

use Illuminate\Database\Seeder;

class testAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new \App\User;
        $a->name = 'Admin Matt';
        $a->email = 'matt@matt.com';
        $a->password = \Hash::make('qwe');
        $a->save();
    }
}
