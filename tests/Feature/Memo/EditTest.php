<?php

namespace Tests\Feature\Memo;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_edit_successed()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
