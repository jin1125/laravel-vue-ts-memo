<?php

namespace Tests\Feature\Memo;

use App\Models\Memo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $memos;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * Editページに遷移できるか確認
     *
     * @runInSeparateProcess
     * @return void
     */
    public function testIsTransitionableEditPage()
    {
        $userId = 1;
        $memos  = Memo::factory()->create(['user_id' => $userId]);
        $this->actingAs($this->user)
             ->get(route('memo.edit', $memos->id))
             ->assertStatus(200)
             ->assertInertia(fn (AssertableInertia $page) => $page
             ->component('Edit')
        );
    }

    /**
     * 自分のメモではないidを指定したらIndexページにリダイレクトするか
     *
     * @runInSeparateProcess
     * @return void
     */
    public function testUserMemoNotIdByIfIndexPageToRedirectIs()
    {
        $memoIdExceptMe = mt_rand();

        $this->actingAs($this->user)
             ->get("/memo/edit/$memoIdExceptMe")
             ->assertStatus(302)
             ->assertRedirect('/memo');
    }
}
