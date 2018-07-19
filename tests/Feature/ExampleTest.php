<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;


class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_Number_If_Not_Null() {

       // $this->assertEquals(5,5);
       $this->assertNull(null);
    }

    public function testFailure()
    {
        $this->assertCount(1, ['foo']);
    }

    public function test_if_user_can_beverage() {

        $response = $this->get('/b');
        $response->assertStatus(200);
        $response->assertSee('djamel');

    }

    public function test_if_user_can_visit_route() {
        $beverage = factory(User::class)->make();
        $response =  $this->get('/b'.$beverage->id);
        $response->assertStatus(200);

    }

    public function test_check_if_user_exists() {

        $data = [
            'name'=>'ayat aminea',
           'email'=>'ayat@gmail.com',
            'password'=>bcrypt('123456')
        ];
         $response = $this->post('/u',$data);
// $response->assertStatus(201);
      $this->assertDatabaseHas('users',$data);
    
    }
}
