<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userTypes = [
            [
                'id' => 1,
                'name' => 'admin',
                'permissions' => 'master',
            ],
            [
                'id' => 2,
                'name' => 'veterinarian',
                'permissions' => 'vets',
            ],
            [
                'id' => 3,
                'name' => 'groomer',
                'permissions' => 'groomers',
            ],
            [
                'id' => 4,
                'name' => 'client',
                'permissions' => 'customers',
            ],
        ];

        foreach ($userTypes as $userType) {
            UserType::updateOrCreate(['id' => $userType['id']], $userType);
        }
    }
}
