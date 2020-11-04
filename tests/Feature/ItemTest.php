<?php

namespace Tests\Feature;

use App\Models\Item;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testItemCreationFailsWhenNameNotProvided()
    {
        $item = factory(Item::class)->make(['name' => '']);

        $this->post(route('items.store'), $item->jsonSerialize())
            ->seeJson(['name' => ['Ce champ est obligatoire.']])
            ->assertResponseStatus(422);
    }
}
