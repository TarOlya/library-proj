<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Genre;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GenreTest extends TestCase
{
    use DatabaseTransactions;
    
    public function test_get_genre(){
        $genre = Genre::all()->random();
        $response = $this->get('api/genres/' . $genre->id);
        $res_arr = json_decode($response->json());
        $response->assertStatus(200);
        $this->assertEquals([$genre->id, $genre->name], [$res_arr->id, $res_arr->name]);
    }

    public function test_get_all_genres(){
        $response = $this->get('api/genres');
        $response->assertStatus(200);
    }

    public function test_get_not_existing_genre(){
        $response = $this->get('api/genres/22');
        $response->assertStatus(404);
    }

    public function test_create_genre()
    {
        $response = $this->post('api/genres', ['name' => "CreatedByTest"]);
        $response->assertStatus(201);
    }

    public function test_update_genre(){
        $genre = collect(Genre::factory()->count(1)->create())->first();
        $response = $this->patch('api/genres/' . $genre->id, ['name' => 'CreatedByTest']);
        $response->assertStatus(200);
    }

    public function test_update_not_existing_genre(){
        $response = $this->patch('api/genres/22', ['name' => 'CreatedByTest']);
        $response->assertStatus(404);
    }

    public function test_delete_genre(){
        $genre = Genre::create([
            'id' => '22',
            'name' => 'CreatedByTest',
        ]);
        $response = $this->delete('api/genres/' . $genre->id);
        $response->assertStatus(204);
    }

    public function test_delete_not_existing_genre(){
        $response = $this->delete('api/genres/22');
        $response->assertStatus(404);
    }
}
