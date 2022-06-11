<?php

namespace Tests\Feature\Memo;

use App\Models\Memo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * メモの削除ができるか確認
     */
    public function testCreatableNewlyMemo()
    {
        $userId = 1;
        $memoId = 1;
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user   = User::factory()->create();
        Memo::factory()->create(['user_id' => $userId]);

        $this->actingAs($user)
             ->post("/memo/destroy/$memoId")
             ->assertRedirect('memo');;
    }
}
