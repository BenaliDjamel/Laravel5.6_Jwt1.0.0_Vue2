<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;


class UserModelTest extends TestCase
{
   use DatabaseMigrations;
  //  use RefreshDatabase;
   

    public function test_name_if_present() {
        $user = User::create([
            'name' => "benali djamel",
            'email'=> "eee@gmail.com",
            'password' => bcrypt(123456)

        ]);

        $this->assertEquals("benali djamel",$user->name);
    }


   /* public function test_if_email_exists() {
        $this->assertDatabaseHas('users',[
            'email'=>"eee@gmail.com"
        ]);
    }*/
}
