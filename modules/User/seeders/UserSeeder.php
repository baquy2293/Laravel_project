<?php

namespace modules\User\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use modules\User\src\Models\User;
use module\User\src\Models;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $user = new User();
        $user->name = "baquy";
        $user->email = "baquy@gmail.com";
        $user->password = Hash::make('123456');
        $user->group_id = 1;
        $user->save();

    }
}
