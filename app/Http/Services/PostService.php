<?php

namespace App\Http\Services;

use App\Models\Post;
use App\Traits\UploadFile;
use Exception;
use Illuminate\Support\Facades\Auth;

class PostService {

    use UploadFile;

    /**
     * Method handle :
       this method used to create or update a post
     *
     * @param $request $request [client Request]
     * @param $id $id [The id of the post]
     *
     * @return void
     */
    public function handle($request, $id = null)
    {
        try {


            if(request()->image) {
                $image = $this->uploadImage(request()->image, 'posts');
                $request['image'] = $image;
            }

            $post = Post::updateOrCreate(['id' => $id],$request);
            return $post;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
