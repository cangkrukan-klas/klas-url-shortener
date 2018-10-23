<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->seed(\DatabaseSeeder::class);
    }

    /** @test */
    public function access_home_page()
    {
        $this->get('/')
            ->assertSee('PEMENDEK TAUTAN SEDERHANA DAN CEPAT')
            ->assertSee('oleh Kelompok Linux Arek Suroboyo')
            ->assertStatus(200);
    }

}