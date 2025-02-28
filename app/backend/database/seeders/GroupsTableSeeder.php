<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group; // Make sure to import your Group model

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            [
                'name'        => 'User',
                'permissions' => json_encode([
                    'home',
                    'logout',
                    'profile',
                    'permissions',
                    'orders_list',
                    'users_list',
                ]),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ];

        Group::insert($groups);
    }
}
