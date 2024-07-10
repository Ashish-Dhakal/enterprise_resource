<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         \App\Models\User::factory(10)->create();


        \App\Models\User::factory()->create(
            [
                'name' => 'Admin',
                'email' => 'admin@erp.test',
                'password' => bcrypt('12345678'),
                'role' => 'Admin'
            ]);

        $user = \App\Models\User::factory()->create(
            [
                'name' => 'User',
                'email' => 'user@erp.test',
                'password' => bcrypt('user'),
                'role' => 'User'
            ]
        );

        \App\Models\Employee::create(
            [
                'first_name' => $user->name,
                'user_id' => $user->id,
                'email' => $user->email,
            ]
        );

        $ramesh = \App\Models\User::factory()->create(
            [
                'name' => 'Ramesh',
                'email' => 'ramesh@erp.test',
                'password' => bcrypt('user'),
                'role' => 'User'
            ]
        );

        \App\Models\Employee::create(
            [
                'first_name' => $ramesh->name,
                'user_id' => $ramesh->id,
                'email' => $ramesh->email,
            ]
        );


        $this->call(DepartmentSeeder::class);
    }
}
