<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    use DatabaseTransactions;

    public function test_get_book(){
        $book = Book::all()->random();
        $response = $this->get('api/books/' . $book->id);
        $res_arr = json_decode($response->json());
        $response->assertStatus(200);
        $this->assertEquals([$book->id, $book->name],[$res_arr->id, $res_arr->name]);
    }

    public function test_get_all_books(){
        $response = $this->get('api/books');
        $response->assertStatus(200);
    }

    public function test_get_not_existing_book(){
        $response = $this->get('api/books/22');
        $response->assertStatus(404);
    }

    public function test_create_book(){
        $genre = Genre::all()->random();
        $author = Author::all()->random();
        $response = $this->post('api/books', ['name' => 'CreatedByTest', 'author_id' => $author->id, 'genre_id' => $genre->id]);
        $response->assertStatus(201);
    }

    public function test_create_book_with_not_existing_author(){
        $genre = Genre::all()->random();
        $data = [
            'name' => 'CreatedByTest',
            'author_id' => 11,
            'genre_id' => $genre->id,
        ];
        $response = $this->post('api/books', $data);
        $response->assertStatus(404);
        $this->assertEquals(['No author'], [$response->json()]);
    }

    public function test_create_book_with_not_existing_genre(){
        $author = Author::all()->random();
        $data = [
            'name' => 'CreatedByTest',
            'author_id' => $author->id,
            'genre_id' => 11,
        ];
        $response = $this->post('api/books', $data);
        $response->assertStatus(404);
        $this->assertEquals(['No genre'], [$response->json()]);
    }

    public function test_update_book(){
        $book = collect(Book::factory()->count(1)->create())->first();
        $data = [
            'name' => 'UpdatedByTest', 
            'author_id' => $book->author_id, 
            'genre_id' => $book->genre_id
        ];
        $response = $this->patch('api/books/' . $book->id, $data);
        $response->assertStatus(200);
    }

    public function test_update_book_with_not_existing_author(){
        $book = collect(Book::factory()->count(1)->create())->first();
        $data = [
            'name' => 'UpdatedByTest', 
            'author_id' => 11, 
            'genre_id' => $book->genre_id
        ];
        $response = $this->patch('api/books/' . $book->id, $data);
        $response->assertStatus(404);
        $this->assertEquals(['No author'], [$response->json()]);
    }

    public function test_update_book_with_not_existing_genre(){
        $book = collect(Book::factory()->count(1)->create())->first();
        $data = [
            'name' => 'UpdatedByTest', 
            'author_id' => $book->author_id, 
            'genre_id' => 11
        ];
        $response = $this->patch('api/books/' . $book->id, $data);
        $response->assertStatus(404);
        $this->assertEquals(['No genre'], [$response->json()]);
    }

    public function test_delete_book(){
        $book = collect(Book::factory()->count(1)->create())->first();
        $response = $this->delete('api/books/' . $book->id);
        $response->assertStatus(204);
    }

    public function test_delete_not_existing_book(){
        $response = $this->delete('api/books/22');
        $response->assertStatus(404);
    }
}
