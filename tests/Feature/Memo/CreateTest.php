<?php

namespace Tests\Feature\Memo;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * 新規メモ投稿ができるか確認
     *
     * @return void
     */
    public function testCreatableNewlyMemo()
    {
        $newMemo = [
            'title'  => $this->faker->realText(20),
            'detail' => $this->faker->realText(100),
            'limit'  => $this->faker->date('Y-m-d'),
        ];

        $this->actingAs($this->user)
             ->from('memo')
             ->post('memo/create', $newMemo)
             ->assertValid(['title', 'detail', 'limit'])
             ->assertRedirect('memo');
    }
}
