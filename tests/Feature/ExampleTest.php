<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The root URL displays the CTMS Dashboard Landing Page.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Command Center');
        $response->assertSee('Arsitektur Dashboard');
        $response->assertSee('5 Role Workspace');
    }

    /**
     * The login page renders the split-card traveler login interface.
     */
    public function test_the_login_page_renders_split_card_design(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Hi Traveler');
        $response->assertSee('Welcome to Jaya Abadi CTMS');
        $response->assertSee('Selected Works');
    }
}
