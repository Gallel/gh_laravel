<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Classe;
use App\Models\Alumne;

class AlumneApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_alumne()
    {
        // Create a Classe first because Alumne requires a valid classe_id.
        $classe = Classe::factory()->create();

        $response = $this->postJson("/api/classes/{$classe->id}/alumnes", [
            'nom' => 'John',
            'cognom' => 'Doe',
            'dataNaixement' => '2000-01-01',
            'NIF' => '12345678A',
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['nom' => 'John']);
    }

    public function test_can_get_alumnes_for_classe()
    {
        // Create a Classe first.
        $classe = Classe::factory()->create();

        // Add two Alumnes using the defined addAlumne endpoint.
        $response1 = $this->postJson("/api/classes/{$classe->id}/alumnes", [
            'nom' => 'John',
            'cognom' => 'Doe',
            'dataNaixement' => '2000-01-01',
            'NIF' => '12345678A',
        ]);
        $response1->assertStatus(200)
                ->assertJsonFragment(['nom' => 'John']);

        $response2 = $this->postJson("/api/classes/{$classe->id}/alumnes", [
            'nom' => 'Jane',
            'cognom' => 'Smith',
            'dataNaixement' => '1999-05-05',
            'NIF' => '87654321B',
        ]);
        $response2->assertStatus(200)
                ->assertJsonFragment(['nom' => 'Jane']);

        // Retrieve all alumnes associated with the given Classe.
        $response = $this->getJson("/api/classes/{$classe->id}/alumnes");
        $response->assertStatus(200)
                ->assertJsonFragment(['nom' => 'John'])
                ->assertJsonFragment(['nom' => 'Jane']);
    }
}