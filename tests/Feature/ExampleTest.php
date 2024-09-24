<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        
        $session = $this->app['session']->all();
        \Illuminate\Support\Facades\Log::info("result session",[$session]);
        
        $response = $this->get('/yakutsk');
        $session = $this->app['session']->all();
        \Illuminate\Support\Facades\Log::info("result session",[$session]);
        
        $response = $this->get('/');
        $session = $this->app['session']->all();
        \Illuminate\Support\Facades\Log::info("result session",[$session]);
        
        $response->assertStatus(301);
    }
}
