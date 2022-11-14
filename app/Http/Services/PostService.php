<?php

namespace App\Http\Services;

use App\Models\Post;
use Exception;

class PostService {

    public function handle($request, $id = null)
    {
        try {
            if (! isset($request['active'])) $request['active'] = 0;

            $operators = $request['operator_id'];
            unset($request['operator_id']);
            $post = '';

            foreach ($operators as $operator)
                $post = Post::updateOrCreate(['id' => $id], array_merge($request, ['operator_id' => $operator]));

            return $post;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
