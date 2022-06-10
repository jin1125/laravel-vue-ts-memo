<?php

namespace Tests\Feature\Memo;

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
        $this->user = User::factory()->create();
        $this->actingAs($user);
        $this->get('/memo')
            ->assertStatus(200)
            ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Index'));
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
