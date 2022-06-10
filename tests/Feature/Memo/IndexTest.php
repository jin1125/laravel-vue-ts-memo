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

    public function testLoginUserByIfIndexPageTransitionIs()
    {
        /**
         * ログインしていればIndexページに遷移するか確認
         */
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create();
        $memos = Memo::factory()->create(['user_id' => 1]);

        // dd($memos->title);

        $this->actingAs($user);
        $this->get(route('memo.index', $memos))
            ->assertStatus(200)
            ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Index')
            // ->has('memos', fn (AssertableInertia $page) => $page
            //     ->where('id', 1)
            //     ->where('title', $memos->title)
            //     ->where('status', 'incomplete')
            //     ->where('detail', $memos->detail)
            //     ->where('limit', $memos->limit)
            // )
        );
    }

    public function testNonLoginUserByIfWelcomePageRedirectIs()
    {
        /**
         * 未ログインユーザーであればwelcomeページにリダイレクトするか確認
         */
        $this->get('/memo')
            ->assertStatus(302)
            ->assertRedirect('/');
    }
}
