<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dept = new Department();
        $dept->name = 'Administration Department';
        $dept->description = 'Administrators department stuff here';
        $dept->save();
    }
}
