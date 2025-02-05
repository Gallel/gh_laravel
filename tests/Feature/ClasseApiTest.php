<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClasseApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_classe()
    {
        $response = $this->postJson('/api/classes', [
            'name' => 'Math 101',
            'description' => 'Introduction to Mathematics',
        ]);

        $response->assertStatus(201)
                 ->assertJson(['created' => true]);
    }

    public function test_can_get_classe()
    {
        $classe = \App\Models\Classe::factory()->create();

        $response = $this->getJson('/api/classes/' . $classe->id);

        $response->assertStatus(200)
                 ->assertJson(['id' => $classe->id, 'name' => $classe->name]);
    }

    public function test_can_update_classe()
    {
        $classe = \App\Models\Classe::factory()->create();

        $response = $this->putJson('/api/classes/' . $classe->id, [
            'name' => 'Math 102',
            'description' => 'Advanced Mathematics',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['updated' => true]);
    }
}