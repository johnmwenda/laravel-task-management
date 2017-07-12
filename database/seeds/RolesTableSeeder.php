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
        $role_normal_employee->name = "User";
        $role_normal_employee->description = "Normal department member";
        $role_normal_employee->save();

        $create_task_category = new Permission();
        $create_task_category->name = "create task category";
        $create_task_category->description = "create task category";
        $create_task_category->save();

        $role_normal_employee->givePermissionTo($create_task_category);

        
        $role_department_admin = new Role();
        $role_department_admin->name = "Department Admin";
        $role_department_admin->description = "The department admin can do department administrative functions eg creating task categories";
        $role_department_admin->save();

        $administer_department = new Permission();
        $administer_department->name = "Administer departments functions";
        $administer_department->description = "administer department functions";
        $administer_department->save();

        $role_department_admin->givePermissionTo($administer_department);


        $role_department_head = new Role();
        $role_department_head->name = "Department Head";
        $role_department_head->description = "The department head";
        $role_department_head->save();

        $view_private_tasks = new Permission();
        $view_private_tasks->name = "view private tasks";
        $view_private_tasks->description = "view private tasks";
        $view_private_tasks->save();

        $role_department_head->givePermissionTo($view_private_tasks);


    }
}
