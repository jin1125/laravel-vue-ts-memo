<?php

namespace Tests\Feature\Memo;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }


    public function testCreatableNewlyMemo()
    {
        $newMemo = [
            'title'  => 'aaaa',
            'detail' => 'aaaa',
            'limit'  => '2006-10-18',
        ];

        $this->actingAs($this->user)
            ->from('memo')
            ->post('memo/create', $newMemo)
            ->assertRedirect('memo');
    }
}
