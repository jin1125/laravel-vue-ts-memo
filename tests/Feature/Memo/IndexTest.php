<?php

namespace Tests\Feature\Memo;

use App\Models\Memo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ログインしていればIndexページに遷移できるか確認
     */
    public function testLoginUserByIfIndexPageTransitionIs()
    {
        $userId = 1;
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user   = User::factory()->create();
        $userId = 1;
        $memos  = Memo::factory()->create(['user_id' => $userId]);

        $this->actingAs($user)
             ->get(route('memo.index', $memos))
             ->assertStatus(200)
             ->assertInertia(fn (AssertableInertia $page) => $page
             ->component('Index')
        );
    }

    /**
     * 未ログインユーザーであればwelcomeページにリダイレクトするか確認
     */
    public function testNonLoginUserByIfWelcomePageRedirectIs()
    {
        $this->get('/memo')
             ->assertStatus(302)
             ->assertRedirect('/');
    }
}
