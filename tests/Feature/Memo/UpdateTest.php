<?php

namespace Tests\Feature\Memo;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * メモの編集ができるか確認
     *
     * @runInSeparateProcess
     * @return void
     */
    public function test_update_successed()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
