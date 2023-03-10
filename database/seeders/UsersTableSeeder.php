<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'Jony Tonet';
        $user->email = 'jonytonet@gmail.com';
        $user->password = '12345678';
        $user->user_type_id = 1;
        $user->cpf = '04355568946';
        $user->rg = '90978683';
        $user->gender = 'male';
        $user->cellphone_number = '41991482508';
        $user->phone_number = '4130852508';
        $user->alternate_contact_name = 'Nadia Kelly';
        $user->alternate_contact_cellphone_number = '41996899815';
        $user->save();
    }
}
