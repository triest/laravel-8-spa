<?php

namespace App\Services;

use App\Http\Requests\IndexPostRequest;
use App\Models\Post;

class PostService
{

    public function index(IndexPostRequest $request): array|\Illuminate\Database\Eloquent\Collection
    {
        $posts = Post::all();

        return $posts;
    }

    /**
     * @param Post $post
     * @return Post
     */
    public function show(Post $post): Post
    {
        return $post;
    }

    /**
     * @param array $data
     * @return Post
     */
    public function create(array $data): Post
    {
        $post = new Post();
        $post->fill($data);
        $post->save();
        $user = auth('sanctum')->user();
        if ($user) {
            $post->author()->associate($user);
        }
        $post->save();

        return $post;
    }

    /**
     * @param Post $post
     * @param array $data
     * @return Post
     */
    public function update(Post $post, array $data): Post
    {
        $post->update($data);
        $post->save();
        return $post;
    }

    /**
     * @param Post $post
     * @return void
     */
    public function destroy(Post $post): void
    {
        $post->delete();
    }
}
