<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Http\Services\PostService;
use App\Models\Post;

class PostController extends ApiController
{
    /**
     * Method __construct :
     * used to set current resource used for api and current model [Post]
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(PostResource::class, Post::class);
    }

    /**
     * Method getQuery :
     * used to get all data filtered for current model [Post]
     *
     * @return object
     */
    public function getQuery() :object
    {
        return $this->model::ExceptAuth()->filter();
    }

    /**
     * Method store  :
     * used to insert new post
     *
     * @param PostRequest $request [client Request will be validated by PostRequest ]
     * @param PostService $postService [client Request will be handled by this service]
     *
     * @return void
     */
    public function store(PostRequest $request, PostService $postService)
    {
        $row = $postService->handle($request->validated());
        if (is_string($row)) return $this->sendError($row);
        return $this->sendResponse(trans('flash.row created', ['model' => trans('menu.post')]), [ 'post' => new PostResource($row) ]);
    }

    /**
     * Method update :
     * used to update a current post
     *
     * @param PostRequest $request [explicite description]
     * @param PostService $postService [explicite description]
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function update(PostRequest $request, PostService $postService, $id)
    {
        $row = $postService->handle($request->validated(), $id);
        if (is_string($row)) return $this->sendError($row);
        return $this->sendResponse(trans('flash.row updated', ['model' => trans('menu.post')]), [ 'user' => new PostResource($row) ]);
    }
}
