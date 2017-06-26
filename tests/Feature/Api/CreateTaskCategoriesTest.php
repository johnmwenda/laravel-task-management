<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
// use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateTaskCategoriesTest extends TestCase
{
	use DatabaseMigrations;
    

    /** @test */
    function an_authenticated_user_can_create_task_categories()
    {	
        
    	// $this->withExceptionHandling();

    	//defined in parent TestCase class... provides a signedIn user
    	$this->signIn();

    	// print_r( auth()->user()->department_id );


    	$category = make('App\Category', ['department_id'=> auth()->user()->department_id] ); 

    	// print_r($category -> toArray());

    	$response = $this->post('/categories', $category->toArray() );

    	$this->assertDatabaseHas('categories', ['name' => $category->name]);
        $this->assertDatabaseHas('categories', ['department_id' => auth() -> user() ->department_id]);
    }
}
