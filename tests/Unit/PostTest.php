<?php

namespace Tests\Unit;

use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_post_store()
    {
        $response = $this->call('POST', '/admin/add-post', [
            'name' => 'some post name here',
            'slug' => 'some post slug here',
            'description' => 'some post description here',
            'meta_title' => 'some post meta_title here',
        ]);


        $response->assertStatus($response->status(), 302);
    }
}
