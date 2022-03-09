<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Author;

class AuthorTest extends TestCase
{
    use DatabaseTransactions;

    public function test_get_user(){
        $author = Author::all()->random();
        $response = $this->get('api/authors/' . $author->id);
        $res_arr = json_decode($response->json());
        $response->assertStatus(200);
        $this->assertEquals([$author->id, $author->name], [$res_arr->id, $res_arr->name]);
    }

    public function test_get_all_authors(){
        $response = $this->get('api/authors');
        $response->assertStatus(200);
    }
    
    public function test_get_not_existing_author(){
        $response = $this->get('api/authors/22');
        $response->assertStatus(404);
    }

    public function test_create_author(){
        $response = $this->post('api/authors', ['name' => 'CreatedByTest']);
        $response->assertStatus(201);
    }

    public function test_update_author(){
        $author = collect(Author::factory()->count(1)->create())->first();
        $response = $this->patch('api/authors/' . $author->id, ['name' => 'UpdatedByTest']);
        $response->assertStatus(200);
    }

    public function test_update_not_existing_author(){
        $response = $this->patch('api/authors/22', ['name' => 'UpdatedByTest']);
        $response->assertStatus(404);
    }

    public function test_delete_author(){
        $author = collect(Author::factory()->count(1)->create())->first();
        $response = $this->delete('api/authors/' . $author->id);
        $response->assertStatus(204);
    }

    public function test_delete_not_existing_author(){
        $response = $this->delete('api/authors/22');
        $response->assertStatus(404);
    }
}
