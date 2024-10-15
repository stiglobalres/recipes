<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    public function test_home_page()
    {
        ob_get_level();
        $response = $this->get('/');

        $response->assertStatus(200);
        ob_get_contents();
        ob_end_clean();
    }

    public function test_recipe_page() 
    {
        ob_get_level();
        $title = "Creamy White Chicken Chili";
        $id = 9074;
        $url= route('recipe',['title'=>str_replace(' ','-',strtolower($title)), 'id'=>$id ]);
        
        $response = $this->get($url);
        $response->assertStatus(200);
        $response->assertSee('Instructions');
        ob_get_contents();
        ob_end_clean();
    }

    public function test_recipe_not_found() 
    {
       
        $title = "Creamy White Chicken Chili";
        $id = 1;
        $url= route('recipe',['title'=>str_replace(' ','-',strtolower($title)), 'id'=>$id ]);
        
        $response = $this->get($url);
        $response->assertStatus(404);
        $response->assertSee('Not Found');
        $response->assertDontSee($title);
       
    }
}
