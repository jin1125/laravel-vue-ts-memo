<?php

namespace Tests\Feature\Memo;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_index_successed()
    {
        $this->actingAs($this->user);
        $this->get('/memo')
            ->assertStatus(200)
            ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Index'));
    }
}
