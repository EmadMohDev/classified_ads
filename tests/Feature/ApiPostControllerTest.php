<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiPostControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_api_list_posts()
    {
        $count = Post::count();
        $last_page = (int) ceil($count / 10);
        $this->json('get', "api/posts", [], ['Accept' => 'application/json', 'Authorization' => env('API_TEST_AUTH_TOKEN')])
                ->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        [
                            'id',
                            'title',
                            'description',
                            'contact_phone_number',
                            'image',
                            'user'
                        ]
                    ],
                    'meta' => [
                        'current_page',
                        'last_page'
                    ]
                ])
                ->assertJsonCount(4, 'data');
    }

    public function test_api_validation_store_post()
    {
        $data = [
           // "title" => "post1",
            "description" => "Description1",
            "contact_phone_number" => "01223872695",
           // "image" => 98,
            "user" => 1
        ];

        $this->json('post', "api/posts", $data, ['Accept' => 'application/json', 'Authorization' => env('API_TEST_AUTH_TOKEN')])
                ->assertJsonValidationErrors(['title'])
                ->assertStatus(422);
    }

    public function test_api_store_post()
    {
        $user = User::first();
        $data = [
            "title" => "post1",
            "description" => "Description1",
            "contact_phone_number" => "01223872695",
           // "image" => 98,
            "user" => $user->id
        ];

        $this->json('post', "api/posts", $data, ['Accept' => 'application/json', 'Authorization' => env('API_TEST_AUTH_TOKEN')])
                ->assertJsonMissingValidationErrors()
                ->assertJsonStructure([
                    'success',
                    'message',
                    'post' => [
                        'id',
                        'title',
                        'description',
                        'contact_phone_number',
                        'image',
                        'user'
                    ]
                ])
                ->assertStatus(200);
    }

    public function test_api_show_post()
    {
        $post = Post::first();

        $this->json('get', "api/posts/$post->id", [], ['Accept' => 'application/json', 'Authorization' => env('API_TEST_AUTH_TOKEN')])
                ->assertJsonStructure([
                    'post' => [
                        'id',
                        'title',
                        'description',
                        'contact_phone_number',
                        'image',
                        'user'
                    ]
                ])
                ->assertJson(['post' => ['id' => $post->id]])
                ->assertStatus(200);
    }


}
