<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$department = Department::first();

        $cat = new Category();
        $cat->name = 'EMPLOYEE ONBOARDING';
        $cat->description = 'All tasks related to onboarding a new employee come here';
        $cat->department_id = $department->id;
        $cat->save();
    }
}
