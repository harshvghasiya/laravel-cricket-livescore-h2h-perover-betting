<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $res=new User;
        $res->name='Admin';
        $res->email='admin@gmail.com';
        $res->password= \Hash::make('123456');
        $res->image='164412308640369813-96DB-458F-BBE6-2F40A5BB4F79.jpg';
        $res->status='1';
        $res->right_id=17;
        $res->save();
    }
}
