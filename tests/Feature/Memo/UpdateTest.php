<?php

namespace Tests\Feature\Memo;

use App\Models\Memo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
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
     * メモの編集ができるか確認
     *
     * @runInSeparateProcess
     * @return void
     */
    public function test_update_successed()
    {
        $userId = 1;
        $memoId = 1;
        $status = ['incomplete' ,'working' ,'complete'];
        Memo::factory()->create(['user_id' => $userId]);

        $updateMemo = [
            'title'  => $this->faker->realText(20),
            'status' => $status[array_rand($status)],
            'detail' => $this->faker->realText(100),
            'limit'  => $this->faker->date('Y-m-d'),
        ];

        $this->actingAs($this->user)
             ->from("/memo/edit/$memoId")
             ->post("/memo/update/$memoId", $updateMemo)
             ->assertValid(['title', 'status','detail', 'limit'])
             ->assertRedirect("/memo/edit/$memoId");
    }
}
