<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = ['Web', 'App', 'Designer', 'UI/UX', 'Administration'];
        $positions = ['Intern', 'Staff', 'Manager'];


        foreach ($departments as $department)
        {
            $d = Department::create([
                'title' => $department
            ]);

            foreach ($positions as $position)
            {
                Position::create([
                    'title' => $position,
                    'department_id' => $d->id
                ]);
            }
        }



       



    }
}
