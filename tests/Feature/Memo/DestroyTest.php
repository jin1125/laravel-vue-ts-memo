<?php

namespace Tests\Feature\Memo;

use App\Models\Memo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * メモの削除ができるか確認
     *
     * @return void
     */
    public function testCreatableNewlyMemo()
    {
        $userId = 1;
        $memoId = 1;
        Memo::factory()->create(['user_id' => $userId]);

        $this->actingAs($this->user)
             ->post("/memo/destroy/$memoId")
             ->assertRedirect('memo')
             ->assertSessionHas('destroyMessage', 'Delete successful');
    }

    /**
     * 自分のメモでなければ削除ができないか確認
     *
     * @return void
     */
    public function testUserMemoByWhenNoDeletingUnavailableIs()
    {
        $memoId = mt_rand();

        $this->actingAs($this->user)
             ->post("/memo/destroy/$memoId")
             ->assertStatus(404);
    }
}
