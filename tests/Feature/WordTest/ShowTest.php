<?php

namespace Tests\Feature\WordTest;

use App\Models\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_the_page_returns_a_successful_response()
    {
        $response = $this->get('/wordtest/show/' . Test::all()->first()->id);

        $response->assertStatus(200);
    }
}
