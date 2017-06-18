<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_normal_employee = new Role();
        $role_normal_employee->name = "Normal Employee";
        $role_normal_employee->description = "Normal department member";
        $role_normal_employee->save();

        $create_task_category = new Permission();
        $create_task_category->name = "create task category";
        $create_task_category->description = "create task category";
        $create_task_category->save();

        $role_normal_employee->givePermissionTo($create_task_category);


        $role_department_head = new Role();
        $role_department_head->name = "Department Head";
        $role_department_head->description = "The department head";
        $role_department_head->save();

        $create_task_category = new Permission();
        $create_task_category->name = "view private tasks";
        $create_task_category->description = "view private tasks";
        $create_task_category->save();

        $role_department_head->givePermissionTo('view private tasks');


    }
}
