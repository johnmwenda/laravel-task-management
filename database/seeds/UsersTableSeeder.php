<?php

use App\Department;
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Traits\HasRoles;

class UsersTableSeeder extends Seeder
{
	use HasRoles;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// $dept = new Department();
    	// $dept->name = 'Administration Department';
    	// $dept->description = 'Administrators department stuff here';
    	// $dept->save();

    	// print_r(Department::first());
    	// print_r(Department::first()->id);
        $user = new User();
        $user->name = 'Victor Normal User';
        $user->email='victor@gmail.com';
        $user->avatar = 'dist/img/user2-160x160.jpg';
        $user->user_type = 'normal';
        $user->password=bcrypt('victor123');
        $user->department_id = Department::first()->id;
        $user->save();
        $user->assignRole(['User']);

        $user = new User();
        $user->name = 'Brenda Wambui';
        $user->email='brenda@gmail.com';
        $user->avatar = 'dist/img/user2-160x160.jpg';
        $user->user_type = 'normal';
        $user->password=bcrypt('password');
        $user->department_id = Department::first()->id;
        $user->save();
        $user->assignRole(['User']);

        $dept_head = new User();
        $dept_head->name = 'Alice Department Head';
        $dept_head->email='alice@gmail.com';
        $dept_head->avatar = 'dist/img/user2-160x160.jpg';
        $dept_head->user_type = 'department_head';
        $dept_head->password=bcrypt('alice123');
        $dept_head->department_id =  Department::first()->id;
        $dept_head->save();
        $dept_head->assignRole(['Department Head']);
        $dept_head->assignRole(['User']);


        $dept_head = new User();
        $dept_head->name = 'Mark Department Administrator';
        $dept_head->email='mark@gmail.com';
        $dept_head->avatar = 'dist/img/user2-160x160.jpg';
        $dept_head->user_type = 'normal';
        $dept_head->password=bcrypt('alice123');
        $dept_head->department_id =  Department::first()->id;
        $dept_head->save();
        // $dept_head->assignRole(['Department Head']);
        $dept_head->assignRole(['User']);
        $dept_head->assignRole(['Department Admin']);
        
    }
}
