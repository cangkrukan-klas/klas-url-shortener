<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    /** @test */
    public function access_home_page()
    {
        $this->get('/')
            ->assertSee(__('SIMPLE AND FAST URL SHORTENER'))
            ->assertSee(__('by Kelompok Linux Arek Suroboyo'))
            ->assertStatus(200);
    }

    /** @test */
    public function save_short_link()
    {
        $url = Factory::create()->url;
        $this->post('/', [
            'url' => $url
        ])->isRedirect('/');

        $this->assertDatabaseHas('short_urls', [
            'url' => $url
        ]);
    }

}