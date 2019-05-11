<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    /** @test */
    public function access_home_page()
    {
        $this->get('/')
            ->assertSee('PEMENDEK TAUTAN SEDERHANA DAN CEPAT')
            ->assertSee('oleh Kelompok Linux Arek Suroboyo')
            ->assertStatus(200);
    }

}