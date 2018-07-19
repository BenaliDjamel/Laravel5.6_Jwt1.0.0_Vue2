<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Beverage;

class BeveragesTest extends TestCase
{
    use DatabaseMigrations;
    private  $beverage;

    
    public function setup()
    {
        parent::setup();
        $this->beverage = factory(Beverage::class)->make();
    }
    
   

    public function test_factory_has_name() {

        
        

        $this->assertNotEmpty( $this->beverage->name);
    }

    public function test_factory_has_type() {

        
        

        $this->assertNotEmpty( $this->beverage->type);
    }
}
